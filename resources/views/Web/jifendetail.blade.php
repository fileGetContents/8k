<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>积分收支记录</title>
    <link rel="stylesheet" href="{{asset('css/jifendetail.css')}}"/>
    <style>
        .list {
            width: 100%;
        }
        .center{
            text-align: left;
            width: 20px;
        }


    </style>
</head>
<body>
<div class="header">
    <div style="margin-top: 5px;">
        <img src="{{$user->headimgurl}}" width="20px" height="20px">
    </div>
    <div>您的剩余积分：
        <span class="import">{{$user->recharge}}</span></div>
    <div style="float: right;margin-right: 10px;"></div>
</div>
<div class="list">
    <span style="margin-left: 5px;">以下是您的积分使用清单</span>
</div>
@foreach($recharge as $value)
    <div class="list">
        <span class="left">积分: {{ $value->info_recharge }}&nbsp;&nbsp;&nbsp;</span>
        <span class="center">{{date('Y-m-d H:i:s',$value->info_time)}}&nbsp;&nbsp;&nbsp;</span>
        <span class="right">{{$value->info_text}}&nbsp;&nbsp;&nbsp;</span>
    </div>
@endforeach

</body>
</html>
