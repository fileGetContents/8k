<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class IntegralController extends WebController
{
    /**
     * 积分展示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recharge()
    {
        if (session('user_id', -1) == -1) {
            $wx = new WechateController();
            $wx->wxUserLogin('http://www.xcylkj.com/jifen');
        }
        $user = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
        return view($this->file . 'jifen')->with([
            'user' => $user
        ]);
    }

    /**
     * 添加积分
     *
     * @param Request $request
     */
    public function addRecharge(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'recharge' => 'required',
        ]);
        $insert = $request->all();
        $insert['use_id'] = session('user_id', 1);
        $insert['time'] = $_SERVER['REQUEST_TIME'];       // 添加时间
        $insert['order_num'] = $this->WayClass->createOrderNum();  // 订单号
        $whether = $this->PurposeModel->insertWhether('recharge', $insert);
        if ($whether) {
            $wechate = new WechateController();
            $jsApiJson = $wechate->pay([
                'body' => '积分充值',
                'attach' => 'recharge', // 表名，
                'trade_no' => $insert['order_num'],
                'total_fee' => intval($insert['price']) * 100,
            ]);
            echo collect(['info' => 0, 'message' => $jsApiJson]);
        } else {
            echo collect(['info' => 1, 'message' => 'error']);
        }

    }


}
