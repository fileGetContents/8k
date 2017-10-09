<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    protected $file = 'Admin.';

    public function Login(Request $request)
    {
        if ($request->isMethod('post')) {

        } else {

        }
        return view($this->file . 'login');
    }


    public function Index()
    {
        return view($this->file . 'index');
    }

}
