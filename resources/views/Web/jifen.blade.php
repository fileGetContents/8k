<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>积分充值</title>
    <link rel="stylesheet" href="{{asset('css/jifen.css')}}"/>
</head>
<body>
<div class="content">
    <div class="person-head">
        <div class="head-img">
            <img src="{{$user->headimgurl}}">
            <p>您当前账户剩余积分:<span class="data">{{ $user->recharge }}</span></p>
        </div>
    </div>
    <div class="tit">
        <hr/>
        <span>请选择积分套餐</span>
        <hr/>
    </div>
    <ul class="section">
        <li class="box">
            <p>20积分</p>
            <p>￥30</p>
        </li>
        <li class="box">
            <p>68积分</p>
            <p>￥100</p>
        </li>
        <li class="box">
            <p>220积分</p>
            <p>￥300</p>
        </li>
        <li class="box box-bg">
            <p>400积分</p>
            <p>￥300</p>
        </li>
        <li class="box">
            <p>800积分</p>
            <p>￥1000</p>
        </li>
        <li class="box youhui">
            <p>￥</p>
            <p>优惠券充值</p>
        </li>
    </ul>
    <div class="bigbox">
        <div class="section1">
            <input type="number" id="num" value="20"/>
            <p>支付金额:<span>￥30元</span></p>
        </div>
        <div class="section2">
            <img src="{{asset('img/danger.png')}}" width="15px" height="auto">零售点数为1.5元/积分
        </div>
    </div>

    <div class="tit" style="margin-top: 10px;">
        <div style="margin-left: 20%;margin-top: 5px;">
            <img src="{{asset('img/phone.png')}}" width="20px" height="auto">
        </div>
        <div>专属顾问 刘女士 18789090989</div>
    </div>
    <div class="mess">Copyright@2016-2017 8公里 沪ICP备2089786号-3</div>
</div>
<div class="footer">
    <button id="paybtn" class="paybtn">立即充值</button>
</div>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jifen.js')}}"></script>
<script>
    $(function () {
        $("#num").change(function () {
            var num = parseInt($(this).val());
            $(this).val(num);
            var price = num * 1.5;
            $(this).next().html('支付金额:<span>￥' + price + '元</span>')
        });
        var array = new Array([20, 30], [68, 100], [220, 300], [400, 500], [800, 1000], [0, 0]);
        $("#paybtn").click(function () {
            var index = $('.active').index();
            // console.log(array[index])
            var price = '';
            var recharge = '';
            if (array[index][0] == 0) {
                recharge = parseInt($('#num').val());
                price = recharge * 1.5;
            } else {
                recharge = array[index][0];
                price = array[index][1]
            }
            $.ajax({
                type: 'post',
                data: {'price': price, 'recharge': recharge},
                dataType: 'json',
                url: '{{URL("add/recharge")}}',
                success: function (obj) {

                },
                error: function (obj) {

                }
            })
        });
    })
</script>
</body>
</html>
