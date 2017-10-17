<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Wechate;

class WechateController extends WebController
{
    /**
     * 微信自动登录
     *
     * @param Request $request
     */
    public function userInfo(Request $request)
    {
        $config = new Wechate\WxPayConfig();
        if (isset($_GET['code'])) {
            $accJson = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $config::APPID . '&secret=' . $config::APPSECRET . '&code=' . $_GET["code"] . '&grant_type=authorization_code ');
            $accArray = json_decode($accJson, true);
            $infoJson = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token=' . $accArray["access_token"] . '&openid=' . $accArray['openid'] . '&lang=zh_CN ');
            $infoArray = json_decode($infoJson, true);
            $whether = $this->PurposeModel->selectFirst('use', [
                'openid' => $infoArray['openid'],
            ]);
            if (!is_null($whether)) {
                session(['user_id' => $whether->id]);
                // 更新头像
                $this->PurposeModel->up('use', ['id' => $whether->id], ['headimgurl' => $infoArray['headimgurl']]);
            } else {
                $id = $this->PurposeModel->insertGetId('use', [
                    'nick' => $infoArray['nickname'],
                    'openid' => $infoArray['openid'],
                    'headimgurl' => $infoArray['headimgurl'],
                ]);
                session(['user_id' => $id]);
            }
            echo '<script type="text/javascript">window.location.href="http://www.xcylkj.com/person"</script>';
        } else {
            $baseUrl = urlencode('http://www.xcylkj.com/wx/user/info');
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $config::APPID . '&redirect_uri=' . $baseUrl . '&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
        }
    }

    /**
     *公众号支付
     */
    public function pay($pay)
    {
        $tools = new Wechate\JsApiPay();
        //$openId = $tools->GetOpenid();
        $user = $this->PurposeModel->selectFirst('use', ['id' => session('user_id', 1)]);
        $openId = $user->openid;
        // ②、统一下单
        $input = new Wechate\WxPayUnifiedOrder();
        $input->SetBody($pay['body']);                           // 设置商品或支付单简要描述
        $input->SetAttach($pay['attach']);                       // 附加信息
        $input->SetOut_trade_no($pay['trade_no']);               // 商户订单号
        $input->SetTotal_fee($pay['total_fee']);                 // 订单总金额，只能为整数，详见支付金额
        $input->SetTime_start(date("YmdHis"));                   // 交易起始时间
        $input->SetTime_expire(date("YmdHis", time() + 36000));  // 交易结束时间
        //$input->SetGoods_tag("test");
        $input->SetNotify_url(Wechate\WxPayConfig::NOTIFY_URL);  // 回调地址
        $input->SetTrade_type("JSAPI");                          // 交易类型
        $input->SetOpenid($openId);
        $WxPayApi = new Wechate\WxPayApi();
        $order = $WxPayApi->unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        // 获取共享收货地址js函数参数
        //  $editAddress = $tools->GetEditAddressParameters();
        return $jsApiParameters;
    }


    /**
     * 切换用户标签
     */
    public function userTagsCreate(Request $request)
    {
        $opendId = $this->wxUserLogin('http://www.xcylkj.com/chang/tag/' . $request->id);
        if (is_numeric($request->id)) { // 添加标签
            $this->createUserTag($opendId);
        } else {  // 删除标签
            $this->delUserTag($opendId);
        }
        return view($this->file . 'changcreate');
    }


    /**
     * 创建一个自定义菜单
     *
     * @param Request $request
     */
    public function createMenu(Request $request)
    {
        $acc = $this->getAccessToken();
        $url2 = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $acc['access_token']; // 默认
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=' . $acc['access_token']; // 个性化
        $user = $this->WayClass->sendPost($url2, self::demandMenu());
        $server = $this->WayClass->sendPost($url, self::serverMenu());
    }

    /**
     * 创建用户视图
     * @return array
     */
    private function demandMenu()
    {
        return [
            'button' => [
                [
                    'name' => urlencode('我的需求'),
                    'sub_button' => [
                        [
                            'type' => 'view',
                            'name' => urlencode('需求进度'),
                            'url' => 'http://www.xcylkj.com/user/need',
                        ],
                        [
                            'type' => 'view',
                            'name' => urlencode('一键发布'),
                            'url' => 'http://www.xcylkj.com/show/serve'
                        ],
                    ]
                ],
                [
                    'name' => urlencode('更多'),
                    'sub_button' => [
                        [
                            'type' => 'view',
                            'name' => urlencode('个人中心'),
                            'url' => 'http://www.xcylkj.com/person'
                        ],
                        [
                            'type' => 'view',
                            'name' => urlencode('如何挑选服务商'),
                            'url' => 'http://www.xcylkj.com/service/provider'
                        ],
                        [
                            'type' => 'view',
                            'name' => urlencode('服务商功能'),
                            'url' => 'http://www.xcylkj.com/add/server'
                        ],
                        [
                            'type' => 'view',
                            'name' => urlencode('关于8公里'),
                            'url' => 'http://www.xcylkj.com/abouts/us'
                        ],
                        [
                            'type' => 'view',
                            'name' => urlencode('切换服务商视图'),
                            'url' => 'http://www.xcylkj.com/create/user/tag',
                        ]
                    ]
                ],
            ],
        ];
    }

    /**
     * 创建服务商视角
     * @return array
     */
    private function serverMenu()
    {
        return [
            'button' => [
                [
                    "type" => "view",
                    "name" => urlencode('我的生意'),
                    "url" => 'http://www.xcylkj.com/connectbussiness'
                ],
                [
                    'name' => urlencode('我的福利'),
                    'sub_button' => [
                        [
                            'type' => 'view',
                            'name' => urlencode('积分充值'),
                            'url' => 'http://www.xcylkj.com/jifen'
                        ],
                        [
                            'type' => 'view',
                            'name' => urlencode('积分记录'),
                            'url' => 'http://www.xcylkj.com/jifen/info'
                        ],
                        [
                            'type' => 'view',
                            'name' => urlencode('成单秘籍'),
                            'url' => 'http://www.xcylkj.com/secrets'
                        ],
                    ]
                ],
                [
                    'name' => urlencode('更多'),
                    'sub_button' =>
                        [
                            [
                                'type' => 'view',
                                'name' => urlencode('商户主页'),
                                'url' => 'http://www.xcylkj.com/company'
                            ],
                            [
                                'type' => 'view',
                                'name' => urlencode('个人中心'),
                                'url' => 'http://www.xcylkj.com/person'
                            ],
                            [
                                'type' => 'view',
                                'name' => urlencode('关于8公里'),
                                'url' => 'http://www.xcylkj.com/abouts/us'
                            ],
                            [
                                'type' => 'view',
                                'name' => urlencode('切换视图'),
                                'url' => 'http://www.xcylkj.com/del/user/tag'
                            ]
                        ]
                ]
            ],
            'matchrule' => [
                'tag_id' => '2',
                'language' => 'zh_CN',
            ]
        ];

    }


    /**
     * 获取微信AccessToken
     *
     * @return array
     */
    public function getAccessToken()
    {
        $config = new Wechate\WxPayConfig();
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $config::APPID . '&secret=' . $config::APPSECRET;
        $accJson = file_get_contents($url);
        return json_decode($accJson, true);
    }

    /**
     *  查询自定义菜单
     */
    public function getMenuList()
    {
        $acc = $this->getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $acc['access_token'];
        $accJson = file_get_contents($url);
        /// dump($accJson);
    }

    /**
     * 删除自定义菜单
     */
    public function delMenu()
    {
        $acc = $this->getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $acc['access_token'];
        $accJson = file_get_contents($url);
        dump($accJson);
    }

    /**
     * 创建用户标签
     * @param  $openid string
     * @return  string
     */
    public function createUserTag()
    {
        $acc = $this->getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=' . $acc['access_token'];
        // 获取用户的openid
        $openid = $this->wxUserLogin('http://www.xcylkj.com/create/user/tag');
        // 查看是否成为服务商
        $server = $this->PurposeModel->selectFirst('use_server', ['use_id' => session('user_id', 1)]);
        if (is_null($server)) {  // 跳转服务商
            return redirect('add/server');
        }
        $data = [
            'openid_list' => [$openid],
            "tagid" => 2
        ];
        $json = $this->WayClass->sendPost($url, $data);
        //return $json;
        return view($this->file . 'change');
    }

    /**
     * 删除用户标签
     * @param $openid
     * @return string
     */
    public function delUserTag()
    {
        $acc = $this->getAccessToken();
        $openid = $this->wxUserLogin('http://www.xcylkj.com/create/user/tag');
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=' . $acc['access_token'];
        $data = [
            'openid_list' => [$openid],
            'tagid' => 2,
        ];
        $json = $this->WayClass->sendPost($url, $data);
        return view($this->file . 'change');
    }


    /**
     *
     * 以登录的方式获取openid
     * @param $stringUrl1
     */
    public function wxUserLogin($stringUrl1)
    {
        $config = new Wechate\WxPayConfig();
        if (isset($_GET['code'])) {
            $accJson = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $config::APPID . '&secret=' . $config::APPSECRET . '&code=' . $_GET["code"] . '&grant_type=authorization_code ');
            $accArray = json_decode($accJson, true);
            $infoJson = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token=' . $accArray["access_token"] . '&openid=' . $accArray['openid'] . '&lang=zh_CN ');
            $infoArray = json_decode($infoJson, true);
            $whether = $this->PurposeModel->selectFirst('use', [
                'openid' => $infoArray['openid'],
            ]);
            if (!is_null($whether)) {
                session(['user_id' => $whether->id]);
                // 更新头像
                $this->PurposeModel->up('use', ['id' => $whether->id], ['headimgurl' => $infoArray['headimgurl']]);
            } else {
                $id = $this->PurposeModel->insertGetId('use', [
                    'nick' => $infoArray['nickname'],
                    'openid' => $infoArray['openid'],
                    'headimgurl' => $infoArray['headimgurl'],
                ]);
                session(['user_id' => $id]);
            }
            return $infoArray['openid'];
        } else {
            $baseUrl = urlencode($stringUrl1);
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $config::APPID . '&redirect_uri=' . $baseUrl . '&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
        }
    }

    /**
     * 设置所属行业
     */
    public function setTemplate()
    {
        $acc = $this->getAccessToken();
        //  $url = 'https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=' . $acc['access_token'];
        $json = file_get_contents("https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=" . $acc['access_token']);
        //  $json = $this->WayClass->sendPost($url, ['industry_id1' => 1, 'industry_id12' => 1]);
        var_dump($json);
    }

    /**
     * 支付回调地址
     */
    public function notifyUrl(Request $request)
    {
        header("Content-type:text/xml;charset=utf-8");
        $xmkOK = "<?xml version='1.0' encoding='utf-8'?><xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";  // 成功
        $xmkNO = "<?xml version='1.0' encoding='utf-8'?><xml><return_code><![CDATA[ERROR]]></return_code><return_msg><![CDATA[NO]]></return_msg></xml>";    // 失败
        $xml = file_get_contents('php://input', 'r');   // 获取xml数
        $base = new Wechate\WxPayResults();
        $data = $base->FromXml($xml);
        switch ($data['return_code']) {
            case  'FAIL';
                echo $xmkNO;
                break;
            case 'SUCCESS';
                if ($data['result_code'] == "SUCCESS") {
                    if ($data['attach'] == 'recharge') { // 积分充值
                        $row = DB::table($data['attach'])
                            ->where('order_num', '=', $data['out_trade_no'])
                            ->update(array(
                                'order_tag' => 10, // 支付完成
                            ))
                            ->get();
                        if ($row) {
                            $recharge = $this->PurposeModel->selectFirst($data['attach'], ['order_num', '=', $data['out_trade_no']]);
                            if (!is_null($recharge)) {
                                DB::table($data['attach'])->increment('recharge', $recharge->recharge);
                                $this->UserModel->addRecharge($recharge->recharge, '积分充值');
                                echo $xmkOK;
                            } else {
                                echo $xmkNO;
                            }
                        } else {
                            echo $xmkNO;
                        }
                    } else { // V认证保证金
                        $row = DB::table($data['attach'])
                            ->where('order_num', '=', $data['out_trade_no'])
                            ->update(array(
                                'order_tag' => 10, // 支付完成
                            ))
                            ->get();
                        if ($row) {
                            echo $xmkOK;
                        } else {
                            echo $xmkNO;
                        }
                    }

                } else {
                    echo $xmkNO;
                }
        }


        echo $xmkOK; // 返回成功
    }


}
