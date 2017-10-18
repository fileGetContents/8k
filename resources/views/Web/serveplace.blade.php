<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/serveplace.css')}}"/>
</head>
<body>
<div class="bar ">
    <p>完善服务地点和半径，为您精确匹配生意机会</p>
</div>
<div class="content">
    <p class="tit">商户地址</p>
    <div class="choseplace">
        <div class="dateimg">
            <img src="{{asset('img/dizhi.png')}}" width="20px" height="auto">
        </div>
        <div>
            <input name="place" id="suggestId" class="place" value="{{ $server->name }}" placeholder="街道名、小区/大厦、门牌号">
        </div>
    </div>
    <div id="l-map"></div>
    <p class="tit">商户地址</p>
    <div class="box">
        @foreach($server as $value )
            <div class="tr">
                <div class="del"><img src="{{asset('img/del.png')}}"></div>
                <div style="width:90%;float: left;" class="abgs_a">
                    <div class="form-horizontal col-sm-12" role="form">
                        <div class="form-group label_a div_left">
                            <div class="col-sm-4 col-xs-9">
                                <span style="float: left;">{{$value->column_name}}</span>
                                <div id="{{ $value->id }}" class="text_xa_">全城</div>
                                <div wook="{{ $value->id }}" class="box_">
                                    <div class="bg_">
                                        <div class="bgcolor_"></div>
                                    </div>
                                    <div wook="{{ $value->id }}" class="bt_"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="addservebtn"><a href="{{ URL('add/server') }}">>>添加更多服务<<</a></button>
</div>
<div class="footer">
    <button class="goon">确定</button>
</div>
<span class="last">取消</span>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/details.js')}}"></script>
<script>
    $(window).ready(function jindu($) {
        var $bg = $('.bg_');
        var statu = false;
        var ox = 0;
        var lx = 0;
        var left = 200;
        var bgleft = 0;
        $bg.click(function (e) {
            add_overlay();
            if (!statu) {
                bgleft = $bg.offset().left;
                left = e.pageX - bgleft;
                if (left < 0) {
                    left = 0;

                }
                if (left > 200) {
                    left = 200;
                }
                $(this).next('div').css('left', left);
                $(this).children().stop().animate({
                    width: left
                }, 200);
                if (parseFloat(left / 20).toFixed(0) == 10) {
                    $(this).parent('div').siblings('div').html('全城');
                } else {
                    $(this).parent('div').siblings('div').html(parseFloat(left / 20).toFixed(0) + '公里');
                }
                // 画圆
                add_overlay(parseInt(left));

            }
        });
    });
    $('.del').click(function () {

        this.parentNode.remove(this.parentNode);
    });
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


<script>
    $(function () {
        $('.goon').click(function () {
//            var pace = $('input[name=place]').val();
//            if (pace == '') {
//                alert('填写服务地址')
//            }
            var server = '';
            $('.text_xa_').map(function (index, value, array) {
                server += $(this).attr('id') + '/' + $(this).html() + '/';
            });
            console.log(server);
            $.ajax({
                type: 'post',
                data: {'server': server, 'id': '{{$id}}', 'place': $('input[name=place]').val()},
                dataType: 'json',
                url: '{{URL('add/range')}}',
                success: function (obj) {
                    if (obj.info == 0) {
                        window.location.href = "{{ URL('company') }}";
                    } else {
                        alert('添加失败')
                    }
                },
                error: function (obj) {
                }
            })
        });
    });
</script>
</body>
</html>
