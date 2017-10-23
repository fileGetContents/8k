<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>我的需求</title>
    <link href="{{asset('css/myneed.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/bussiness.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/demand_state.css')}}">
    <style>
        .hind {
            display: none;
        }

        #show {
            display: block;
        }

        .footer {
            width: 100%;
            height: 60px;
            background-color: #F0F0F0;
            bottom: 0;
            left: 0;
            position: absolute;
        }

        .goon {
            width: 40%;
            height: 40px;
            color: #FFFFFF;
            padding: 0 10px 0 10px;
            border: 0;
            outline: none;
            background-color: #F9A600;
            border-radius: 10px;
            margin: 10px 30% 0 30%;
            float: left;
            position: absolute;
        }

        .last {
            color: #2469C7;
            bottom: 20px;
            left: 30px;
            display: flex;
            z-index: 500;
            position: absolute;
            font-size: 0.8rem;
        }

        #actice {
            display: block;
        }

        .panes-page {
            display: none;
        }

        a {
            text-decoration: none
        }

    </style>


</head>
<body>
@if(empty($need))
    <div class="header">
        <p><img src="{{asset('img/needbg.jpg')}}"></p>
        <p>亲，您还没有发布过任何需求哦~</p>
    </div>
    <button class="announce">
        <div width="20px" height="auto"></div>
        <div><a href="{{URL('show/serve')}}">立刻发布需求， GO!</a></div>
    </button>
    <p class="advertise">[8公里，不再是距离，而是服务品质]</p>
@else
    <div class="my_need">
        <p>您已经发布了{{ $num }}个需求</p>
        {{--<div class="section" style="border: 1px red solid">--}}
        {{--<a href="{{ URL('demand/details/'.$value->id) }}">--}}
        {{--<div class="section-mess">--}}
        {{--<p><span class="import">{{$value->column_name}}</span></p>--}}
        {{--<div class="clock"><img src="{{asset('img/clock.png')}}"></div>--}}
        {{--<div class="time">发布时间:{{ date('Y-m-d',$value->add_time) }}</div>--}}
        {{--<div class="mess-right">--}}
        {{--@if($value->tag == 1)--}}
        {{--需求已解决--}}
        {{--@else--}}
        {{--待解决--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</div>--}}
        <div class="main-panes-wrap">
            <div class="js_agent" id="main_panes">
                @foreach( $need as $key=>$value)
                    <div class="panes-page" id="{{ $key + 1 }}">
                        <!-- step-box-wrap s1-->
                        <div class="step-box-wrap s2">
                            <i class="ico ico-state">
                                @if($value->tag ==0)
                                    <span>待解决</span>
                                @elseif($value->tag ==10)
                                    <span>已解决</span>
                                @else
                                    <span>已解决</span>
                                @endif
                            </i>
                            <!-- tag-ebox -->
                            <div class="tag-ebox">
                                <i class="tips"></i>
                                <div class="tag-con">
                                    @if($value->quote ==0)
                                        暂无报价
                                    @else
                                        {{$value->quote}}
                                    @endif
                                </div>
                            </div>
                            <!-- dm-cell -->
                            <div class="dm-cell">
                                <div class="dm-li1">
                                    <div class="tab-title1"><span class="title">{{$value->column_name}}</span></div>
                                    <div class="time">发布时间:{{ date('Y-m-d',$value->add_time) }}</div>
                                </div>
                                <div class="dm-li2">
                                    @if($value->tag ==0)
                                        <div class="loading-txt">
                                            需求未解决
                                        </div>
                                    @else
                                        <div class="loading-txt">
                                            需求已解决
                                        </div>
                                    @endif
                                </div>
                                <div class="dm-li3">
                                    <div class="l-quote-con">
                                        <div class="l-detail">
                                            <span class="l-underline"><a href="{{ URL('demand/details/'.$value->id) }}">查看需求详情</a></span>>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="footer">
        <button class="goon" id="next" page="2">下一页</button>
        <span class="last" id="last" page="0" style="display: block;">上一页</span>
    </div>
@endif
<script src="{{asset('js/jquery.min.js')}}"></script>

<script>
    $(function () {
        $('.panes-page').eq(0).css('display', 'block');
        $('#next').click(function () {
            var num = parseInt($(this).attr('page'));
            if (document.getElementById(num)) {
                var a = num - 1;
                $("#" + num).css('display', 'block');
                $('#' + a).css('display', 'none');
                $(this).attr('page', num + 1);
                var num2 = parseInt($('#last').attr('page'));
                $("#last").attr('page', num2 + 1)
            }
        });

        $('#last').click(function () {
            var num = parseInt($(this).attr('page'));
            if (document.getElementById(num)) {
                var b = num + 1;
                $('#' + b).css('display', 'none');
                $("#" + num).css('display', 'block'); // 上一页

                $(this).attr('page', num - 1);
                var num2 = parseInt($('#next').attr('page'));
                $("#next").attr('page', num2 - 1);
            }
        })

    })
</script>

</body>
</html>
