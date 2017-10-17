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
        <input name="address" id="suggestId" class="place" placeholder="街道名、小区/大厦、门牌号"
               value="@if(!is_null($profile)){{$profile->address}} @endif">
    </div>
</div>
<p class="tit">商户介绍</p>
<div class="are">
    <textarea name="profile" id="profile"
              placeholder="展示您的商户资历、服务优势、会获得更多客户青睐哦">@if(!is_null($profile)){{$profile->profile}}@endif</textarea>
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
                string += '<a href="{{asset(date('Ymd'))}}/' + $(this).val() + '.png"><li><img src="{{asset(date('Ymd'))}}/' + $(this).val() + '.png" alt="Cuo Na Lake"></li></a>';
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
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=mzvoFzcotiz37nQIpSmWapAd3NusKAGN"></script>
<script type="text/javascript">
    // 百度搜索功能
    function G(id) {
        return document.getElementById(id);
    }
    var map = new BMap.Map("l-map");
    var point = new BMap.Point(116.404, 39.915);
    var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
            {
                "input": "suggestId"
                , "location": map
            });
    map.centerAndZoom(point, 15);
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

    function add_overlay($gongl) {
        //清除覆盖物
        map.clearOverlays();
        // 创建地址解析器实例
        if ($("#suggestId").val() == "") {
            alert('请选择位置');
            return false;
        }
        var myGeo = new BMap.Geocoder();
        // 将地址解析结果显示在地图上,并调整地图视野
        myGeo.getPoint($("#suggestId").val(), function (point) {
            // var point = new BMap.Point(116.404, 39.915);//
            map.centerAndZoom(point, 16);
            var circle = new BMap.Circle(point, $gongl, {
                strokeColor: "blue",
                strokeWeight: 2,
                strokeOpacity: 0.5
            }); //创建圆
            map.addOverlay(circle);            //增加圆
        }, $("#suggestId").val());

    }

</script>


</body>
</html>
