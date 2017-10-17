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
        <ul class="nav2" id="nav2">
            <li style="width: 33% ;text-align: center">按日期
                <div class="down"><img src="{{asset('img/down2.png')}}"></div>
            </li>
            <li style="width: 33% ;text-align: center">
                <a href="{{URL('jifen/info')}}">我的积分</a>
            </li>
            <li style="width: 33% ;text-align: center">
                <a href="{{URL('model')}}">通用设置</a>
            </li>
        </ul>
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
                    <div><a href="{{URL("alreadybussiness?time=now")}}">今日需求</a></div>
                    <div><a href="{{URL('alreadybussiness?time=two')}}">近两天需求</a></div>
                    <div><a href="{{URL('alreadybussiness?time=there')}}">近三天需求</a></div>
                    <div><a href="{{URL('alreadybussiness')}}">全部</a></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script>
    $(function () {
        $('.down').click(function () {
            $('#shaixuan').css('display', 'block');
        });
    })

</script>

</body>
</html>

