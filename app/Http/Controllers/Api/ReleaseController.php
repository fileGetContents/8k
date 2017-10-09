<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model;

class ReleaseController extends Controller
{
    private $file = 'Release.';
    private $db;
    private $userArry;


    public function __construct()
    {
        $this->db = new Model\PurposeModel();
        $this->userArry = array('need_id' => session('user_id', 1), 'add_time' => $_SERVER['REQUEST_TIME'], 'tag' => 0);
    }


    public function index()
    {
        return view('release_choose');
    }

    /**
     * 个人搬家
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function peopleMove(Request $request)
    {
        // 添加个人搬家
        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('people_move', array(
                'car' => $request->input('car'),
                'carry' => $request->input('carry'),
                'elevator_home' => $request->input('elevator'),
                'elevator_new' => $request->input('elevator'),
                'time' => $request->input('time'),
                'depart' => $request->input('depart'),
                'purpose' => $request->input('purpose'),
                'replenish' => $request->input('replenish'),
                'need_id' => session('user_id', 1),
                'add_time' => $_SERVER['REQUEST_TIME'],
                'tag' => 0
            ));
            if (is_numeric($id) && $id > 0) {
                echo '添加成功';
            } else {
                echo '添加失败';
            }
        }
        return view($this->file . 'PeopleMove');
    }

    /**
     * 货运搬运
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function GoodService(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('good_service', array(
                'car' => $request->input('car'),
                'carry' => $request->input('carry'),
                'time' => $request->input('time'),
                'depart' => $request->input('depart'),
                'purpose' => $request->input('purpose'),
                'replenish' => $request->input('replenish'),
                'add_time' => $_SERVER['REQUEST_TIME'],
                'need_id' => session('user_id', 1),
                'tag' => 0,
            ));
            if (is_numeric($id) && $id > 0) {
                echo '成功';
            } else {
                echo '失败';
            }
        }
        return view($this->file . 'GoodService');
    }


    /**
     * 长途搬家搬运
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function longDistance(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('long_distance', array(
                'way' => $request->input('way'),
                'elevator_home' => $request->input('elevator'),
                'elevator_new' => $request->input('elevator1'),
                'time' => $request->input('time'),
                'sever_all' => serialize($request->input('server')),
                'depart' => $request->input('depart'),
                'purpose' => $request->input('purpose'),
                'replenish' => $request->input('replenish'),
                'add_time' => $_SERVER['REQUEST_TIME'],
                'need_id' => session('user_id', 1),
                'tag' => 0
            ));
            if (is_numeric($id) && $id > 0) {
                echo '成功';
            } else {
                echo '失败';
            }
        }

        return view($this->file . 'LongDistance');
    }

    /**
     * 公司搬家
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function companyMove(Request $request)
    {

        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('company_move', array(
                'company' => $request->input('company'),
                'fragile' => $request->input('fragile'),
                'elevator_home' => $request->input('elevator'),
                'elevator_new' => $request->input('elevator1'),
                'time' => $request->input('time'),
                'depart' => $request->input('depart'),
                'purpose' => $request->input('purpose'),
                'server_all' => serialize($request->input('server')),
                'replenish' => $request->input('replenish'),
                'add_time' => $_SERVER['REQUEST_TIME'],
                'need_id' => session('user_id', 1),
                'tag' => 0
            ));
            if (is_numeric($id) && $id > 0) {
                echo 'success';
            } else {
                echo 'error';
            }
        }

        return view($this->file . 'CompanyMove');
    }


    /**
     * 设备搬迁
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function equipmentMove(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('equipment_move', array(
                'project' => serialize($request->input('project')),
                'equipment' => $request->input('equipment'),
                'num' => $request->input('num'),
                'm' => $request->input('m'),
                'time' => $request->input('time'),
                'depart' => $request->input('depart'),
                'purpose' => $request->input('purpose'),
                'replenish' => $request->input('replenish'),
                'add_time' => $_SERVER['REQUEST_TIME'],
                'need_id' => session('user_id', 1),
                'tag' => 0
            ));
            if (is_numeric($id) && $id > 0) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
        return view($this->file . 'EquipmentMove');
    }

    /**
     * 起重吊装
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lifting(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('lifting', [
                'obj' => $request->input('obj'),
                'cycle' => $request->input('cycle'),
                'm' => $request->input('m'),
                'weight' => $request->input('weight'),
                'num' => $request->input('num'),
                'time' => $request->input('time'),
                'depart' => $request->input('depart'),
                'replenish' => $request->input('replenish'),
                'add_time' => $_SERVER['REQUEST_TIME'],
                'need_id' => session('user_id', 1),
                'tag' => 0
            ]);
            if (is_numeric($id) && $id > 0) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
        return view($this->file . 'Lifting');
    }

    /**
     * 钢琴搬运
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pianoMove(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('piano_move', array_merge($this->userArry, $request->all()));
            if (is_numeric($id) && $id > 0) {
                echo 'success';
            } else {
                echo 'error';
            }

        }
        return view($this->file . 'PianoMove');
    }

    /**
     * 空调移机
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function airConditioning(Request $request)
    {
        if ($request->isMethod('post')) {
            $arr = $request->all();
            $arr['server'] = serialize($request->input('server'));
            $id = $this->db->insertGetId('air_conditioning', array_merge($this->userArry, $arr));
            if (is_numeric($id) && $id > 0) {
                echo $id;
            } else {
                echo $id;
            }
        }
        return view($this->file . 'AirConditioning');
    }

    /**
     * 家具拆装
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function furnitureDisassembling(Request $request)
    {
        if ($request->isMethod('post')) {
            $insert = $request->all();
            $insert['material'] = serialize($request->input('material'));
            $insert['server'] = serialize($request->input('server'));
            $id = $this->db->insertGetId('furniture_disassembling', array_merge($this->userArry, $insert));
            if ($id > 0 && is_numeric($id)) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
        return view($this->file . 'FurnitureDisassem');
    }


    /**
     * 行李托运
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baggage(Request $request)
    {
        if ($request->isMethod('post')) {
            $insert = $request->all();
            $insert['packaging'] = serialize($request->input('packaging'));
            $insert['contains'] = serialize($request->input('contains'));
            $insert['server'] = serialize($request->input('server'));
            $id = $this->db->insertGetId('baggage', array_merge($this->userArry, $insert));
            if (is_numeric($id) && $id > 0) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
        return view($this->file . 'baggage');
    }


    /**
     * 国际速运
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function internationalSeed(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $this->db->insertGetId('International_seed',array_merge($this->userArry,$request->all()));
            $this->whether($id);
        }
        return view($this->file . 'InternationalSeed');
    }

    /**
     *
     * @param $id
     */
    public  function whether($id)
    {
        if ($id > 0 && is_numeric($id)) {
            echo 'success';
        } else {
            echo 'error';
        }

    }

}
