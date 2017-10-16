<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{

    private $file = 'Admin.';

    public function SystemBase()
    {
        return view($this->file . 'system-base');
    }


    public function SystemCateGory()
    {

        return view($this->file . 'system-category');
    }


    public function SystemCateGoryAdd()
    {

        return view($this->file . 'system-category-add');
    }

    public function SystemData()
    {
        return view($this->file . 'system-data');
    }


    public function SystemLog()
    {
        return view($this->file . 'system-log');
    }

    public function SystemShielding()
    {
        return view($this->file . 'system-shielding');
    }

    /**
     *积分充记录
     * @return $this
     */
    public function recharge()
    {
        $recharge = DB::table('recharge')->leftJoin('use', 'use.id', '=', 'recharge.use_id')->get();
        return view($this->file . 'recharge-list2')->with([
            'recharge' => $recharge
        ]);
    }


}
