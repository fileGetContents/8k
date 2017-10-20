<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Crypt;

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
        $whether = $this->public->updateAdmin($request->input('admin'), $pass);
        if ($whether) {
            echo collect(array('info' => 0, 'message' => 'success'));
        } else {
            echo collect(array('info' => 1, 'message' => 'error'));
        }
    }

}




