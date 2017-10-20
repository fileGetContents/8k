<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    private $file = "Admin.";

    public function login()
    {
        // echo 111;
        return view($this->file . "load");
    }
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view($this->file . "index");
    }
    /**
     * 系统首页
     */
    public function welcome()
    {

        return view($this->file . "welcome");
    }


}
