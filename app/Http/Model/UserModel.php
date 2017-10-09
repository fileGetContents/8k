<?php

namespace App\Http\Model;

use Illuminate\Support\Facades\DB;

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
                $mean = $this->selectFirst('options', ['name' => $key, 'column_id' => $column_id]);
                $return[$mean->name] = $mean->mean;
            }
            return $return;
        } else {
            return false;
        }

    }



}
