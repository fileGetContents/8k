<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/serveplace.css')}}"/>
</head>
<body onload="init()">
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
            <input name="place" class="place" placeholder="街道名、小区/大厦、门牌号">
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
<script type="text/javascript" src="{{asset('js/serveplace.js')}}"></script>
<script type="text/javascript">CDATASection;
    hQGHuMEAyLn('[id="bb9c190068b8405587e5006f905e790c"]');
</script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=mzvoFzcotiz37nQIpSmWapAd3NusKAGN"></script>
<script type="text/javascript">
    // 百度地图API功能
    function G(id) {
        return document.getElementById(id);
    }

    var map = new BMap.Map("l-map");
    map.centerAndZoom("北京", 12);                   // 初始化地图,设置城市和地图级别。

    var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
            {
                "input": "suggestId"
                , "location": map
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
                        alert('添加成功')
                    } else {
                        alert('添加失败')
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
