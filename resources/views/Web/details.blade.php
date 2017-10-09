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
</head>
<body onload="init()">
<div class="content">
    <p style="color: #3399FF;" data-toggle="modal" data-target="#mymodal">(153*****88)</p>
    <div class="mess">
        <div>
            <p><span><img src="{{asset('img/people.png')}}" width="15px" height="auto"></span>{{ $need->quote }}/5</p>
            <p>收到报价</p>
        </div>
        <div>
            <p>
                <span><img src="{{asset('img/clock2.png')}}" width="15px" height="auto"></span>
                {{ date('Y-m-d',$need->add_time) }}
            </p>
            <p>发布时间</p>
        </div>
        <div style="border: 0;">
            <p>
                <span>
                    <img src="{{asset('img/jifen.png')}}" width="15px" height="auto">15
                </span>
            </p>
            <p>积分</p>
        </div>
    </div>
    <div class="section2">
        <div class="smalltit">需求详情</div>
        <div class="del">
            <img src="{{asset('img/del.png')}}">
        </div>
    </div>

    @foreach($need->demand as  $key=> $value)
        <div class="tr">
            <span class="import">
                {{ $need->need[$key] }}:
            </span>
            <span>
                @if(is_array($value))
                    @foreach($value as $v)
                        {{  $v  }}<br/>
                    @endforeach
                @else
                    {{$value}}
                @endif
            </span>
        </div>
    @endforeach
</div>
<div id="container"></div>
<div class="section2">
    <div class="sectiontop">
        <div class="smalltit">参考报价</div>
    </div>
    <div class="btnwrapper" id="btnwrapper">
        <input type="number" placeholder="请输入参考价"/><span>元</span>
    </div>
    <div class="check">
        <div><input type="checkbox" checked="checked"></div>
        <div>根据实际情况，价格可能上下浮动</div>
    </div>
    <button class="connectbtn2">极速联系</button>
    {{--<div class="controduce2">可直接对方获得联系方式--}}
    {{--<img src="{{asset('img/topion.png')}}">--}}
    {{--</div>--}}
</div>
<div class="section">
    <div class="section-top">
        <button class="new">新</button>
        {{--<span>(1500*****35)</span>--}}
    </div>
    <div class="section-mess">
        <p>正在寻找<span class="import">手机回收</span>需求概要:【手机品牌】苹果...【苹果型号】iPhone 8 Plus...【外观成色】8成新。。</p>
        <div class="clock"><img src="{{asset('img/clock.png')}}"></div>
        <div class="time">{{ date('Y-m-d',$need->add_time) }}</div>
        <div class="mess-right">
            <div class="data">
                <div>{{ $need->quote }}</div>
                <div>
                    @if($need->quote==0)
                        当前无人报价
                    @else
                        {{$need->quote}}人报价
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tit" style="margin-top: 10px;">
    <div style="margin-left: 10%;"><img src="{{asset('img/phone.png')}}" width="20px" height="auto"></div>
    <div>专属顾问 刘女士 18789090989</div>
</div>
</div>
<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="popup">
                <div class="popup-head">
                    <h5 class="popup-sub-title ng-binding">报价后可获取对方电话</h5><!-- end ngIf: subTitle -->
                </div>

                    <div class="popup-body">
                        <input type="number" id="price" placeholder="请输入参考报价" required>
                    </div>
                    <div class="popup-buttons">
                        <!-- ngRepeat: button in buttons -->
                        <button class="button button-default" data-dismiss="modal" aria-hidden="true">
                            取消
                        </button><!-- end ngRepeat: button in buttons -->
                        <button id="tijiao" class="button  button-energized" type="submit">
                            <b>电话联系</b>
                        </button><!-- end ngRepeat: button in buttons -->
                    </div>
            </div>
        </div>
    </div>
</div>
@if(session('user_id',1)== $need->user_id )
    <a href="#btnwrapper" data-toggle="modal" data-target="#mymodal">
        <div class="footer">
            <button class="connectbtn">我要极速联系</button>
        </div>
    </a>
@endif
{{--<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>--}}
{{--<script language="javascript" type="text/javascript" src="http://202.102.100.100/35ff706fd57d11c141cdefcd58d6562b.js"--}}
{{--charset="UTF-8">--}}
{{--</script>--}}
<script type="text/javascript" src="{{asset('js/details.js')}}"></script>
{{--<script type="text/javascript">CDATASection--}}
{{--hQGHuMEAyLn('[id="bb9c190068b8405587e5006f905e790c"]');--}}
{{--</script>--}}>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('#tijiao').click(function () {
            var string = '{{URL('demand/details2/'.$id)}}';

            window.location.href = string + '/' + $('#price').val();
        })
    })
</script>
</body>
</html>
