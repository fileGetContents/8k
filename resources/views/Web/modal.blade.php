<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/modal.css')}}"/>
</head>
<body>
<div class="section1">根据您的需要，可以设置以下内容
    <a href="{{URL('add/model')}}">
        <button class="add">添加报价模板</button>
    </a></div>
@foreach($mode as $value)
    <div class="sectionmess">
        <p class="mess-top">{{$value->column_name}}</p>
        <div style="height: 20px;" class="smallbtn">{{$value->name}}</div>
        <div style="height: 20px;" class="sect">{{$value->price}}元</div>
        <div style="overflow: hidden ;height: 20px;" class="sect">留言：{{ $value->message }}</div>
        <a href="{{URL('add/model/'.$value->mode_id)}}">
            <span style="float: right;margin-top: 15px;margin-right: 10px;">>>
            </span>
        </a>
    </div>
@endforeach
<p class="contro">您可设置每个分类的专属报价模板</p>
<p class="contro">通过模板可快速报价</p>
</body>
</html>
