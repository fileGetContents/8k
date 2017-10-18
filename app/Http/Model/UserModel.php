<?php

namespace App\Http\Model;

use Illuminate\Support\Facades\DB;
use App\Http\Model\PurposeModel;

class UserModel extends PurposeModel
{


    /**
     * 获取字段的提示语言
     *
     * @param $demand string 需求数组
     * @param $column_id  int 分类id
     * @return array|bool
     */
    public function getDemandMean($demand, $column_id)
    {
        if (is_array($demand) && is_numeric($column_id)) {
            $return = array();
            foreach ($demand as $key => $value) {
                $mean = $this->selFirst('options', ['name' => $key, 'column_id' => $column_id]);
                $return[$mean[0]->name] = $mean[0]->mean;
            }
            return $return;
        } else {
            return false;
        }

    }

    /**
     * 添加积分信息
     * @param $recharge
     * @param $text
     */
    public function addRecharge($user_id, $recharge, $text)
    {
        DB::table('info_recharge')->insert([
            'info_recharge' => $recharge,
            'info_text' => $text,
            'info_time' => $_SERVER['REQUEST_TIME'],
            'use_id' => $user_id
        ]);
    }


}
