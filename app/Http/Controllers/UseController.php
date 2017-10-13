<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\WebController;

class UseController extends WebController
{
    /**
     * 个人中心
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function person()
    {
        $user = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
        return view($this->file . 'person')->with(
            ['user' => $user]
        );
    }


    /**
     *我的需求
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userNeed(Request $request)
    {
        $demand = $this->PurposeModel->selectAllOrder('use_demand', ['user_id' => session('user_id', 1)]);
        $need = array();
        foreach ($demand as $value) {
            $column = $this->PurposeModel->selectFirst('column', ['id' => $value->column_id]);
            $value->column_name = $column->column_name;
            $value->demand = unserialize($value->demand);
            // 查询报价需求
            $transact = $this->PurposeModel->selectTake('transact', ['demand_id' => $value->id]);
            $value->transact = $transact;
            $need[] = $value;
        };

        // 查询字段意思
        $needAll = array();
        foreach ($need as $value) {
            $mean = $this->UserModel->getDemandMean($value->demand, $value->column_id);
            $value->need = $mean;
            $needAll[] = $value;
        }

        $num = $this->PurposeModel->selectCount('use_demand', ['user_id' => session('user_id', 1)]);
        return view($this->file . 'myneed')->with([
            'need' => $needAll,  // 获取需求详情
            'num' => $num,       // 数量
            'start' => 0,        // 开始位置
        ]);
    }

    /**
     * 需求详情
     * @param Request $request
     */
    public function needInfo(Request $request)
    {
        echo 111;
        //   return view($this->file, '');
    }

}
