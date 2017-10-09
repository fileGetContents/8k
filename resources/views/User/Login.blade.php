@extends('public')


@section('css')

@endsection

@section('body')
    <ul>
        <li>
            <input name="telephone" type="text" placeholder="手机号">
        </li>
        <li>
            <input name="seed" type="text" placeholder="验证码">
            <input type="button" class="send" value="获取验证码">
        </li>
        <li>
            <input type="submit" value="登录">
        </li>
    </ul>

@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            var info = '';
            $('.send').click(function () {
                var telephone = $('input[name=telephone]').val();
                if ((/^1[34578]\d{9}$/).test(telephone)) {
                    $(this).removeClass('send').attr('class', 'countdown');
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
                    });
                    setTimeout(countdown(), 1000);
                } else {
                    alert('手机格式错误')
                }
            });

            $('input[type=submit]').click(function () {
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
                $.ajax({
                    url: '{{  URL('login') }}',
                    data: {'telephone': $('input[name=telephone]').val(), 'send': $('input[name=seed]').val()},
                    dataType: 'json',
                    type: 'post',
                    success: function (obj) {
                        if (obj[0].info == 0) {
                            alert('登录成')
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
                //setTimeout(countdown(), 1000);
            }
        }
    </script>

@endsection

