<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class PurposeModel extends Model
{

    /**
     * 通用添加
     * @param $table  string 表名
     * @param $insert array  添加字符串
     * @return mixed
     */
    public function insertGetId($table, $insert)
    {
        return DB::table($table)->insertGetId($insert);
    }

    /**
     * 通用添加
     *
     * @param $table string
     * @param $insert array
     * @return mixed
     */
    public function insertWhether($table, $insert)
    {
        return DB::table($table)->insert($insert);
    }

    /**
     * 通用查询
     *
     * @param $table string  表名
     * @param $where
     */
    public function selectAll($table, $where)
    {
        return DB::table($table)->where($where)->get();
    }

    /**
     * 查询全部
     *
     * @param $table string 表名
     * @param $where array 数组
     * @param $file string 字段
     * @param $way string 排序方式
     * @return mixed
     */
    public function selectAllOrder($table, $where, $file = 'id', $way = 'desc')
    {
        return DB::table($table)->where($where)->orderBy($file, $way)->get();
    }

    /**
     * 限制查询表格
     *
     * @param $table string
     * @param $where array
     * @param $skip int 限制条件
     * @return mixed
     */
    public function selectTake($table, $where = array(), $skip = 5)
    {
        if (empty($where)) {
            return DB::table($table)->skip($skip)->get();
        } else {
            return DB::table($table)->where($where)->take($skip)->get();
        }
    }


    /**
     * 全表查询
     *
     * @param $table string
     * @return mixed
     */
    public
    function selectTableAll($table)
    {
        return DB::table($table)->get();
    }


    /**
     * 查询一条
     * @param $table string 表名
     * @param $where array  条件
     * @return mixed
     */
    public function selectFirst($table, $where)
    {
        return DB::table($table)->where($where)->first();
    }

    public function selFirst($table, $where)
    {
        return DB::table($table)->where($where)->get();
        // return false;
    }


    /**
     * 查询一共有多少条
     *
     * @param $table
     * @param array $where
     * @param string $filed
     * @return mixed
     */
    public function selectCount($table, $where = array(), $filed = 'id')
    {
        if (empty($array)) {
            return DB::table($table)->select($filed)->count();
        } else {
            return DB::table()->select($filed)->where($where)->count();
        }
    }

    /**
     * 更新数据
     * @param  $table
     * @param $where
     * @param $update
     * @return mixed
     */
    public function up($table, $where, $update)
    {
        return DB::table($table)->where($where)->update($update);
    }

    /**
     * 通用关联查询
     * @param $left  string
     * @param $right string
     * @param $left_id string
     * @param $right_id string
     * @param array $where array
     * @return mixed
     */
    public function joinTableAll($left, $right, $left_id, $right_id, $where = array())
    {
        if (empty($where)) {
            return DB::table($left)->leftjoin($right, $left_id, '=', $right_id)->orderBy('time', 'DESC')->get();
        } else {
            return DB::table($left)->where($where)->leftjoin($right, $left_id, '=', $right_id)->orderBy('time', 'DESC')->get();
        }
    }

    /**
     * 通用删除
     *
     * @param $table string
     * @param $where array
     * @return mixed
     */
    public function PurDel($table, $where)
    {
        return DB::table($table)->where($where)->delete();
    }


    /**
     * 获取上传图片文件
     * @param $array string
     * @return bool
     */
    public function getImageUrl($array)
    {
        if (is_array($array)) {
            $url = array();
            foreach ($array as $value) {
                $url[] = asset(date("Ymd") . '/' . $value . '.png');
            }
            return $url;
        } else {
            return false;
        }
    }

}
