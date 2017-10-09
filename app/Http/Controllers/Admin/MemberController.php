<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{

    protected $file = 'Admin.';

    public function MemberAdd()
    {
        return view($this->file . 'member-add');
    }

    public function MemberDel()
    {
        return view($this->file . 'member-del');
    }


    public function MemberList()
    {
        return view($this->file . 'member-list');
    }


    public function MemberRecordBrowse()
    {

        return view($this->file . 'member-record-browse');
    }

    public function MemberRecordDownload()
    {

        return view($this->file . 'member-record-download');
    }

    public function MemberRecordShare()
    {
        return view($this->file . 'member-record-share');
    }


    public function MemberShow()
    {
        return view($this->file . 'member-show');
    }


}
