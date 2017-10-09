<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>举报</title>
    <link rel="stylesheet" href="{{assert('css/report.css')}}"/>
</head>
<body>
<div class="content">
    <p>举报类型：</p>
    <div style="width: 100%;height: 130px;">
        <div class="reportbtn">电话空号</div>
        <div class="reportbtn">同行恶意发布</div>
        <div class="reportbtn">垃圾广告信息</div>
        <div class="reportbtn">对方无实际需求</div>
        <div class="reportbtn">非法信息(黄赌毒)</div>
        <div class="reportbtn">其他</div>
    </div>
    <p>详细说明(必填)</p>
    <textarea class="text" placeholder="请详细描述具体经过与举报内容"></textarea>
    <p class="p">仅限200字以内</p>
</div>
<div class="footer">
    <div class=" footer_top">
        <p>提示：</p>
        <p>请务必详细说明举报理由，以便客服为您审核</p>
        <p>需求审核为3-5个工作日，请您耐心等待</p>
        <p>经平台核实若为恶意举报，品台进行相应惩戒处理</p>
    </div>
    <button class="send">提交</button>
</div>
<script type="text/javascript" src="{{assert('js/report.js')}}"></script>
</body>
</html>
