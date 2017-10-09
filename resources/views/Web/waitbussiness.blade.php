<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>生意机会</title>
    <link href="{{asset('css/bussiness.css')}}" rel="stylesheet">
</head>
<body>
<div class="bar">
    <ul class="nav1">
        <a href="{{URL('waitbussiness')}}">
            <li class="active">待报价需求</li>
        </a>
        <a href="{{URL('alreadybussiness')}}">
            <li>已报价需求</li>
        </a>
        <a href="{{URL('connectbussiness')}}">
            <li>联系中需求</li>
        </a>
    </ul>
</div>
<div class="content">
    <ul class="nav2" id="nav2">
        <li class="active2">按热度
            <div class="down"><img src="{{asset('img/down.png')}}"></div>
        </li>
        <li>按日期
            <div class="down"><img src="{{asset('img/down2.png')}}"></div>
        </li>
        <li>按分类
            <div class="down"><img src="{{asset('img/down2.png')}}"></div>
        </li>
        <li>
            <div class="jifen"><img src="{{asset('img/jifen.png')}}"></div>
            我的积分
        </li>
    </ul>
    <div class="contain" id="contain">
        <div class="no">
        </div>
        <div class="no">
            <div><a href="{{URL("waitbussiness?time=now")}}">今日需求</a></div>
            <div><a href="{{URL('waitbussiness?time=two')}}">近两天需求</a></div>
            <div><a href="{{URL('waitbussiness?time=there')}}">近三天需求</a></div>
            <div><a href="{{URL('waitbussiness')}}">全部</a></div>
        </div>
        <div class="no">
            <div>自定义</div>
            <div>全部分类需求</div>
        </div>
        <div class="no">
        </div>
    </div>
    <div class="approve"><span class="right">升级认证，成交率大增 ></span></div>

    @foreach($need as $value)
        <div class="section">
            <a href="{{URL('demand/details/'.$id[$num]->id2)}}">
                <div class="section-top">
                    <button class="new">新</button>
                    <span>({{ substr($value->telephone,0,3) }}***** {{substr($value->telephone,-3,3)}} )</span>
                    <button class="connect">请尽快联系Ta</button>
                </div>
                <div class="section-mess">
                    <p>正在寻找<span class="import">{{$value->column_name}}</span></p>
                    <div class="clock"><img src="{{URL('img/clock.png')}}"></div>
                    <div class="time">发布时间:{{ date('Y-m-d',$value->add_time) }}</div>
                    <div class="mess-right">
                        <div class="data">
                            <div>{{$value->quote}}</div>
                            @if( $value->quote ==0 )
                                <div>当前无人抢单</div>
                            @else
                                <div>{{ $value->quote }}</div>
                            @endif
                        </div>
                        <div class="ji">急</div>
                    </div>
                </div>
            </a>
        </div>
        <?php
        $num++
        ?>
    @endforeach
    <div class="nofound"><p><img src="{{asset('img/nofound.png')}}"></p>
        <p>没有更多记录了</p></div>
    <div class="tit" style="margin-top: 10px;">
        <div style="margin-left: 20%;margin-top: 5px;"><img src="img/phone.png" width="20px" height="auto"></div>
        <div>专属顾问 刘女士 18789090989</div>
    </div>

</div>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bussiness.js')}}"></script>
</body>
</html>
