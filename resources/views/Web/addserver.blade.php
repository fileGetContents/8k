<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>选择您的需求分类</title>
    <link href="{{asset('css/server.css')}}" rel="stylesheet"/>
    <style>
        body {
            width: 100%;
            height: 100%;
        }

        .tijiao input {
            color: #FFFFFF;
            padding: 0 10px 0 10px;
            border: 0;
            outline: none;
            background-color: #F9A600;
            border-radius: 10px;
            width: 50%;
            height: 40px;
        }
    </style>
</head>
<body>
<div class="bar ">
    <p>选择你能提供的服务分类？</p>
</div>
<form action="{{ URL('add/server') }}" method="post">
    <div class="content">
        <div class="section-left">
            {{--<nav>--}}
            <ul id="ul1">
                @foreach($class as $key=> $value)
                    <li class="@if($key ==0)  {{"hover"}}  @endif">
                        {{ $value->column_name }}
                    </li>
                @endforeach
            </ul>
            {{--</nav>--}}
        </div>
        <div class="section-right" id="section-right">
            @foreach($choose as $key=>$value)
                <nav class="no" style="@if($key==0){{'display:block'}}@else {{'display:none'}}  @endif">
                    <ul>
                        @foreach($value as $v)
                            <li>
                                <input type="checkbox" name="server[]" value="{{$v->id}}">
                                {{$v->column_name}}
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach

        </div>
    </div>


    <div class="tijiao" style="margin-top: 40px;text-align: center;position:absolute;bottom:0;width: 100%">
        <p>
            <input type="submit" value="提交">
        </p>
    </div>
</form>
<script type="text/javascript" src="{{asset('js/server.js')}}"></script>
<script type="text/javascript" src="{{'js/jquery.min.js'}}"></script>
<script>
    $('no').eq(0).css('display', 'block');
</script>
</body>
</html>
