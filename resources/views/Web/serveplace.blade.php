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
    <div id="container"></div>
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
    <button class="addservebtn">>>添加更多服务<<</button>
</div>
<div class="footer">
    <button class="goon">确定</button>
</div>
<span class="last">取消</span>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
<script language="javascript" type="text/javascript" src="http://202.102.100.100/35ff706fd57d11c141cdefcd58d6562b.js"
        charset="UTF-8"></script>
<script type="text/javascript" src="{{asset('js/details.js')}}"></script>
<script type="text/javascript" src="{{asset('js/serveplace.js')}}"></script>
<script type="text/javascript">CDATASection;
    hQGHuMEAyLn('[id="bb9c190068b8405587e5006f905e790c"]');
</script>

<script>
    var searchService, map, markers = [];
    var init = function () {
        var center = new qq.maps.LatLng(39.936273, 116.44004334);
        map = new qq.maps.Map(document.getElementById('container'), {
            center: center,
            zoom: 13
        });
        //设置圆形
//        var cirle = new qq.maps.Circle({
//            center: new qq.maps.LatLng(39.920, 116.405),
//            radius: 2000,
//            map: map
//        });

        var marker = new qq.maps.Marker({
            //设置Marker的位置坐标
            position: center,
            //设置显示Marker的地图
            map: map
        });

        var latlngBounds = new qq.maps.LatLngBounds();
        //调用Poi检索类
        searchService = new qq.maps.SearchService({
            complete: function (results) {
                var pois = results.detail.pois;
                for (var i = 0, l = pois.length; i < l; i++) {
                    var poi = pois[i];
                    latlngBounds.extend(poi.latLng);
                    var marker = new qq.maps.Marker({
                        map: map,
                        position: poi.latLng
                    });

                    marker.setTitle(i + 1);

                    markers.push(marker);
                }
                map.fitBounds(latlngBounds);
            }
        });
    };


    init();
</script>

<script>
    $(function () {

        $(".bt_").click(function () {
            var id = $(this).attr('wook');
            var long = parseInt($('#' + id).html()) * 1000;
            // 清楚覆盖物
            markers.setMap(map);
            cirle = new qq.maps.Circle({
                center: new qq.maps.LatLng(39.920, 116.405),
                radius: long,
                map: map
            });
        });

        $(".box_").click(function () {
            var id = $(this).attr('wook');
            var long = parseInt($('#' + id).html()) * 1000;
            markers.setMap(map);
            cirle = new qq.maps.Circle({
                center: new qq.maps.LatLng(39.920, 116.405),
                radius: long,
                map: map
            });
        });

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
