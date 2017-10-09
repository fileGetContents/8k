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
        $insert['order_num'] = $_SERVER['REQUEST_TIME'];  // 订单号
        $whether = $this->PurposeModel->insertWhether('recharge', $insert);
        if ($whether) {
            echo collect(['info' => 0, 'message' => 'success']);
        } else {
            echo collect(['info' => 1, 'message' => 'error']);
        }
        // 发起微信支付接口


    }


}
