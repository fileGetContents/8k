<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    protected $file = 'Admin.';

    public function AdminAdd()
    {
        return view($this->file . 'admin-add');
    }


    public function AdminList()
    {
        return view($this->file . 'admin-list');
    }

    public function AdminPermission()
    {
        return view($this->file . 'admin-permission');
    }

    public function AdminRole()
    {
        return view($this->file . 'admin-role');
    }

    public function AdminRoleAdd()
    {
        return view($this->file . 'admin-role-add');
    }


    /**
     *更新管理员
     * @param Request $request
     */
    public function alterAdmin(Request $request)
    {
        $pass = Crypt::encrypt($request->input('pass'));
        // $whether = $this->public->updateAdmin($request->input('admin'), $pass);
        $whether = DB::table('admin')->update(['admin_name' => $request->input('admin'), 'admin_password' => $pass]);
        if ($whether) {
            echo collect(array('info' => 0, 'message' => 'success'));
        } else {
            echo collect(array('info' => 1, 'message' => 'error'));
        }
    }


    /**
     * 管理员登录
     * @param Request $request
     */
    public function loginAdmin(Request $request)
    {
        $admin = DB::table('admin')->where(['admin_name' => $request->input('admin')])->first();
        if (!is_null($admin)) {
            if (Crypt::decrypt($admin->admin_password) == $request->input('password')) {
                $request->session()->put('admin_id', $admin->admin_id);
                echo collect(['info' => 0, 'message' => 'success']);
            } else {
                echo collect(['info' => 1, 'message' => '密码不匹配']);
            }
        } else {
            echo collect(['info' => 1, 'message' => '账号不存在']);
        }
    }

}




