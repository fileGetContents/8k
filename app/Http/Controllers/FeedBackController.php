<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedBackController extends WebController
{


    public function suggest()
    {

        return view($this->file . 'suggest');
    }

    /**
     * 反馈消息
     * @param Request $request
     */
    public function userSuggest(Request $request)
    {
        $suggest = array(
            'feedback' => $request->input('feedback', '没有'),
            'time' => $_SERVER['REQUEST_TIME'],
            'use_id' => session('user_id', '-1')
        );
        $id = $this->PurposeModel->insertGetId('feedback', $suggest);
        if (is_numeric($id) && $id > 0) {
            echo collect(array('info' => 0, 'message' => 'success'));
        } else {
            echo collect(array('info' => 1, 'message' => 'error'));
        }
    }


}
