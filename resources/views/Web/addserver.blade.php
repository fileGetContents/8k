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
    <p>选择你能提供的服务分类？</p>
</div>
<div class="content">

    <form action="{{ URL('add/server') }}" method="post">
        <div class="section-left">
            <nav>
                <ul id="ul1">
                    @foreach($class as $value)
                        <li class="hover">
                            {{ $value->column_name }}
                        </li>
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
                                {{$v->column_name}}
                                <input type="checkbox" name="server[]" value="{{$v->id}}">
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>
        <div class="bar " style="position:absolute;bottom: 0; left:0;">
            <p>
                <button>提交</button>
            </p>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('js/server.js')}}"></script>
</body>
</html>
