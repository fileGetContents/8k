<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

class ServerController extends WebController
{

    /**
     * 服务商认证V
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function identifyV(Request $request)
    {
        $documents = $this->PurposeModel->selectFirst('documents', ['use_id' => session('user_id', 1)]);
//        if (!is_null($documents)) {
//            if ($documents->tag == 0 || $documents->tag == 10) {
//                return back();
//            }
//        }
        $use = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
        return view($this->file . 'identifyV')->with([
            'user' => $use
        ]);

    }

    /**
     *添加/修改v认证
     *
     * @param Request $request
     * @return json
     */
    public function insertIdentifyV(Request $request)
    {
        $input = $request->all();
        $insert['name'] = $input['name'];
        $insert['telephone'] = $input['telephone'];
        $insert['time'] = $_SERVER['REQUEST_TIME'];
        $insert['use_id'] = session('user_id', 1);
        $insert['documents'][0] = $input['image0'];
        $insert['documents'][1] = $input['image1'];
        $insert['documents'][2] = $input['image2'];
        $insert['documents'][3] = $input['image3'];
        $insert['documents'] = serialize($insert['documents']);
        $documents = $this->PurposeModel->selectFirst('documents', ['use_id' => session('user_id', 1)]);
        if (is_null($documents)) {
            $whether = $this->PurposeModel->up('documents', ['use_id' => session('user_id', 1)], $insert);
        } else {
            $whether = $this->PurposeModel->insertWhether('documents', $insert);
        }
        if ($whether) {
            return collect(['info' => 0, 'message' => 'success'])->toJson();
        } else {
            return collect(['info' => 1, 'message' => 'error'])->toJson();
        }
    }


    /**
     * 服务商中心
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function company(Request $request)
    {
        $server = $this->PurposeModel->selectAll('use_server', ['use_id' => session('user_id', 1)]);
        $column = array();
        foreach ($server as $key => $value) {
            $uns = unserialize($value->server);
            foreach ($uns as $v) {
                if (is_array($v)) {
                    foreach ($v as $va) {
                        $column[$key][] = $this->PurposeModel->selectFirst('column', ['id' => $va]);
                    }
                } else {
                    $column[$key][] = $this->PurposeModel->selectFirst('column', ['id' => $v]);
                }
            }
            $server[$key]->column = $column[$key];
        }
        if (session('user_id', -1) == -1) {
            $wx = new WechateController();
            $wx->wxUserLogin('http://www.xcylkj.com/company');
        }
        $user = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
        return view($this->file . 'company')->with([
            'server' => $server,
            'profile' => self::getProAdd(),
            'foot' => self::foot(),
            'user' => $user
        ]);
    }


    /**
     * 修改地址或者简介
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function replace(Request $request)
    {
        return view($this->file . 'replace')->with([
            'profile' => self::getProAdd(),
        ]);
    }

    /**
     * 修改添加商户信息
     *
     * @param Request $request
     */
    public function ajaxReplace(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->input('string') != '') {
                $update['images'] = $request->input('string');    // 验证是否图片文集
            }
            $update['profile'] = $request->input('profile');
            $update['address'] = $request->input('address');
            $is = $this->PurposeModel->selectFirst('profile', ['use_id' => session('user_id', 1)]);
            if ($is) {
                $whether = $this->PurposeModel->up('profile', ['use_id' => session('user_id', 1)], $update);
            } else {
                $update['use_id'] = session('user_id', 1);
                $whether = $this->PurposeModel->insertWhether('profile', $update);
            }
            if ($whether) {
                echo collect(['info' => 0, 'message' => 'success']);
            } else {
                echo collect(['info' => 0, 'message' => 'error']);
            }
        }
    }

    /**
     * 获取用户足迹
     *
     * @return mixed
     */
    private
    function foot()
    {
        return $this->PurposeModel->selectAll('foot', ['use_id' => session('user_id', 1)]);
    }


    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function addFoot()
    {

        return view($this->file . 'addfoot');
    }

    /**
     *添加时间
     *
     * @param Request $request
     */
    public function ajaxFoot(Request $request)
    {
        $insert = array();
        if ($request->input('images') != '') {
            $images = array_filter(explode('/', $request->input('images')));
            $url = $this->PurposeModel->getImageUrl($images);
            $insert['images'] = serialize($url);
        }
        $insert['message'] = $request->input('message');
        $insert['address'] = $request->input('address');
        $insert['time'] = $_SERVER['REQUEST_TIME'];
        $insert['use_id'] = session('user_id', 1);
        $whether = $this->PurposeModel->insertWhether('foot', $insert);
        if ($whether) {
            echo collect(['info' => 0, 'message' => 'success']);
        } else {
            echo collect(['info' => 1, 'message' => 'error']);
        }
    }


    /**
     * 获取栏目地址
     *
     * @return mixed
     */
    private function getProAdd()
    {
        return $this->PurposeModel->selectFirst('profile', ['use_id' => session('user_id', 1)]);
    }


    /**
     * 添加模板
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function model()
    {
        $mode = DB::table('mode')
            ->where(['use_id' => session('user_id', 1)])
            ->leftJoin('column', 'column.id', '=', 'mode.column_id')
            ->get();
        return view($this->file . 'modal')->with([
            'mode' => $mode
        ]);
    }


    /**
     * 添加修改模板
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function addModel(Request $request)
    {
        if (is_null($request->id)) {
            // 添加
            $user = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
            return view($this->file . 'addmodal')->with([
                'add' => true,
                'server' => parent::getServerAll(session('user_id', 1)),
                'phone' => $user->telephone
            ]);
        } else {
            // 修改
            if ($request->isMethod('post')) {
                $up = $request->all();
                $this->PurposeModel->up('mode', ['mode_id' => $request->id], $up);
            }
            return view($this->file . 'addmodal')->with([
                'add' => false,
                'mode' => self::selModelColumn($request->id)
            ]);
        }

    }

    private
    function selModelColumn($id)
    {
        return DB::table('mode')
            ->where(['mode_id' => $id])
            ->leftJoin('column', 'mode.column_id', '=', 'column.id')
            ->get();
    }

    /**
     * 添加模板
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function formAddModel(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            // 'message' => 'required',
        ]);
        $insert = $request->all();
        $insert['use_id'] = session('user_id', 1);
        $insert['time'] = $_SERVER['REQUEST_TIME'];
        $whether = $this->PurposeModel->insertWhether('mode', $insert);
        return back();
    }


    /**
     * 添加修改模板
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function datails(Request $request)
    {
        return view($this->file . 'datails');
    }


    /**
     * 先行赔付
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function identify()
    {
        $dentify = $this->PurposeModel->selectFirst('identify', ['use_id' => session('user_id')]);
        if (!is_null($dentify)) {
            if ($dentify->admin_tag == 0 || $dentify->admin_tag == 20) {
                return back();   // 返回上一界面
            }
        }
        return view($this->file . 'identifyxianxing');
    }

    /**
     * 添加赔付
     *
     * @param Request $request
     */
    public function addIdentify(Request $request)
    {
        $this->validate($request, [
            'string' => 'required',
            'price' => 'required'
        ]);
        $image = array_filter(explode('/', $request->input('string')));
        $urlImage = array();
        foreach ($image as $value) {
            $urlImage[] = asset(date('Ymd') . '/' . $value . '.png');
        }
        $orderNum = $this->WayClass->createOrderNum();
        $whether = $this->PurposeModel->insertWhether('identify', [
            'images' => serialize($urlImage),
            'time' => $_SERVER['REQUEST_TIME'],
            'use_id' => session('user_id', 1),
            'price' => $request->input('price'),
            'order_num' => $orderNum
        ]);
        // 生成订单号
        if ($whether) {
            $Wechate = new WechateController();
            $return = $Wechate->pay([
                'body' => 'V认证支付',
                'attach' => 'identify',
                'trade_no' => $orderNum,
                // 'total_fee' => $request->input('price') * 100,
                'total_fee' => 1
            ]);
            echo $return;
        } else {
            echo collect(['info' => 1, 'message' => 'error']);
        }
    }
}
