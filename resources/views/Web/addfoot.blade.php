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
        <span><input style="width:94%;height: 40px;" type="text" id="suggestId" name="address"
                     placeholder="所在位置"/></span>
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
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=mzvoFzcotiz37nQIpSmWapAd3NusKAGN"></script>
<script type="text/javascript">
    // 百度地图API功能
    function G(id) {
        return document.getElementById(id);
    }
    var map = new BMap.Map("l-map");
    var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
            {
                "input": "suggestId",
                "location": map
            });
    ac.addEventListener("onhighlight", function (e) {  //鼠标放在下拉列表上的事件
        var str = "";
        var _value = e.fromitem.value;
        var value = "";
        if (e.fromitem.index > -1) {
            value = _value.province + _value.city + _value.district + _value.street + _value.business;
        }
        str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

        value = "";
        if (e.toitem.index > -1) {
            _value = e.toitem.value;
            value = _value.province + _value.city + _value.district + _value.street + _value.business;
        }
        str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
        G("searchResultPanel").innerHTML = str;
    });

    var myValue;
    ac.addEventListener("onconfirm", function (e) {    //鼠标点击下拉列表后的事件
        var _value = e.item.value;
        myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
        G("searchResultPanel").innerHTML = "onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

        setPlace();
    });

    function setPlace() {
        map.clearOverlays();    //清除地图上所有覆盖物
        function myFun() {
            var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
            map.centerAndZoom(pp, 18);
            map.addOverlay(new BMap.Marker(pp));    //添加标注
        }

        var local = new BMap.LocalSearch(map, { //智能搜索
            onSearchComplete: myFun
        });
        local.search(myValue);
    }
</script>

</body>
</html>
