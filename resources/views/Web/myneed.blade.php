<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>我的需求</title>
    <link href="{{asset('css/myneed.css')}}" rel="stylesheet"/>
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
        <div> width="20px" height="auto"></div>
        <div><a href="{{URL('show/serve')}}">立刻发布需求， GO!</a></div>
    </button>
    <p class="advertise">[8公里，不再是距离，而是服务品质]</p>
@else
    <div class="my_need">
        <p>您已经发布了{{ $num }}个需求</p>
        <ul>
            @foreach($need as $value)
                <li class="">
                    <a href="{{ URL('demand/details/'.$value->id)  }}">
                        <h2>—&nbsp;&nbsp;{{$value->column_name}}&nbsp;&nbsp;—</h2>
                        <p class="time">添加日期:{{ date('Y-m-d H:i:s',$value->add_time) }} </p>
                        <p class='myneed'>
                            @if($value->tag == 1)
                                需求已解决
                            @else
                                待解决
                            @endif
                        </p>
                    </a>
                </li>
            @endforeach
        </ul>

        <button class="prev" style="display: none">上一个</button>
        <button class="next">下一个</button>
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
        })

    })
</script>
</body>
</html>
