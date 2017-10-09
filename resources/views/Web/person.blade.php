<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link rel="stylesheet" href="{{asset('css/person.css')}}">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
</head>
<body>
<div class="person-head">
    <div class="head-img">
        <img src="{{asset('img/4.jpg')}}">
    </div>
    {{--<button class="upload">上传头像</button>--}}
</div>
<div class="messbox">
    <span>昵称:</span>
    <span style="margin-left: 5px;">qsq</span>
    <span class="messright" id="nkname">
        <img src="{{asset('img/write.png')}}">
    </span>
</div>

<div class="messbox">
    <span>手机号:</span>
    <span style="margin-left: 5px;">17780685440</span>
    <span class="messright" id="phone">
        <img src="{{asset('img/write.png')}}">
    </span>
</div>
<div class="messbox" style="display: none" id="code">
    <span>验证码:</span>
    <span style="margin-left: 5px;width: 15px"><input type="text" name="code"> </span>
    <span class="messright">
         <button style="width: 60px" class="save code">验证码</button>
    </span>
</div>

<button id="save" style="display: none;" class="save">确定</button>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/person.js')}}"></script>
<script>
    $(function () {
        // 昵称
        $('#nkname').click(function () {
            var val = $(this).prev().html();
            $(this).prev().empty().html('<input type="text"  placeholder="昵称不能为空" class="input-text" name="nkname" value="' + val + '" >');
            $(this).css('display', 'none');
            $('.save').css('display', 'block')
        });
        // 手机号
        $('#phone').click(function () {
            var val = $(this).prev().html();
            $(this).prev().empty().html('<input type="text"  placeholder="电话号码" class="input-text" name="phone" value="' + val + '" >');
            $(this).css('display', 'none');
            $('.save').css('display', 'block');
            $('#code').css('display', 'block')
        });
        var code = '';
        $('.code').click(function () {
            if (!(/^1[34578]\d{9}$/).test($('input[name=phone]').val())) {
                alert('手机格式错误');
                return false;
            }
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: {'telephone': $('input[name=phone]').val()},
                url: '{{URL('send/sms')}}',
                success: function (obj) {
                    if (obj.info == 0) {
                        code = obj.message
                    }
                },
                error: function (obj) {
                }
            })
        });
        $('#save').click(function () {
            // 昵称判定
            var duom = $("#nkname").css('display');
            if (duom == "none") {
                if ($("input[name=nkname]").val() == "") {
                    alert('昵称不能为空');
                    return false;
                }
            }
            // 判定电话号码  和 验证码
            var duom2 = $('#phone').css('display');
            if (duom2 == "none") {
                if (code == '') {
                    alert('请获取验证码');
                    return false;
                }
                if (code != $('input[name=code]').val()) {
                    alert('验证码错误');
                    return false;
                }
                if (!(/^1[34578]\d{9}$/).test($('input[name=phone]').val())) {
                    alert('手机格式错误');
                    return false;
                }
            }

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: '{{URL('up/user')}}',
                data: {'nick': $("input[name=nkname]").val(), 'telephone': $('input[name=phone]').val()},
                success: function (obj) {
                    if (obj.info == 0) {
                        alert('更新成功');
                    } else {
                        alert('更新失败');
                    }
                },
                error: function (obj) {

                }
            })

        });

    })
</script>

</body>
</html>
