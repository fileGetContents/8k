<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link rel="stylesheet" href="{{asset('css/person.css')}}">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <style>
        .input-text {
            height: 20px;
        }

        #cappp {
            background-color: white;
            height: 40px;
        }
    </style>
</head>
<body>
<div class="person-head">
    <div class="head-img">
        <img src="{{ $user->headimgurl }}">
    </div>
</div>
<div class="messbox">
    <span>昵称:</span>
    <span style="">{{ $user->nick }}</span>
    <span class="messright" id="nkname">
        <img src="{{asset('img/write.png')}}">
    </span>
</div>
<div class="messbox">
    <span>手机号:</span>
    <span style="">{{ $user->telephone }}</span>
    <span class="messright" id="phone">
        <img src="{{asset('img/write.png')}}">
    </span>
</div>
<div class="messbox" style="display: none" id="code">
    <span>验证码:</span>
    <span style="width: 15px">
        <input style="height: 20px;line-height:20px;width: 40px" type="text" name="code"> </span>
    <input type="button" id="cappp" value="获取验证码">
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
            $(this).prev().empty().html('<input type="text"  style="height:20px;line-height:20px;" placeholder="昵称不能为空" class="input-text" name="nkname" value="' + val + '" >');
            $(this).css('display', 'none');
            $('.save').css('display', 'block')
        });

        
        // 手机号
        $('#phone').click(function () {
            var val = $(this).prev().html();
<<<<<<< HEAD
            $(this).prev().empty().html('<input type="text" style="height:20px;line-height:20px;"  placeholder="电话号码" class="input-text" name="phone" value="' + val + '" >');
=======
            $(this).prev().empty().html('<input type="text" style="font-size:18px;"  placeholder="电话号码" class="input-text" name="phone" value="' + val + '" >');
>>>>>>> fc8897531a0913a50b1154aacdb25948c448887f
            $(this).css('display', 'none');
            $('.save').css('display', 'block');
            $('#code').css('display', 'block')
        });
        var code = '';
        $('#cappp').click(function () {
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
                    code = obj.message;
                    sms();
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
                        window.location.href = "{{URL('person')}}"
                    } else {
                        alert('更新失败');
                    }
                },
                error: function (obj) {

                }
            })

        });
    });


    // 短信
    var wait = 60;
    function sms() {
        if (wait == 0) {
            document.getElementById("cappp").removeAttribute("disabled");
            document.getElementById("cappp").value = "获取验证码";
            wait = 60;
        } else {
            document.getElementById("cappp").setAttribute("disabled", true);
            document.getElementById("cappp").value = "重新发送(" + wait + ")";
            wait--;
            setTimeout(function () {
                sms()
            }, 1000);
        }
    }

</script>
</body>
</html>
