<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model;

class HerDomesticController extends Controller
{

    private $db;
    private $file = 'HerDomestic.';
    private $userArry;

    public function __construct()
    {
        $this->db = new Model\PurposeModel();
        $this->userArry = array('need_id' => session('user_id', 1), 'add_time' => $_SERVER['REQUEST_TIME'], 'tag' => 0);
    }

    /**
     * 月嫂
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function her(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->whether($this->db->insertGetId('her', array_merge($this->userArry, $request->all())));
        }
        return view($this->file . 'Her');
    }


    /**
     * 病人陪护
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function patientEscort(Request $request)
    {
        if ($request->isMethod('post')) {
            $insert = $request->all();
            $insert['server'] = serialize($request->input('server'));
            $insert['type'] = serialize($request->input('type'));
            $this->whether($this->db->insertGetId('patient_escort', array_merge($this->userArry, $insert)));
        }
        return view($this->file . 'PatientEscort');
    }


    /**
     * 住家保姆
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nanny(Request $request)
    {
        if ($request->isMethod('post')) {
            $insert = $request->all();
            $insert['server'] = serialize($request->all());
            $this->whether($this->db->insertGetId('nanny', array_merge($this->userArry, $insert)));
        }
        return view($this->file . 'Nanny');
    }


    /**
     * 家政服务
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function domesticService(Request $request)
    {
        if ($request->isMethod('post')) {
            $insert = $request->all();
            $insert['week'] = serialize($request->input('week'));
            $insert['server'] = serialize($request->input('server'));
            $this->whether($this->db->insertGetId('domestic_service', array_merge($this->userArry, $insert)));
        }
        return view($this->file . 'DomesticService');
    }


    /**
     * 育婴师
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nurseryTeacher(Request $request)
    {
        if ($request->isMethod('post')) {
            $insert = $request->all();
            $insert['certificate'] = serialize($request->input('certificate'));
            $insert['server'] = serialize($request->input('server'));
            $this->whether($this->db->insertGetId('nursery_teacher', array_merge($insert, $this->userArry)));
        }
        return view($this->file . 'NurseryTeacher');
    }

    /**
     * 陪护
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function escort(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->whether($this->db->insertGetId('escort', array_merge($this->userArry, $request->all())));
        }
        return view($this->file . 'Escort');
    }


    /**
     * 涉外家政
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function foreignDomestic(Request $request)
    {

        return  view($this->file . 'ForeignDomestic');
    }


    /**
     * @param $id
     */
    public function whether($id)
    {
        if ($id > 0 && is_numeric($id)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }


}
