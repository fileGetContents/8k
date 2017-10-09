<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    private $file = 'Admin.';

    public function Welcome()
    {
        return view($this->file . 'welcome');
    }

}
