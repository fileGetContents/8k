<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model;
use Storage;

class ApiController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = new Model\PurposeModel();
    }

    /**
     * 发送短信验证
     * @param Request $request
     */
    public function sendSMS(Request $request)
    {
        $pattern = '/^1[34578]\d{9}$/';
        $info = rand(100000, 999999);
        $subject = $request->input('telephone');
        if (preg_match($pattern, $subject)) {
            $request->session()->put('info', $info);
            echo collect(array('info' => 0, 'message' => $info))->toJson();
        } else {
            echo collect(array('info' => 1, 'message' => 'error'))->toJson();
        }
    }

    /**
     * 用户登录
     * @param Request $request
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'telephone' => ['required', 'regex:/^1[34578]\d{9}$/'],
            'send' => 'required|integer'
        ]);
        if ($request->input('send') == session('info')) {
            $use = $this->db->selectFirst('use', array('telephone' => $request->input('telephone')));
            if (is_null($use)) {
                $id = $this->db->insertGetId('use', array(
                    'telephone' => $request->input('telephone'),
                    'nick' => 'num' . rand(1000000, 99999999)
                ));
                $request->session()->put('user_id', $id);
                echo collect(array('info' => 0, 'message' => 'success'))->toJson();
            } else {
                $request->session()->put('user_id', $use->id);
                echo collect(array('info' => 0, 'message' => 'success'))->toJson();
            }
        } else {
            echo collect(array('info' => 1, 'message' => 'error'));
        }
    }

    /**
     * 通用删除
     *
     * @param Request $request
     */
    public function PurDel(Request $request)
    {
        $table = $request->input('table');
        $id = $request->input('id');
        switch ($table) {
            case 'mode':
                $where = array('mode_id' => $id);
                break;
            default :
                $where = array('id' => $id);
        }
        $whether = $this->db->PurDel($table, $where);
        if ($whether) {
            echo collect(['info' => 'success'])->toJson();
        } else {
            echo collect(['info' => 'error'])->toJson();
        }
    }

    /**
     * 更新用户信息
     *
     * @param Request $request
     */
    public function upUser(Request $request)
    {
        $whether = $this->db->up('use', ['id' => session('user_id', 1)], $request->all());
        if ($whether) {
            echo collect(['info' => 0, 'message' => 'success']);
        } else {
            echo collect(['info' => 1, 'message' => 'error']);
        }
    }

    /**
     *通用修改一个字段
     * @param  table string   表名
     * @param  where string   条件字段
     * @param  wheFile string 条件
     * @param  upFile string  更新字段
     * @param  up  string
     * @param Request $request
     */
    public function upFileAll(Request $request)
    {
        $whether = $this->db->up($request->input('table'),
            [$request->input('where') => $request->input('wheFile')],
            [$request->input('upFile') => $request->input('up')]
        );
        if ($whether) {
            return collect(['info' => 0, 'message' => 'success']);
        } else {
            return collect(['info' => 1, 'message' => 'error']);
        }
    }


    /**
     *ajax添加图片
     * @param Request $request
     */
    public function ajaxUpdateFileImage(Request $request)
    {
        $nameFile = date('Ymd') . '/' . $request->input("name");
        $nameFile2 = $nameFile . '.png';
        $storage = Storage::put(
            $nameFile2,
            file_get_contents($request->file('file')->getRealPath())
        );
        // 图片上传
        if ($storage) {
            //  $request->session()->put('nameFile', $nameFile);
            echo collect(array('nameFile' => asset($nameFile2)))->toJson();
        } else {
            echo collect(array('nameFile' => 'error'))->toJson();
        }

    }


    /**
     *  添加用户留言
     */
    public function addMessage(Request $request)
    {
        $array = $request->all();
        $array['server_id'] = session('user_id', 1);    // 添加
        $array['time'] = $_SERVER['REQUEST_TIME'];      // 时间
        $whether = $this->db->insertWhether('message', $array);
        if ($whether) {
            echo collect(['info' => 0, 'message' => 'success']);
        } else {
            echo collect(['info' => 1, 'message' => 'error']);
        }
    }


}
