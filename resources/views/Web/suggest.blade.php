<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>建议</title>
    <link rel="stylesheet" href="{{asset('css/suggest.css')}}"/>
</head>
<body>
<div class="boxwrapper">
    <div class="tit">
        <p style="padding-left: 5px;">意见反馈:</p>
    </div>
    <div class="btnwrapper">
        <div class="btn">点击没反应</div>
        <div class="btn">页面不能正常显示</div>
        <div class="btn">找不到想要的服务分类</div>
    </div>
    <div class="are">
        <textarea></textarea>
        <p>(限200字以内)</p>
    </div>
</div>
<div class="footer">
    <button class="send">提交反馈</button>
    <button class="cancel" onclick="javascript:history.go(-1)">取消</button>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/suggest.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('.send').click(function () {
            var string = $('.are').children().val();
            if (string == "") {
                alert('说点什么吧');
                return false;
            }
            if (string.length > 200) {
                alert('请限制在200字以内');
                return false;
            }
            var hovLength = $('.hover').length;
            for (var i = 0; i < hovLength; i++) {
                string += $('.hover').eq(i).html() + ',';
            }
            $.ajax({
                type: 'post',
                url: '{{ URL("user/suggest") }}',
                data: {'feedback': string},
                dataTye: 'json',
                success: function (obj) {
                    alert('感想你的反馈');
                },
                error: function (obj) {
                }
            })
        });
    })
</script>
</body>
</html>
