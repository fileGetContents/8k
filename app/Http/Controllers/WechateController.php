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
                // 'nick' => $infoArray['nickname'],
                'openid' => $infoArray['openid'],
                // 'headimgurl' => $infoArray['headimgurl'],
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
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $config::APPID . '&redirect_uri=' . $baseUrl . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
            echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
        }

    }


    /**
     * 微信支付
     */
    public function pay($pay)
    {
        $tools = new Wechate\JsApiPay();
        $openId = $tools->GetOpenid();
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


}
