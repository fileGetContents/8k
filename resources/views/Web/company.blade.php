<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link rel="stylesheet" href="{{asset('css/company.css')}}"/>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/baguettebox.min.css')}}">
    <style type="text/css">
        .server li {
            width: 32.6%;
            height: 30px;
            border: 1px solid #A0A0A0;
            list-style: none;
            float: left;
        }
    </style>
</head>
<body>
<div class="person-head">
    <div class="head-img">
        <img src="{{asset('img/4.jpg')}}">
    </div>
    <div class="messwrapper">
        <p><img src="{{asset('img/phone-handset.png')}}">商户电话:{{ $user->telephone }}</p>
    </div>
    <div class="person"><img src="{{asset('img/persn.png')}}" width="30px" height="auto"/></div>
    <div class="btnwrapper">
        <div class="headbtn">
            <a href="{{URL('identifyv')}}">未开通V认证</a>
        </div>
        <div class="headbtn">
            <a href="{{URL('identify')}}">未开通先行赔付</a>
        </div>
    </div>
</div>
<ul id="ul">
    <li class="hover">商户信息</li>
    <li>服务脚印</li>
    <li>服务评价</li>
</ul>
<div id="contener" class="contener">
    <!--商户信息-->
    <div class="no" style="display: block;">
        <div class="placebox">
            <img src="{{asset('img/dizhi.png')}}" width="20px" height="auto"/>
            <span>
                @if(is_null($profile))
                    暂无信息
                @else
                    @if( $profile->address == null)
                        暂无信息
                    @else
                        {{$profile->address}}
                    @endif
                @endif

            </span>
            <span class="messright">
                <a href="{{URL('replace')}}"><img src="{{asset('img/write.png')}}"></a>
            </span>
        </div>
        <div class="placebox2">
            <p class="boxtit">商户相册
                <span class="messright">
                   <a href="{{ URL('replace') }}"> <img src="{{asset('img/write.png')}}"></a>
                </span>
            </p>
            <ul class="baguetteBoxOne gallery">
                @if(!is_null($profile))
                    {!! $profile->images !!}
                @endif
            </ul>
        </div>
        <div class="placebox3">
            <p class="boxtit">商户介绍
                <span id="c_profile" class="messright">
                    <a href="{{URL('replace')}}"><img src="{{asset('img/write.png')}}"></a>
                </span>
            </p>
            <div id="profile" style="margin:10px 0px 10px 5px">
                <p>
                    @if(!is_null($profile))
                        @if($profile->profile ==null)
                            暂未填写商户介绍...
                        @else
                            {{ $profile->profile }}
                        @endif
                    @else
                        暂未填写商户介绍...
                    @endif
                </p>
            </div>
            @foreach($server as $value )
                <div class="place">
                    <div style="margin: 0 2px 0 0;">
                        <img src="{{asset('img/diqiu.png')}}" width="15px" height="auto">
                    </div>
                    <div>{{$value->name}}</div>
                <span class="messright">
                    <a href="{{URL('range/server/'.$value->id)}}"><img src="{{asset('img/write.png')}}"></a>
                </span>
                </div>
                <ul class="server">
                    @foreach($value->column  as $v)
                        <li>{{ $v->column_name }}</li>
                    @endforeach
                </ul>
                <div style="clear:both "></div>
            @endforeach
        </div>
    </div>

    <!--服务脚印-->
    <div class="no">
        <div class="placebox">
            <div style="width: 20px;height: 20px;margin: 5px 10px 0 20px;float: left;">
                <img src="{{asset('img/add.png')}}" width="20px" height="auto"/>
            </div>
            <span style="float: left;"><a href="{{URL('add/foot')}}">留下新脚印</a></span>
        </div>
        <div class="placebox3">
            <p class="boxtit">脚印痕迹:</p>
            @foreach($foot as $value)
                <div class="footerarti">
                    <div class="imgbanner">
                        @if($value->images==null)
                            <img src="{{asset('img/bg.jpg')}}">
                        @else
                            <img src="{{ unserialize($value->images)[0]  }}">
                        @endif
                    </div>
                    <div class="arti">
                        <p class="artip">{{ $value->message }}</p>
                        <p class="date">发布日期：{{date('Y-m-d H:i:s')}}</p>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="tit" style="margin-top: 10px;">
            <div style="margin-left: 20%;margin-top: 5px;">
                <img src="{{asset('img/phone.png')}}" width="20px" height="auto">
            </div>
            <div>专属顾问 刘女士 18789090989</div>
        </div>

    </div>
    <!--服务评价-->
    <div class=" no">

    </div>

</div>
<script src="{{asset('js/baguettebox.min.js')}}"></script>
<script type="text/javascript">
    baguetteBox.run('.baguetteBoxOne', {
        animation: 'fadeIn',
    });
</script>
<script type="text/javascript" src="{{asset('js/company.js')}}"></script>
<script type="text/javascript">
    $(function () {

    });
</script>
</body>
</html>

