<?php

namespace App\Http\Controllers;

use App\Http\Model;
use App\Http\Requests;
use Illuminate\Http\Request;


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

        $string = '{
 	"button":[
 	{
    	"type":"click",
    	"name":"今日歌曲",
     	"key":"V1001_TODAY_MUSIC"
	},
	{
		"name":"菜单",
		"sub_button":[
		{
			"type":"view",
			"name":"搜索",
			"url":"http://www.soso.com/"
		},
                 {
                         "type":"miniprogram",
                         "name":"wxa",
                         "url":"http://mp.weixin.qq.com",
                         "appid":"wx286b93c14bbf93aa",
                         "pagepath":"pages/lunar/index"
                   },
     		    {
			"type":"click",
			"name":"赞一下我们",
			"key":"V1001_GOOD"
	       	}]
 }],
"matchrule":{
  "tag_id":"2",
  "sex":"1",
  "country":"中国",
  "province":"广东",
  "city":"广州",
  "client_platform_type":"2",
  "language":"zh_CN"
  }
}';
        echo '<pre>';
        var_dump(json_decode($string, true));
        $arr = [
            'button' => [
                [
                    "type" => "view",
                    "name" => '我的生意',
                    "url" => URL('connectbussiness')
                ],
                [
                    'name' => '我的福利',
                    'sub_button' => [
                        [
                            'type' => 'view',
                            'name' => '积分充值',
                            'url' => URL('jifen')
                        ],
                        [
                            'type' => 'view',
                            'name' => '积分记录',
                            'url' => URL('jifen/info')
                        ],
                        [
                            'type' => 'view',
                            'name' => '成单秘籍',
                            'url' => URL('secrets')
                        ],
                    ]
                ],
                [
                    'name' => '跟多',
                    'sub_button' =>
                        [
                            [
                                'type' => 'view',
                                'name' => '商户主页',
                                'url' => URL('company')
                            ],
                            [
                                'type' => 'view',
                                'name' => '个人中心',
                                'url' => URL('person')
                            ],
                            [
                                'type' => 'view',
                                'name' => '关于8公里',
                                'url' => URL('abouts/us')
                            ],
                            [
                                'type' => 'view',
                                'name' => '通用设置',
                                'url' => 'www.baidu.com'
                            ]

                        ]

                ]


            ],
            'matchrule' => [
                'tag_id' => 'user',
                'language' => 'zh_CN',
            ]
        ];
        echo json_encode($arr);
//        return view('test');
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


}
