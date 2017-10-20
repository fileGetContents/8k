<?php

namespace App\Http\Controllers;

use App\Http\Model;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Wechate;

class WebController extends Controller
{
    public $file = 'Web.';
    public $PurposeModel;
    public $UserModel;
    public $WayClass;

    public function __construct()
    {
        $this->PurposeModel = new  Model\PurposeModel();
        $this->UserModel = new Model\UserModel();
        $this->WayClass = new Model\WayClassModel();
    }

    /**
     * 提交测试
     * @param Request $request
     */
    public function test(Request $request)
    {
        $this->WxUserInfo();
    }

    /**
     * 获取全部不重复服务项目
     *
     * @param $id int 用户id
     * @return array
     */
    protected function getServerAll($id = 1)
    {
        $server = $this->PurposeModel->selectAll('use_server', ['use_id' => $id]);
        $arrServer = array();
        foreach ($server as $v) {
            $unServer = unserialize($v->server);
            foreach ($unServer as $value) {
                foreach ($value as $va) {
                    $arrServer[] = $va;
                }
            }
        }
        $arrServer = array_unique($arrServer); // 去除重复的
        $columnServer = array();
        foreach ($arrServer as $key => $value) {
            $column = $this->PurposeModel->selectFirst('column', ['id' => $value]);
            $columnServer[$value] = $column->column_name;
        }
//        dump($columnServer);
        return $columnServer;
    }

    /**
     * @param $array
     * @param $id
     * @return array|bool
     */
    protected function getClassMeta($array, $id)
    {
        $return = array();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $options = $this->PurposeModel->selectFirst('options', ['column_id' => $id, 'name' => $key]);
                $return[$key] = $options->mean;
            }
            return $return;
        } else {
            return false;
        }
    }

    /**
     * 获取用户信息
     *
     * @param $id int
     * @return mixed
     */
    protected function getUserInfo($id = 1)
    {
        return $this->PurposeModel->selectFirst('use', ['id' => $id]);
    }


    /**
     * 微信登录
     */
    public function WxUserInfo()
    {
        $tools = new Wechate\JsApiPay();
        $openId = $tools->GetOpenid();
        $wx = new WechateController();
        $acc = $wx->getAccessToken();
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $acc['access_token'] . '&openid=' . $openId . '&lang=zh_CN';
        $json = file_get_contents($url);
        dump($json);
    }



}
