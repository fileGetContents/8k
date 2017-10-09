<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>关于我们</title>
    <link href="{{asset('css/aboutus.css')}}" rel="stylesheet"/>
</head>
<body>

<div class="header">
    <div> {{$need[0]->column_name}} </div>
    <table>
        @foreach($need[0]->demand as  $key=> $value)
            <tr>
                <td>{{ $need[0]->need[$key] }}:</td>
                <td>
                    @if(is_array($value))
                        @foreach($value as $v)
                            {{$v }}&nbsp;&nbsp;
                        @endforeach
                    @else

                        {{$value}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{URL('')}}">补充说明</a>
    <a href="{{URL('show/serve')}}">查看更多服务</a>
</div>
</body>
</html>
