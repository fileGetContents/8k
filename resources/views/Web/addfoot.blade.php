<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title>添加脚印</title>
    <link rel="stylesheet" href="{{asset('css/zyUpload.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/addfoot.css')}}" type="text/css">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
</head>
<body>
<div class="content">
    <div id="demo" class="demo" style="width: 100%;"></div>
    <div class="think">
        <textarea id="message" placeholder="这一刻您的想法"></textarea>
    </div>
    <div class="section2">
        <img src="{{asset('img/dizhi.png')}}" width="15px" height="auto"/>
        <span><input style="width:94%;height: 40px;" type="text" name="address" placeholder="所在位置"/></span>
    </div>
    <!--昵称-->
    <div class="modal fade" id="place" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        编辑
                    </h4>
                </div>
                <input type="text" ng-minlength="1" id="inpplace" class="placeinp">
                <button class="save" onclick="addplace();" data-dismiss="modal" aria-hidden="true">保存</button>
            </div>
        </div>
    </div>
</div>
<div id="mask"></div>

<div class="foot"><span></span>
    <button class="postbtn">发布</button>
</div>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/zyFile.js')}}"></script>
<script type="text/javascript" src=" {{asset('js/zyUpload.js')}}"></script>
<script type="text/javascript" src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/addfoot.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('.postbtn').click(function () {
            var string = '';
            $('input[name=updateName]').map(function () {
                string += $(this).val() + '/';
            });
            $.ajax({
                type: 'post',
                data: {'address': $('input[name=address]').val(), 'images': string, 'message': $("#message").val()},
                dataType: 'json',
                url: '{{ URL("ajax/foot") }}',
                success: function (obj) {

                },
                error: function (obj) {

                }


            })


        })
    })

</script>
</body>
</html>
