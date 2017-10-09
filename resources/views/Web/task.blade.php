<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>v认证</title>
    <link rel="stylesheet" href="{{assert('css/task.css')}}"/>
</head>
<body>
<div class="content">
    <div class="header">
        <img src="{{assert('img/taskbg.jpg')}}">
        <p class="new">明日任务更新时间：零点</p>
        <div class="ion">
            <img src="{{assert('img/taskion2.png')}}"/>
        </div>
    </div>
    <div class="section">
        <div class="box">
            <div class="progress">完成度：0/1</div>
            <div class="imgbox">
                <img src="{{assert('img/taskion.png')}}">
            </div>
            <div class="font">
                <p class="tasktit">上传公司头像</p>
                <p class="p">奖励：5积分</p>
            </div>
            <button class="go gone">领取奖励</button>
        </div>
    </div>
    <div class="section">
        <div class="box">
            <div class="progress">完成度：0/1</div>
            <div class="imgbox">
                <img src="{{assert('img/taskion.png')}}">
            </div>
            <div class="font">
                <p class="tasktit">完善商户名称</p>
                <p class="p">奖励：5积分</p>
            </div>
            <button class="go">去完成</button>
        </div>
    </div>
    <div class="section">
        <div class="box">
            <div class="progress">完成度：0/1</div>
            <div class="imgbox">
                <img src="{{assert('img/taskion.png')}}">
            </div>
            <div class="font">
                <p class="tasktit">上传公司头像</p>
                <p class="p">奖励：5积分</p>
            </div>
            <button class="go">去完成</button>
        </div>
    </div>
    <a href="history.html"><p class="history">历史完成任务</p></a>
</div>

<div id="remind">
    <span id="close_remind"><img src="{{assert('img/close.png')}}"></span>
</div>
<script type="text/javascript" src="{{assert('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{assert('js/task.js')}}"></script>
</body>
</html>
