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
            $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
            $smsConf = array(
                'key' => '2c569923d5b095b89e532795ed471972', //您申请的APPKEY
                'mobile' => $subject, //接受短信的用户手机号码
                'tpl_id' => '47033', //您申请的短信模板ID，根据实际情况修改
                'tpl_value' => '【驰瑞微帮】您的验证码是#code#=' . $info . '。如非本人操作，请忽略本短信' //您设置的模板变量，根据实际情况修改
            );
            $content = self::juhecurl($sendUrl, $smsConf, 1); //请求发送短信
            if ($content) {
                $result = json_decode($content, true);
                $error_code = $result['error_code'];
                if ($error_code == 0) { // 短信发送成功
                    session(['info' => $info]);
                    echo collect(array('info' => 0, 'message' => $info))->toJson();
                } else {
                    //状态非0，说明失败
                    echo collect(array('info' => 1, 'message' => 'error'))->toJson();
                }
            } else {
                echo collect(array('info' => 1, 'message' => 'error'))->toJson();
            }
        } else {
            echo collect(array('info' => 1, 'message' => 'error'))->toJson();
        }
    }


    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    private function juhecurl($url, $params = false, $ispost = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
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
