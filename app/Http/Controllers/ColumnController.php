<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model;
use Illuminate\Support\Facades\DB;

class ColumnController extends WebController
{

    /**
     *用户选择需求发布
     *
     * @return $this
     */
    public function showServer()
    {
        if (session('user_id', -1) == -1) {
            $wx = new WechateController();
            $wx->wxUserLogin(URL('show/serve'));
        }
        // 查看是否添加了手机号码
        $userInfo = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
        if ($userInfo->telephone == null) {
            echo '<meta charset="utf-8"/>';
            echo '<script>alert("请先添加手机号")</script>';
            echo '<script>window.location.href= "' . URL('person') . '"</script>';
            exit();
        }
        // 查看是否是商户用户
        $server = $this->PurposeModel->selectFirst('use_server', ['use_id' => session('user_id', 1)]);
        if (!is_null($server)) {
            echo '<meta charset="utf-8"/>';
            echo '<script>alert("商户用户不能发布需求")</script>';
            echo '<script type="text/javascript">window.location.href="' . URL('person') . '";</script>';
            exit();
        }
        $class = $this->PurposeModel->selectAll('column', ['depth' => 0]); // 顶级栏目
        foreach ($class as $value) {
            $choose[] = $this->PurposeModel->selectAll('column', ['parent_id' => $value->id]);
        }

        return view($this->file . 'server')->with([
            'class' => $class,
            'choose' => $choose
        ]);
    }

    /**
     * 服务商添加服务
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addServer(Request $request)
    {
        if ($request->isMethod('post')) {
            $server['server'] = serialize($request->all());
            if (empty($server['server'])) {
                return back();
            };
            $server['use_id'] = session('user_id', 1);
            $server['time'] = $_SERVER['REQUEST_TIME'];
            $id = $this->PurposeModel->insertGetId('use_server', $server);
            if (is_numeric($id) && $id > 0) {
                // 成为服务商奖励积分
                $info_recharge = $this->PurposeModel->selectFirst('info_recharge', [
                    'use_id' => session('user_id'),
                    'info_recharge' => 30,
                    'info_text' => '服务商积分'
                ]);
                if (is_null($info_recharge)) {
                    $this->UserModel->addRecharge(session('user_id'), 30, '服务商积分');
                    $this->UserModel->addIntegral(['id' => session('user_id')], 30); // 添加积分
                }
                echo '<script type="text/javascript">window.location.href="' . URL('range/server/' . $id) . '";</script>';
            } else {
                echo '<script> alert("添加服务失败")</script>';
            }
        }
        $wx = new WechateController();
        $wx->wxUserLogin(URL('add/server'));
        // 查看是否添加手机号
        $userInfo = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
        if ($userInfo->telephone == null) {
            echo '<meta charset="utf-8"/>';
            echo '<script>alert("请先添加手机号")</script>';
            echo '<script>window.location.href= "' . URL('person') . '"</script>';
            die;
        }
//        $server = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
//        if (!is_null($server) && $server->telephone) {
//            return redirect('person');
//        }
        $class = $this->PurposeModel->selectAll('column', ['depth' => 0]); // 顶级栏目
        foreach ($class as $value) {
            $choose[] = $this->PurposeModel->selectAll('column', ['parent_id' => $value->id]);
        }
        return view($this->file . 'addserver')->with([
            'class' => $class,
            'choose' => $choose
        ]);
    }


    /**
     * 添加服务半径
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function serverRange(Request $request)
    {
        $SerServer = $this->PurposeModel->selectFirst('use_server', ['id' => $request->id]);
        $server = unserialize($SerServer->server);
        if (empty($server)) {  // 为空删除返回上一界面
            $this->PurposeModel->PurDel('use_server', ['id' => $request->id]);
            return back();
        }
        $column = array();
        foreach ($server['server'] as $value) {
            $column[] = $this->PurposeModel->selectFirst('column', ['id' => $value]);
        }
        return view($this->file . 'serveplace')->with([
            'server' => $column,
            'id' => $request->id,
            'address' => $SerServer
        ]);
    }

    /**
     * 添加服务半径
     *
     * @param Request $request
     */
    public function addRange(Request $request)
    {
        $info = $request->input('server');        // 服务项目
        $server = array_filter(explode('/', $info));
        $num = 0;
        $column['server'] = array();
        $serverInfo = array();
        foreach ($server as $value) {
            if ($num == 0) {
                $column['server'][] = $value;
                $num = 1;
            } else if ($num == 1) {
                $serverInfo[] = $value;
                $num = 0;
            }
        }
        $whether = $this->PurposeModel->up('use_server',
            ['id' => $request->input('id', 1)],
            [
                'info' => serialize($serverInfo),
                'server' => serialize($column),
                'name' => $request->input('place')
            ]
        );
        if ($whether) {
            echo collect(['info' => 0, 'message' => 'success']);
        } else {
            echo collect(['info' => 1, 'message' => 'error']);
        }

    }


    /**
     * 选择服务项目
     *
     * @param Request $request
     * @return $this
     */
    public function chooseServer(Request $request)
    {
        $id = $request->id;
        if ($request->isMethod('post')) {
            // dump($request->all());
            $table['demand'] = serialize($request->all());
            $table['column_id'] = $id; // 栏目id
            $table['add_time'] = $_SERVER['REQUEST_TIME']; // 添加时间
            $table['user_id'] = session('user_id', 1);
            // 反序添加数据库
            $id = $this->PurposeModel->insertGetId('use_demand', $table);
            // 跳转补充说明
            if (is_numeric($id) && $id > 0) {
                // 跳转详细界面
                return redirect('demand/details/' . $id);
            }
            return back();
        }
        $options = $this->PurposeModel->selectAllOrder('options', array('column_id' => $id), 'sort', 'asc');
        return view($this->file . 'choose')->with([
            'options' => $options
        ]);
    }


    /**
     * 需求详情
     * @return $this
     */
    public function demandDetails(Request $request)
    {
        $demand = $this->PurposeModel->selectAllOrder('use_demand', [
            'id' => $request->id,
        ]);

        $need = array();
        foreach ($demand as $value) {
            $column = $this->PurposeModel->selFirst('column', ['id' => $value->column_id]);
            $value->column_name = $column[0]->column_name;
            $value->demand = unserialize($value->demand);
            // 查询报价需求
            $transact = $this->PurposeModel->selectTake('transact', ['demand_id' => $value->id]);
            $value->transact = $transact;
            $need[] = $value;
        };
        // 查询字段意思
        $needAll = array();
        foreach ($need as $value) {
            $mean = $this->UserModel->getDemandMean($value->demand, $value->column_id);
            $value->need = $mean;
            $needAll[] = $value;
        };
        $user = $this->PurposeModel->selFirst('use', ['id' => $demand[0]->user_id]);
        $phone = $this->WayClass->hiddenNumber($user[0]->telephone);
        // 查询是否需要使用地图功能
        $options = $this->PurposeModel->selectAll('options', ['column_id' => $demand[0]->column_id]);
        $map = ['bool' => false, 'key' => '']; //

        foreach ($options as $key => $value) {
            if (substr_count($value->choose, 'suggestId2') > 0) {
                if (substr_count($value->choose, 'suggestId') > 0) {
                    $map = ['bool' => true, 'key' => $value->name];
                    // 获取地点
                    foreach ($needAll[0]->demand as $deKey => $v) {
                        if ($deKey == $value->name) {
                            $map['address'][0] = $v[0];
                            $map['address'][1] = $v[1];
                        }
                    }
                }
            }
        }

        return view($this->file . 'details')->with([
            'need' => $needAll[0],  // 获取需求详情
            'start' => 0,        // 开始位置
            'id' => $request->id,
            'phone' => $phone,
            'map' => $map
        ]);
    }


    /**
     * 添加查看报价需求
     *
     * @param Request $request
     * @return $this
     */
    public function demandDetails2(Request $request)
    {
        $server = $this->PurposeModel->selectFirst('use', ['id' => session('use_id')]);
        $whether = self::isInsert('quote', ['demand_id' => $request->id, 'server_id' => session('user_id', 2)]);
        if (!$whether) { // 添加
            $user = $this->PurposeModel->selectFirst('use_demand', ['id' => $request->id]);
            $this->PurposeModel->insertWhether('quote', [
                'use_id' => $user->user_id,
                'price' => $request->price,
                'time' => $_SERVER['REQUEST_TIME'],
                'server_id' => session('user_id', 2),
                'demand_id' => $request->id,
            ]);
        }
        $need = self::selQouteInfo($request->id, $request->price);
        $needClass = unserialize($need->demand);
        $mean = parent::getClassMeta($needClass, $need->column_id);
        // 查询是否需要使用地图功能
        $documents = $this->PurposeModel->selectAll('options', ['id' => $need->id]);
        $value = parent::getUserInfo($need->use_id);
        return view($this->file . 'details2')->with([
            'server' => $server,
            'need' => $need,
            'mean' => $mean,
            'needClass' => $needClass,
            'user' => parent::getUserInfo(session('user_id')),
            'myOrder' => parent::getUserInfo($need->use_id),
        ]);

    }

    /**
     * 检查是否添加过
     *
     * @param $table string
     * @param $array array
     * @return bool
     */
    private function isInsert($table, $array)
    {
        $whether = $this->PurposeModel->selectFirst($table, $array);
        if (is_null($whether)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *
     * @param $demand_id
     * @param $price
     */
    private function selQouteInfo($demand_id, $price)
    {
        return DB::table('quote')
            ->where([
                'demand_id' => $demand_id,
                'server_id' => session('user_id'),
                'price' => $price
            ])
            ->leftJoin('use_demand', 'quote.demand_id', '=', 'use_demand.id')
            ->first();
    }


    /**
     * 补充其他信息
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function optionsOther(Request $request)
    {
        return view($this->file . 'options');
    }


    /**
     * 联系需求中
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function connectbussiness(Request $request)
    {
//        $need = self::selWhereAll(['server_id' => session('user_id')]);
//        $id = self::selFileAs('use_demand.id as id2', ['server_id' => session('user_id')]);

        $need = DB::table('use_demand')
            ->where(['server_id' => session('user_id')])
            ->where(['quote' => 0])
            ->where('user_id', '!=', session('user_id'))
            ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
            ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
            ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
            ->get();

        return view($this->file . 'connectbussiness')->with([
            'need' => $need,
            'id' => self::selFileAs('use_demand.id as id2', ['server_id' => session('user_id')]),
            'num' => 0,
            'iden' => self::isIdentify()
        ]);
    }


    /**
     * 已报价
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function alreadybussiness()
    {
        $quote = DB::table('use_demand')
            ->where('quote', '>', 0)
            ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
            ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
            ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
            ->get();
        $id = DB::table('use_demand')
            ->where('quote', '>', 0)
            ->select('use_demand.id as id2')
            ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
            ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
            ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
            ->get();
        return view($this->file . 'alreadybussiness')->with([
            'need' => $quote,
            'id' => $id,
            'num' => 0,
            'iden' => self::isIdentify()
        ]);
    }

    /**
     * 待报价
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function waitbussiness(Request $request)
    {
        if (isset($_GET['time'])) {
            switch ($_GET['time']) {
                case 'now':
                    $where['add_time'] = $_SERVER['REQUEST_TIME'] - 24 * 60 * 60 * 1000;
                    break;
                case 'two':
                    $where['add_time'] = $_SERVER['REQUEST_TIME'] - 24 * 2 * 60 * 60 * 1000;
                    break;
                case 'there':
                    $where['add_time'] = $_SERVER['REQUEST_TIME'] - 24 * 3 * 60 * 60 * 1000;
                    break;
            }
        }
        if (isset($_GET['time'])) {
            $need = DB::table('use_demand')
                ->where('add_time', '>', $where['add_time'])
                ->where(['quote' => 0])
                ->where('server_id', '!=', session('user_id'))
                ->leftJoin('quote', 'use_demand.id', '=', 'quote.demand_id')
                ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
//                ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
                ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
                ->get();
            $id = self::selFileAs('use_demand.id as id2', ['quote' => 0], ['add_time', '>', $where['add_time']]);
        } else {
            $need = DB::table('use_demand')
                ->where(['quote' => 0])
                ->where('server_id', '!=', session('user_id'))
                ->leftJoin('quote', 'use_demand.id', '=', 'quote.demand_id')
                ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
//                ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
                ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
                ->get();
            $id = self::selFileAs('use_demand.id as id2', ['quote' => 0]);
        }

        // 删除不是自己的服务项目
        $server = $this->PurposeModel->selectAll('use_server', ['use_id' => session('user_id', 1)]);
        foreach ($server as $value) {
            $unser = unserialize($value->server);
            foreach ($unser as $v) {
                foreach ($v as $va) {
                    $serverAll[] = $va;
                }
            }
        }

        //  删除已经报价的
        $quoteAll = array();
        $quote = $this->PurposeModel->selectAll('quote', ['server_id' => session('user_id')]);
        foreach ($quote as $value) {
            $quoteAll [] = $value->demand_id;
        }
        foreach ($need as $key => $value) {
            if (!in_array($value->column_id, $serverAll)) {
                $need[$key] = null;
            }
            // 删除已经报价的数据
            if (in_array($value->id, $quoteAll)) {
                $need[$key] = null;
            }
        }
        return view($this->file . 'waitbussiness')->with([
            'need' => $need,
            'id' => $id,
            'num' => 0,
            'iden' => self::isIdentify()
        ]);
    }

    private function isIdentify()
    {
        $iden = $this->PurposeModel->selectFirst('identify', ['admin_tag' => 20, 'use_id' => session('user_id', 1)]);
        if (is_null($iden)) {
            return false;
        } else {
            return true;
        }
    }


//,'user_id','demand','add_time','tag','column_id','demand_other','quote','quote_id','use_id','server_id','demand_id','time','price','nick','telephone','pay','server','column_name','parent_id','depth'
    /**
     *
     * @param $where
     * @return mixed
     */
    protected function selWhereAll($where, $where2 = true)
    {
        if ($where2) {
            return DB::table('use_demand')
                ->where('add_time', '>', $where)
                ->where(['quote' => 0])
                ->where('user_id', '!=', session('user_id'))
                ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
                ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
                ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
                ->get();
        } else {
            return DB::table('use_demand')
                ->where($where)
                ->where($where2[0], $where2[1], $where2[2])
                ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
                ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
                ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
                ->get();
        }
    }

    /**
     * @param $file string 变更字段
     * @param $where
     * @return mixed
     */
    protected function selFileAs($file, $where, $where2 = true)
    {
        if ($where2) {
            return DB::table('use_demand')
                ->select($file)
                ->where($where)
                ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
                ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
                ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
                ->get();
        } else {
            return DB::table('use_demand')
                ->select($file)
                ->where($where)
                ->where($where2[0], $where2[1], $where2[2])
                ->leftJoin('column', 'column.id', '=', 'use_demand.column_id')
                ->leftJoin('quote', 'quote.demand_id', '=', 'use_demand.id')
                ->leftJoin('use', 'use.id', '=', 'use_demand.user_id')
                ->get();
        }
    }

}
