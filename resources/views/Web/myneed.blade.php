<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>我的需求</title>
    <link href="{{asset('css/myneed.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/bussiness.css')}}" rel="stylesheet">
    <style>
        .hind {
            display: none;
        }

        #show {
            display: block;
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
                @foreach( $need as $value)
                    <div class="panes-page" id="662168">
                        <!-- step-box-wrap s1-->
                        <div class="step-box-wrap s2">
                            <i class="ico ico-state"><span>已解决</span></i>
                            <!-- tag-ebox -->
                            <div class="tag-ebox">
                                <i class="tips"></i>
                                <div class="tag-con">
                                    暂无报价
                                </div>
                            </div>
                            <!-- dm-cell -->
                            <div class="dm-cell">
                                <div class="dm-li1">
                                    <div class="tab-title1"><span class="title">个人搬家</span></div>
                                    <div class="time">截止日期：2017-09-08 22:01:38</div>
                                </div>
                                <div class="dm-li2">
                                    <div class="loading-txt">需求已解决</div>
                                </div>
                                <div class="dm-li3">
                                    <div class="l-quote-con">
                                        <div class="l-detail">
                                            <span class="l-underline">查看需求详情</span>>>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="panes-page" id="662145">
                        <!-- step-box-wrap s1-->
                        <div class="step-box-wrap s2">
                            <i class="ico ico-state"><span>已解决</span></i>
                            <!-- tag-ebox -->
                            <div class="tag-ebox">
                                <i class="tips"></i>
                                <div class="tag-con">
                                    暂无报价
                                </div>
                            </div>
                            <!-- dm-cell -->
                            <div class="dm-cell">
                                <div class="dm-li1">
                                    <div class="tab-title1"><span class="title">个人搬家</span></div>
                                    <div class="time">截止日期：2017-09-08 21:54:48</div>
                                </div>
                                <div class="dm-li2">
                                    <div class="loading-txt">需求已解决</div>
                                </div>
                                <div class="dm-li3">
                                    <div class="l-quote-con">
                                        <div class="l-detail">
                                            <span class="l-underline">查看需求详情</span>>>
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
@endif
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(function () {
        $("ul li").attr('class', 'hind').eq(0).attr('id', "show");
        var len = $('ul li').length;
        // 上一页
        $('.prev').click(function () {
            $(".next").css('display', 'block');
            if ($('#show').index() == len - 1) {
                $(this).css('display', 'none');
            }
            $('#show').attr('id', '').prev().attr('id', 'show')
        });

        // 下一页
        $('.next').click(function () {
            $(".prev").css('display', 'block');
            if ($('#show').index() == len - 1) {
                $(this).css('display', 'none');
                $('.prev').css('display', 'block')
            }
            $('#show').attr('id', '').next().attr('id', 'show')
        });
    })
</script>
</body>
</html>
