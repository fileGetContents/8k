<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    protected $file = 'Admin.';
    protected $PurposeModel;

    public function __construct()
    {
        $this->PurposeModel = new Model\PurposeModel();
    }

    /**
     * 添加选项
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ProductAdd()
    {
        return view($this->file . 'product-add')->with([
            'column' => $this->PurposeModel->selectAll('column', ['depth' => 1])
        ]);
    }


    public function ProductBrand()
    {
        $identify = DB::table('identify')
            ->leftJoin('use', 'use.id', '=', 'identify.use_id')
            ->orderBy('identify_id', 'desc')
            ->paginate(15);
        return view($this->file . 'product-brand')->with([
            'identify' => $identify,
        ]);
    }

    /**
     *全部需求查看
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ProductCateGory(Request $request)
    {
        $parent = DB::table('column')->where('depth', '=', 0)->get();
        $string = '';
        foreach ($parent as $value) {
            $idp = $value->id + 1;
            $string = $string . ' {id: ' . $idp . ', pId:1 , name: "' . $value->column_name . '"},';
            $child = DB::table('column')->where('parent_id', '=', $value->id)->get();
            foreach ($child as $v) {
                $idc = $v->id;
                $string = $string . ' {id: ' . $idc . ', pId:' . $idp . ' , name: "' . $v->column_name . '"},';
            }
        }
        return view($this->file . 'product-category')->with([
            'string' => $string
        ]);
    }

    /**
     * 查看添加需求
     * @param Request $request
     * @return $this
     */
    public function ProductCateGoryAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $this->PurposeModel->insertGetId('column', $request->all());
            if (is_numeric($id) && $id > 0) {
                echo '<script>alert("添加成功")</script>';
            } else {
                echo '<script>alert("添加失败")</script>';
            }
        }
        $column = $this->PurposeModel->selectAll('column', array('parent_id' => 0));
        return view($this->file . 'product-category-add')->with([
            'column' => $column
        ]);
    }

    public function ProductList()
    {
        // 获取栏目位置
        $parent = DB::table('column')->where('depth', '=', 0)->get();
        $string = '';
        foreach ($parent as $value) {
            $idp = $value->id + 1;
            $string = $string . ' {id: ' . $idp . ', pId:1 , name: "' . $value->column_name . '"},';
            $child = DB::table('column')->where('parent_id', '=', $value->id)->get();
            foreach ($child as $v) {
                $idc = $v->id;
                $string = $string . ' {id: ' . $idc . ', pId:' . $idp . ' , name: "' . $v->column_name . '"},';
            }
        }

        return view($this->file . 'product-list')->with([
            'string' => $string
        ]);
    }

    /**
     * 获取选项
     *
     * @param Request $request
     */
    public function getColumnInput(Request $request)
    {
        $column = DB::table('column')->where('column_name', 'like', '%' . $request->input('name', '钢琴搬运') . '%')->first();
        $options = DB::table('options')->where('column_id', '=', $column->id)->orderBy('sort', 'asc')->get();
        $string = '';
        foreach ($options as $value) {
            $string .= $value->prompting . $value->choose;
            $string .= "<p class='other'>
                        <button  id='" . $value->id . "' class='del btn'>删除</button>
                        排序:<input type='text' value='" . $value->sort . "' >
                        必填与否:<select  class='req' name='required' ><option value='1'>必填</option><option value='0'>不需要</option></select>
                        </p>";
        }
        echo collect(array('message' => $string))->toJson();
    }


    private function test()
    {
        $column = DB::table('column')->where('column_name', 'like', '%' . $request->input('name', '钢琴搬运') . '%')->first();
        $options = DB::table('options')->where('column_id', '=', $column->id)->orderBy('sort', 'asc')->get();
        $string = '';
        foreach ($options as $value) {
            // 正则匹配
            preg_match_all('/<input.*?>/', $value->prompting, $v, PREG_PATTERN_ORDER); // 获取input框
            preg_match_all('|value="(.*)"|isU', $value->prompting, $u, PREG_PATTERN_ORDER); // 获取值
            // 拼接选项
            $inpStr = '';
            foreach ($v[0] as $key => $valueV) {
                $inpStr .= $valueV . '<input type="text" name="" value="' . $u[1][$key] . '" ><br/>';
            }
            // 拼接其他选项
            $string .= '<ul id="' . $value->id . '">
                         <li>选择栏提示语:<br/><input type="text" name="" value="' . $value->choose . '"></li>
                         <li>用户查看提示语：<br/><input type="text" name="" value="' . $value->mean . '" ></li>
                         <li>该字段的单词：<br/><input type="text" name="" value="' . $value->name . '" ></li>
                         <li>必填(1必填0无需必填):<br/><input type="text" name=""  value="' . $value->required . '"></li>
                         <li>排序:<br/><input type="text" name="" value="' . $value->sort . '"></li>
                         <li>需求选项:<br/>' . $inpStr . '</li>
                         <li class="addChoose">添加选项</li>
                        </ul><br><br><br><br><br>';
        }

    }

}
