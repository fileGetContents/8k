<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>v认证</title>
    <link rel="stylesheet" href="{{asset('css/identifyxianxing.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/zyUpload.css')}}" type="text/css">
</head>
<body>
<div class="content">
    <div class="header">
        <img src="{{asset('img/xianxing.png')}}">
    </div>
    <div class="section" id="section">
        <div class="messbox">
            <h4>为什么升级为先行赔付服务商</h4>
            <ol>
                <li>配有先行赔付徽章标识，提升竞争力；</li>
                <li>以资金来保障服务彰显商家诚信度与公信力</li>
                <li>优先推荐，快速达成协议，提高成单率</li>
                <li>专属服务顾问，随时咨询</li>
            </ol>
            <p>更多详情请咨询：1668-387-23</p>
        </div>
        <div class="messbox">
            <p>上传有效证件(照片清晰不超过5M)</p>
            <p style="color:#D02D00 ;">[个人需身份证/企业需营业执照]</p>
            <div id="demo" class="demo" style="width: 100%;"></div>
            <p class="money">*选择您要缴纳的保证金金额，保证金可随时申请退还</p>
            <div class="btnwrapper">
                <div class="btn">1000元</div>
                <div class="btn">2000元</div>
                <div class="btn">3000元</div>
                <div class="btn">3000元</div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <button id="sendbtn" class="sendbtn">提交申请</button>
</div>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/zyFile.js')}}"></script>
<script type="text/javascript" src="{{asset('js/zyUpload.js')}}"></script>
<script type="text/javascript" src="{{asset('js/demo.js')}}"></script>
<script type="text/javascript" src="{{asset('js/identifyxianxing.js')}}"></script>
<script>
    $(function () {
        $('#sendbtn').click(function () {
            var string = '';
            $("input[name=updateName]").map(function () {
                string += $(this).val() + "/"
            });
            if (string == '') {
                alert('请上传图片');
                return false;
            }
            var price = $('.hover').html();
            if (price == null) {
                alert('选择金额');
                return false;
            }
            // 添加进入数据库
            $.ajax({
                type: 'post',
                data: {'string': string, 'price': price},
                dataType: 'json',
                url: '{{ URL("add/identify") }}',
                success: function (obj) {
                    WeixinJSBridge.invoke(
                            'getBrandWCPayRequest', obj.message,
                            function (res) {
                                WeixinJSBridge.log(res.err_msg);
                            }
                    );
                },
                error: function (obj) {

                }
            })
        });
    });
</script>

</body>
</html>
