<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>v认证</title>
    <link rel="stylesheet" href="{{asset('css/identifyV.css')}}"/>
    <style>
        .fileUpdate {
            width: 48px;
            height: 48px;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{asset('img/vbg.jpg')}}">
    <a href="#section">
        <button class="identibtn">我是商家，立即认证</button>
    </a>
</div>

<div class="header" style="margin-top: -10px;">
    <img src="{{asset('img/vbg2.png')}}">
    <a href="#section">
        <button class="identibtn">我是商家，立即认证</button>
    </a>
</div>

{{--<form action="{{URL('identifyv')}}" method="post" enctype="multipart/form-data">--}}
<div class="section" id="section" style="height:380px;">
    <div class="messbox" style="height:320px;">
        <div><label>商户名称：</label>
            <input type="text" name="name"/>
        </div>

        <div>
            <label>联系方式：</label>
            <input type="text" name="phone" value="{{ $user->telephone }}" readonly="readonly"/>
        </div>

        <div class="iden">
            <div>上传证件:</div>
            <div>
                <table>
                    <tr>
                        <td>营业执照：</td>
                        <td>
                            <input type="file" hidden name="business1" class="image"/>
                            <img class="fileUpdate" src="{{asset('img/updateImage.png')}}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>法人手持身份证件照：</td>
                        <td>
                            <input type="file" hidden name="business2" class="image">
                            <img class="fileUpdate" src="{{asset('img/updateImage.png')}}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>技能证书：</td>
                        <td>
                            <input type="file" hidden name="business3" class="image">
                            <img class="fileUpdate" src="{{asset('img/updateImage.png')}}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>手持身份证件照：</td>
                        <td>
                            <input type="file" hidden name="business4" class="image">
                            <img class="fileUpdate" src="{{asset('img/updateImage.png')}}" alt="">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <a href="#norm">
            <button class="identibtn save " id="save">提交</button>
        </a>
    </div>
</div>
{{--</form>--}}

<div class="norm" id="norm">
    <p class="import">v认证商家特权说明</p>
    <ol>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
    </ol>
    <ol>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
        <li>营业执照认证+个人认证</li>
    </ol>
    <p class="import">官方咨询电话：5001234</p>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(function () {
        // 后台数据
        $(".image").change(function () {
            //发送给后台
            var num = parseInt(Math.random() * 89999999 + 100000000); // 随机名称
            var formData = new FormData();
            var name = Math.floor(Math.random() * 10);
            formData.append("file", $(this)[0].files[0]);
            formData.append("name", parseInt(num, 10));
            $.ajax({
                url: '{{URL('update/image2')}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                },
                success: function (obj) {
                    var asset = '{{asset(date("Ymd"))}}' + '/';
                    $('#updateImages').attr('src', asset + num + '.png')
                },
                error: function (responseStr) {
                    //  console.log("error");
                }
            });
        });
        $('.fileUpdate').click(function () {
            $('.fileUpdate').attr('id', '');
            $(this).attr('id', 'updateImages');
            $(this).prev().click();
        })
    });

    $(".save").click(function () {

        if ($("input[name='name']").val() == '') {
            alert('请填写商户名称');
            return false
        }

        if (!(/^1[34578]\d{9}$/).test($('input[name="phone"]').val())) {
            alert('手机格式错误');
            return false;
        }

        if ($('.fileUpdate').eq(0).attr('src') == '{{URL("img/updateImage.png")}}') {
            alert('请上传营业执照');
            return false;
        }
        if ($('.fileUpdate').eq(1).attr('src') == '{{URL("img/updateImage.png")}}') {
            alert('请上传法人手持身份证件照');
            return false;
        }
        if ($('.fileUpdate').eq(2).attr('src') == '{{URL("img/updateImage.png")}}') {
            alert('请上传技能证书');
            return false;
        }
        if ($('.fileUpdate').eq(3).attr('src') == '{{URL("img/updateImage.png")}}') {
            alert('请上传手持身份证件照');
            return false;
        }


        $.ajax({
            type: 'post',
            data: {
                'name': $("input[name='name']").val(),
                'telephone': $('input[name="phone"]').val(),
                'image0': $('.fileUpdate').eq(0).attr('src'),
                'image1': $('.fileUpdate').eq(1).attr('src'),
                'image2': $('.fileUpdate').eq(2).attr('src'),
                'image3': $('.fileUpdate').eq(3).attr('src'),
            },
            dataType: 'json',
            url: '{{URL("insert/identifyv")}}',
            success: function (obj) {
                if (obj.info == 0) {
                    window.location.href = '{{URL("company")}}';
                } else {
                    alert('添加失败')
                }
            },
            error: function (obj) {

            }


        })


    });


</script>


</body>
</html>
