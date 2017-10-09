@extends('public')


@section('css')

@endsection

@section('body')

    <style type="text/css">
    </style>
    <form action="" method="post">
        <ul>
            <li>
                <span>您的称呼:</span>
                <input name="nick" type="text" class="" value="{{ $user->nick }}">
                <i class="nick">图标</i>
            </li>
            <li>
                <span>登录手机:</span>
                <input name="telephone" class="" type="text" value="{{ $user->telephone }}">
                <i class="telephone">图标</i>
            </li>
            <li class="cate">
                <input name="seed" type="text" placeholder="验证码">
                <input type="button" class="send" value="获取验证码">
            </li>
            <li>
                <input style="display: none" type="submit" value="保存">
            </li>
        </ul>
    </form>

@endsection


@section('js')
    <script type="text/javascript">
        $(function () {

            $('i').click(function () {
                $('input[type=submit]').css('display', 'block');
                $(this).prev().attr('class', 'required');
            });

            $('.nick').click(function () {
                $('.cate').css('display', 'block');
            });


            var info = '';
            $('.send').click(function () {
                $(this).removeClass('send').attr('class', 'countdown');
                var telephone = $('input[name=telephone]').val();
                if ((/^1[34578]\d{9}$/).test(telephone)) {
                    $.ajax({
                        url: '{{ URL('send/sms') }}',
                        data: {'telephone': telephone},
                        dataType: 'json',
                        type: 'post',
                        success: function (obj) {
                            console.log(obj);
                            if (obj.info == 0) {
                                info = obj.message
                            }
                        },
                        error: function (obj) {

                        }
                    })
                } else {
                    alert('手机格式错误')
                }
            });
            $('input[type=submit]').click(function () {

                // 跟换手机号
                if ($('input[name=telephone]').attr('class') == "required") {
                    if (!(/^1[34578]\d{9}$/).test($('input[name=telephone]').val())) {
                        alert('手机号格式错误');
                        return false
                    }
                    if (info == '') {
                        alert('请填写验证码');
                        return false
                    }
                    if (info != $('input[name=seed]').val()) {
                        alert('验证码错误');
                        return false
                    }
                }


                if ($("input[name=nick]").val() == '') {
                    alert('昵称不能为空');
                    return false;
                }

                $.ajax({
                    url: '{{  URL('update/info') }}',
                    data: {
                        'telephone': $('input[name=telephone]').val(),
                        'send': $('input[name=seed]').val(),
                        'nick': $('input[name=nick]').val()
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (obj) {
                        if (obj[0].info == 0) {
                            alert('修改成功')
                        }
                    },
                    error: function (obj) {
                    }
                })
            })

        });

        var time = 60;
        function countdown() {
            time--;
            $('.countdown').val(time + '秒后重新发送');
            if (time == 0) {
                $('.countdown').removeClass('countdown').attr('class', 'send');
                time = 60;
            } else {
                setTimeout(countdown(), 1000)
            }
        }

    </script>

@endsection

