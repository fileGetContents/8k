<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model;
use Illuminate\Support\Facades\DB;

class FeedBackController extends Controller
{

    protected $file = 'Admin.';
    protected $PurposeModel;

    public function __construct()
    {
        $this->PurposeModel = new Model\PurposeModel();
    }

    public function FeedBackList()
    {
        $feed = DB::table('feedback')
            ->leftjoin('use', "feedback.use_id", '=', 'use.id')
            ->orderBy('time', 'DESC')->paginate();
        return view($this->file . 'feedback-list')->with([
            'feed' => $feed
        ]);
    }


}
