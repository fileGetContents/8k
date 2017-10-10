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
            // https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
            $accJson = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $config::APPID . '&secret=' . $config::APPSECRET . '&code=' . $_GET["code"] . '&grant_type=authorization_code ');
            $accArray = json_decode($accJson, true);
            $infoJson = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token=' . $accArray["access_token"] . '&openid=' . $accArray['openid'] . '&lang=zh_CN ');
            $infoArray = json_decode($infoJson, true);

            $whether = $this->PurposeModel->selectFirst('use', [
                'nick' => $infoArray['nickname'],
                'openid' => $infoArray['openid'],
                'headimgurl' => $infoArray['headimgurl'],
            ]);
            if (!is_null($whether)) {
                $request->session()->put('user_id', $whether->id);
                // 更新头像
                $this->PurposeModel->up('use', ['id' => $whether->id], ['headimgurl' => $infoArray['headimgurl']]);
            } else {
                $id = $this->PurposeModel->insertGetId('use', [
                    'nick' => $infoArray['nickname'],
                    'openid' => $infoArray['openid'],
                    'headimgurl' => $infoArray['headimgurl'],
                ]);
                $request->session()->put('user_id', $id);
            }
            echo '<script type="text/javascript">window.location.href="http://www.xcylkj.com/public/person"</script>';
        } else {
            $baseUrl = urlencode('http://www.xcylkj.com/public/wx/user/info');
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $config::APPID . '&redirect_uri=' . $baseUrl . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
        }

    }


}
