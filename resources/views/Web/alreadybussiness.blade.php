<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>生意机会</title>
    <link href="{{asset('css/bussiness.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
</head>
<body>
<div class="bar">
    <ul class="nav1">
        <a href="{{URL('waitbussiness')}}">
            <li>待报价需求</li>
        </a>
        <a href="{{URL('alreadybussiness')}}">
            <li class="active">已报价需求</li>
        </a>
        <a href="{{URL('connectbussiness')}}">
            <li>联系中需求</li>
        </a>

    </ul>
</div>
<div class="content">
    <ul class="nav3">
        <li data-toggle="modal" data-target="#shaixuan">
            <div class="jifen"><img src=" {{asset('img/saixuan.png')}}"></div>
            快速筛选
        </li>
        <li>
            <div class="jifen"><img src="{{asset('img/jifen.png')}}"></div>
            <a href="{{URL('jifen/info')}}">我的积分</a>
        </li>
        <li>
            <div class="jifen"><img src=" {{asset('img/shezhi.png')}}"></div>
            通用设置
        </li>
    </ul>
    @if(!$iden)
        <div class="approve">
            <span class="right"><a href="{{URL('http://www.xcylkj.com/identify')}}">升级认证，成交率大增 ></a></span>
        </div>
    @endif

    <div class="nofound">
        @foreach($need as $value)
            <div class="section">
                <a href="{{URL('demand/details2/'.$id[$num]->id2.'/'.$value->price)}}">
                    <div class="section-top">
                        <button class="new">新</button>
                        <span>({{ substr($value->telephone,0,3) }}***** {{substr($value->telephone,-3,3)}} )</span>
                        <button class="connect">请尽快联系Ta</button>
                    </div>
                    <div class="section-mess">
                        <p>正在寻找<span class="import">{{$value->column_name}}</span></p>
                        <div style="height:10px;" class="clock"><img height="10px" src="{{URL('img/clock.png')}}"></div>
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
            <?php $num++; ?>

        @endforeach

        @if(empty($need))
            <p><img src="{{asset('img/nofound.png')}}"></p>
            <p>此项无结果</p>
        @endif
    </div>
    <div class="modal fade" id="shaixuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="boxwrapper">
                    <div>今日需求</div>
                    <div>全部</div>
                    <div>去设置</div>
                    <div data-dismiss="modal" aria-hidden="true">取消</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>


</body>
</html>

