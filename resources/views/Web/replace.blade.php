<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>完善商户资料，将大幅度提高接单率</title>
    <link rel="stylesheet" href="{{asset('css/zyUpload.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/choose.css')}}"/>
    <style>
        .file_bar {
            display: none;
        }
    </style>
</head>
<body>
<div class="bar ">
    <p>完善商户资料，将大幅度提高接单率</p>
</div>
<p class="tit">商户地址</p>
<div class="choseplace">
    <div class="dateimg"><img src="{{asset('img/dizhi.png')}}" width="20px" height="auto"></div>
    <div>
        <input name="address" class="place" placeholder="街道名、小区/大厦、门牌号" value="{{$profile->address}}">
    </div>
</div>
<p class="tit">商户介绍</p>
<div class="are">
    <textarea name="profile" id="profile" placeholder="展示您的商户资历、服务优势、会获得更多客户青睐哦">{{$profile->profile}}</textarea>
    <p>(限200字以内)</p>
</div>
<p class="tit">商户图片</p>
<div id="demo" class="demo" style="width: 100%;"></div>
<div class="footer">
    <button class="goon">确定</button>
</div>
<span class="last">取消</span>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/replace.js')}}"></script>
<script type="text/javascript" src="{{asset('js/zyFile.js')}}"></script>
<script type="text/javascript" src=" {{asset('js/zyUpload.js')}}"></script>
<script type="text/javascript" src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script>
    $(function () {
        $('.goon').click(function () {
            var string = '';
            $("input[name=updateName]").map(function () {
                string += '<a href="http://localhost/8k/public/{{date('Ymd')}}/' + $(this).val() + '.png"><li><img src="http://localhost/8k/public/{{date('Ymd')}}/' + $(this).val() + '.png" alt="Cuo Na Lake"></li></a>';
            });
            $.ajax({
                type: 'post',
                data: {
                    'address': $('input[name=address]').val(),
                    'profile': $('#profile').val(),
                    'string': string
                },
                dataType: 'json',
                url: '{{URL("ajax/replace")}}',
                success: function (obj) {
                    if (obj.info == 0) {
                        alert('更新成功')
                    } else {
                        alert('更新失败')
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
