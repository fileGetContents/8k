<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Wechate;

class WechateController extends WebController
{


    public function userInfo()
    {
        $config = new Wechate\WxPayConfig();

        if (isset($_GET['code'])) {
            // https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
            $accJson = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $config::APPID . '&secret=SECRET&code=' . $_GET["code"] . '&grant_type=authorization_code ');
            $accarr = collect($accJson[0])->toArray();
            var_dump($accarr);
            $info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token=' . $accarr["access_token"] . '&openid=' . $accarr['openid'] . '&lang=zh_CN ');
            var_dump($info);
        } else {
            $baseUrl = urlencode('http://www.xcylkj.com/public/wx/user/info');
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $config::APPID . '&redirect_uri=' . $baseUrl . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
        }

    }


}
