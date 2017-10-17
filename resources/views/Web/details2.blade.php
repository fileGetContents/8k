<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/details.css')}}"/>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/baguettebox.min.css')}}">
</head>
<body onload="init()">
<div class="content">
    <div class="ji">急</div>
    <p style="color: #3399FF;">({{$myOrder["telephone"]}})</p>
    <div class="controduce">
        感谢您的报价，我觉得还不错，想和你详细沟通一下，上面是我的联系手机，麻烦尽快与我联系，谢谢!
        <img src="{{asset('img/ion3.png')}}">
    </div>
    <div class="section2">
        <div class="sectiontop">
            <div class="smalltit">参考报价</div>
        </div>
        <p>报价金额：<span class="import">{{$need->price}}元</span></p>
        <p style="color:#868686 ;">价格可能上下浮动</p>
        {{--<div class="modalwrapper">--}}
        {{--<p>已经为您保存为<span class="import">报价模板</span>，方便下次报价使用</p>--}}
        {{--<div class="modalbox">--}}
        {{--<button class="smallbtn">报价模板</button>--}}
        {{--<span style="float: right;margin:10px 20px 0 10px;"> 100元</span>--}}
        {{--<p style="color: #DADADA;">留言:(暂未留言)</p>--}}
        {{--</div>--}}
        {{--<p style="margin-left: 10px;font-size: 0.8rem;">您可以在“通用设置中”设置更多模板<a href="modal.html">--}}
        {{--<button class="smallbtn2">立即设置</button>--}}
        {{--</a></p>--}}
        {{--</div>--}}
        <p>需求进度：<span>对方希望尽快与您取得联系</span></p>
        <p>Ta的联系电话号码是：{{$myOrder["telephone"]}}</p>
        {{--<p style="color:#868686 ;">我已经帮他解决了需求！--}}
        {{--<button class="evaluate import">邀请他评价</button>--}}
        {{--</p>--}}
        <p>您给TA的留言：</p>
        <div class="btnwrapper2">
            @if($user->server == 0 )
                <div class="btn2"><a href="{{URL('identifyv')}}">认证服务商</a></div>
            @endif
            @if($user->pay ==0)
                <div class="btn2"><a href="{{URL('identify')}}">先行赔付</a></div>
            @endif
        </div>
        <textarea class="textbox">我的电话号码是：{{$user->telephone}}，服务地点在空间，我们专业提供手机回收服务，希望可以帮您解决问题哦！</textarea>
        <button class="active" style="margin-left: 35%;">发送</button>
    </div>
    <br/>
    <br/>
    <div class="section2">
        @foreach($needClass as $key=> $value)
            <div class="tr">
                <span class="import">{{ $mean[$key] }}</span>
        <span>
        @if(is_array($value))
                @foreach($value as $va)
                    {{ $va }}
                @endforeach
            @else
                {{$value}}
            @endif
        </span>
            </div>
        @endforeach
    </div>
    <div id="container"></div>
    {{--<p class="import">图片说明：</p>--}}
    {{--<div class="container">--}}
    {{--<ul class="baguetteBoxOne gallery">--}}
    {{--<a href="{{asset('img/phone1.jpeg')}}">--}}
    {{--<li><img src="{{asset('img/phone1.jpeg')}}" alt="Cuo Na Lake"></li>--}}
    {{--</a>--}}
    {{--<a href="{{asset('img/phone2.jpeg')}}">--}}
    {{--<li><img src="{{asset('img/phone2.jpeg')}}" alt="Cuo Na Lake"></li>--}}
    {{--</a>--}}
    {{--<a href="{{asset('img/phone3.jpeg')}}">--}}
    {{--<li><img src="{{asset('img/phone3.jpeg')}}" alt="Cuo Na Lake"></li>--}}
    {{--</a>--}}
    {{--<a href="{{asset('img/phone4.jpeg')}}">--}}
    {{--<li><img src="{{asset('img/phone4.jpeg')}}" alt="Cuo Na Lake"></li>--}}
    {{--</a>--}}
    {{--<a href="{{asset('img/phone4.jpeg')}} ">--}}
    {{--<li><img src="{{asset('img/phone4.jpeg')}}" alt="Cuo Na Lake"></li>--}}
    {{--</a>--}}
    {{--</ul>--}}
</div>
<button class="addbtn">邀请需求方补充需求</button>
<div class="tit" style="margin-top: 10px;">
    <div style="margin-left: 10%;">
        <img src="{{asset('img/phone.png')}}" width="20px" height="auto">
    </div>
    <div>专属顾问 刘女士 18789090989</div>
</div>

</div>
<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="popup">
                <div class="popup-head">
                    <h5 class="popup-sub-title ng-binding">您还未通过加V认证，不能使用该标签哦~~</h5><!-- end ngIf: subTitle -->
                </div>
                <div class="popup-buttons">
                    <!-- ngRepeat: button in buttons -->
                    <button class="button button-default" data-dismiss="modal" aria-hidden="true">
                        暂不加v
                    </button><!-- end ngRepeat: button in buttons -->
                    <button class="button  button-energized" type="submit">
                        <b>申请加v</b>
                    </button><!-- end ngRepeat: button in buttons -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mymodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="popup">
                <div class="popup-head">
                    <h5 class="popup-sub-title ng-binding">您还未开通先行赔付，不能使用该标签哦~~</h5><!-- end ngIf: subTitle -->
                </div>
                <div class="popup-buttons">
                    <!-- ngRepeat: button in buttons -->
                    <button class="button button-default" data-dismiss="modal" aria-hidden="true">
                        我知道了
                    </button><!-- end ngRepeat: button in buttons -->
                    <button class="button  button-energized" type="submit">
                        <b><a href="{{URL()}}">了解先行赔付</a></b>
                    </button><!-- end ngRepeat: button in buttons -->
                </div>
            </div>
        </div>
    </div>
</div>
{{--<a href="#btnwrapper">--}}
{{--<div class="footer">--}}
{{--<button class="connectbtn">我要极速联系</button>--}}
{{--</div>--}}
{{--</a>--}}

{{--<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>--}}
{{--<script language="javascript" type="text/javascript" src="http://202.102.100.100/35ff706fd57d11c141cdefcd58d6562b.js"--}}
{{--charset="UTF-8">--}}
{{--</script>--}}
<script type="text/javascript" src="{{asset('js/details.js')}}"></script>
{{--<script type="text/javascript">--}}
{{--hQGHuMEAyLn('[id="bb9c190068b8405587e5006f905e790c"]');--}}
{{--</script>--}}
<script src="{{asset('js/baguettebox.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
    baguetteBox.run('.baguetteBoxOne', {
        animation: 'fadeIn',
    });
</script>
<script>
    $(function () {
        $('.active').click(function () {
            $.ajax({
                type: 'post',
                data: {'info': $('.textbox').html(), 'use_id': '{{$myOrder["id"]}}'},
                dataType: 'json',
                url: '{{URL("add/message")}}',
                success: function (obj) {
                    if (obj.info == 0) {
                        alert('添加留言成功')
                    }
                },
                error: function () {

                }
            })
        })
    })
</script>
</body>


</html>
