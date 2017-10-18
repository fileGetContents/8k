<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\DB;

class PictureController extends WebController
{

    public $file = 'Admin.';

    public function PictureAdd()
    {
        return view($this->file . 'picture-add');
    }

    /**
     *ajax添加选项
     *
     * @param Request $request
     */
    public function ajaxAddColumn(Request $request)
    {
        $input = $request->all();
        $insert['column_id'] = $input['id'];
        $insert['sort'] = $input['soft'];
        $insert['prompting'] = self::createMean($input['mean'], $input['required']);
        $insert['mean'] = $input['mean'];
        if (isset($_POST['required'])) {
            $insert['required'] = $input['required'];
        } else {
            $insert['required'] = 0;
        }
        $insert['name'] = $input['name'] . $_SERVER['REQUEST_TIME'];
        switch ($input['choose']) {
            case 1:
                $insert['choose'] = self::createRadio(array_filter(explode('/', $input['string'])), $insert['name']);
                break;
            case 2:
                $insert['choose'] = self::createCheckbox(array_filter(explode('/', $input['string'])), $input['name']);
                break;
            case 3:
                $insert['choose'] = self::createText(array_filter(explode('/', $input['string'])), $input['name']);
                break;
            case 4:
                $insert['choose'] = self::createTextarea($input['string'], $input['name']);
                break;
            case 5:
                $insert['choose'] = self::createTime();
                break;
        }
        $whether = $this->PurposeModel->insertWhether('options', $insert);
        if ($whether) {
            return collect(['info' => 0, 'message' => 'success']);
        } else {
            return collect(['info' => 1, 'message' => 'error']);
        }

    }


    /**
     * 创建选项提示语言
     *
     * @param $string string
     * @param $required int
     * @return string
     */
    private function createMean($string, $required)
    {
        if ($required == 1) {
            $string = '<p>' . $string . '<span class="calm">(必填)</span></p>';
        } else {
            $string = '<p>' . $string . '</p>';
        }
        return $string;
    }

    /**
     * 创建单选框
     *
     * @param array $choose array
     * @param $fileName string
     * @return string
     */
    private function createRadio($choose = array(), $fileName)
    {
        $string = '<table class="table1">';
        foreach ($choose as $key => $value) {
            $string .= '<tr><td><input type="radio" name="' . $fileName . '" class="' . $fileName . '" value="' . $value . '" />' . $value . '</td></tr>';
        }
        $string .= '</table>';
        return $string;
    }

    /**
     * 创建多选框
     *
     * @param array $choose
     * @param $fileName
     * @return string
     */
    private function createCheckbox($choose = array(), $fileName)
    {
        $string = '<table class="table1">';
        foreach ($choose as $value) {
            $string .= '<tr><td><input type="checkbox" name="' . $fileName . '[]"  class="' . $fileName . '"  value="' . $value . '">' . $value . '</td></tr>';
        }
        $string .= '</table>';
        return $string;
    }


    /**
     * 创建地址框
     *
     * @param $choose array
     * @param $fileName string
     * @return string
     */
    private function createText($choose, $fileName)
    {
        $string = '';
        foreach ($choose as $key => $value) {
            $key = $key + 1;
            $string .= '<div class="choseplace">
                           <div class="dateimg">
                              <img src="' . asset('img/dizhi.png') . '" width="20px" height="auto"></div><div>
                                 <input  id="suggestId' . $key . '" name="' . $fileName . '[]" class="place  ' . $fileName . '" placeholder="' . $value . '">
                           </div>
                           <span>&gt;&gt;</span>
                         </div>';
        }
        return $string;
    }

    /**
     * 创建输入框
     *
     * @param $choose
     * @param $fileName
     * @return string
     */
    private function createTextarea($choose, $fileName)
    {
        return '   <textarea name="' . $fileName . '" class="state ' . $fileName . '" placeholder="' . $choose . '"></textarea>';
    }


    /**
     * 创建时间选择框
     *
     * @param $choose
     * @param $fileName
     * @return string
     */
    private function createTime()
    {
        $string = '
           <div class="chosedate">
                <div class="dateimg"><img src="' . asset("img/date.png") . '"></div>
                <div><input name="datetime" class="ui_timepicker" id="start_date" placeholder="选择时间" readonly="readonly"></div>
                <span>&gt;&gt;</span>
           </div>
           <div class="chosedate">
                <div class="dateimg"><img src="' . asset("img/time.png") . '"></div>
                <div><div class="time_pick"><input name="time" class="ui_timepicker" placeholder="选择时间" readonly="readonly" id="time"><div class="timepicker_wrap" style="top: 30px; left: 0px;"><div class="arrow_top"></div><div class="time"><div class="prev"></div><div class="ti_tx"></div><div class="next"></div></div><div class="mins"><div class="prev"></div><div class="mi_tx"></div><div class="next"></div></div><div class="meridian"><div class="prev"></div><div class="mer_tx"></div><div class="next"></div></div></div></div></div>
                <span>&gt;&gt;</span>
           </div>';
        return $string;
    }

    /**
     * 查看V申请
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function PictureList(Request $request)
    {
        if ($request->isMethod('post')) {
            $documents = DB::table('documents')
                ->where('time', '>', strtotime($request->input('start')))
                ->orWhere('time', '<', strtotime($request->input('over')))
                ->get();
        } else {
            $documents = DB::table('documents')->get();
        }
        foreach ($documents as $key => $value) {
            $documents[$key]->documents = unserialize($value->documents);
        }
        return view($this->file . 'picture-list')->with([
            'doc' => $documents
        ]);


    }


    public function PictureShow()
    {

        return view($this->file . 'picture-show');
    }

    /**
     * 认证列表
     * @return $this
     */
    public function identifyList(Request $request)
    {
        if ($request->isMethod('post')) {
            $identify = DB::table('identify')
                ->leftJoin('use', 'use.id', '=', 'identify.use_id')
                ->orderBy('identify_id', 'desc')
                ->where('time', '>', strtotime($request->input('start')))
                ->orWhere('time', '<', strtotime($request->input('over')))
                ->get();
        } else {
            $identify = DB::table('identify')
                ->leftJoin('use', 'use.id', '=', 'identify.use_id')
                ->orderBy('identify_id', 'desc')
                ->get();
        }

        foreach ($identify as $key => $value) {
            $identify[$key]->images = unserialize($value->images);
        }

        return view($this->file . 'indenty-list')->with([
            'identify' => $identify
        ]);
    }


}
