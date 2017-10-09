<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>选择您的需求分类</title>
    <link href="{{asset('css/server.css')}}" rel="stylesheet"/>
</head>
<body>
<div class="bar ">
    <p>您要发布下面那种类型的需求？</p>
</div>
<div class="content">
    <div class="section-left">
        <nav>
            <ul id="ul1">
                @foreach($class as $value)
                    <li class="hover">{{ $value->column_name }}</li>
                @endforeach
            </ul>
        </nav>
    </div>
    <div class="section-right" id="section-right">
        @foreach($choose as $value)
            <nav class="  no" style="display: block;">
                <ul>
                    @foreach($value as $v)
                        <li>
                            <a href="{{URL('choose/server/'.$v->id)}}">{{$v->column_name}} </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        @endforeach
    </div>
</div>
<a href="{{URL('suggest')}}">
    <div class="add">
        <p><img src="{{asset('img/task.png')}}" width="30px" height="30px"></p>
        <p class="font">反</br>馈</p>
    </div>
</a>
<script type="text/javascript" src="{{asset('js/server.js')}}"></script>
</body>
</html>
