<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $file = 'Admin.';

    public function AdminAdd()
    {
        return  view($this->file . 'admin-add');
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


}




