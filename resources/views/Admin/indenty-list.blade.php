﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('admin/lib/html5.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/lib/respond.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/lib/PIE_IE678.js')}}"></script>
    <![endif]-->
    <link href="{{asset('admin/css/H-ui.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/H-ui.admin.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/lib/Hui-iconfont/1.0.1/iconfont.css')}}" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>图片列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span
            class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r mr-20"
                                                  style="line-height:1.6em;margin-top:3px"
                                                  href="javascript:location.replace(location.href);" title="刷新"><i
                class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">


    <form action="{{URL('identify-list')}}" method="post">
        <div class="text-c"> 日期范围：
            <input type="text" name="start" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})"
                   id="logmin"
                   class="input-text Wdate" style="width:120px;">
            -
            <input type="text" name="over" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})"
                   id="logmax"
                   class="input-text Wdate" style="width:120px;">
            <button name="" id="" class="btn btn-success save" type="submit"><i class="Hui-iconfont">&#xe665;</i> 匹配时间
            </button>
        </div>
    </form>

    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="40"><input name="" type="checkbox" value=""></th>
                <th width="80">ID</th>
                <th width="100">名称</th>
                <th width="100">联系方式</th>
                <th>图片名称</th>
                <th width="150">支付状态</th>
                <th width="150">更新时间</th>
                <th width="60">审核状态</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($identify as $value)
                <tr class="text-c">
                    <td><input name="" type="checkbox" value=""></td>
                    <td>{{$value->identify_id}}</td>
                    <td>{{$value->nick}}</td>
                    <td>
                        {{$value->telephone}}
                    </td>
                    <td class="text-l">
                        @if(is_array($value->images))
                            @foreach($value->images as $v)
                                <a href="{!! $v !!}"><img width="80px" height="80px" src="{!! $v !!}" alt=""></a>
                            @endforeach
                        @endif
                    </td>
                    <td class="text-c">
                        @if($value->tag ==0)
                            <span class="label label-success radius">待支付</span>
                        @elseif($value->tag == 10)
                            <span class="label label-success radius">已支付</span>
                        @endif
                    </td>
                    <td>{{date('Y-m-d H:i:s',$value->time)  }}</td>
                    <td class="td-status">
                        @if($value->admin_tag ==0)
                            <span class="label label-success radius">待审核</span>
                        @elseif($value->admin_tag == 10)
                            <span class="label label-success radius">审核通过</span>
                        @elseif($value->admin_tag == 20)
                            <span class="label label-defaunt radius">审核失败</span>
                        @endif
                    </td>
                    <td class="td-manage">
                        <a style="text-decoration:none" class="ml-5"
                           onClick="picture_shenhe(this,'{{$value->identify_id}}')" href="javascript:;" title="编辑">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a style="text-decoration:none" class="ml-5"
                           onClick="picture_del(this,'{{$value->identify_id}}')"
                           href="javascript:;" title="删除">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/1.9.3/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.admin.js')}}"></script>
<script type="text/javascript">
    $('.table-sort').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable": false, "aTargets": [0, 8]}// 制定列不参与排序
        ]
    });
    /*图片-添加*/
    function picture_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-查看*/
    function picture_show(title, url, id) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-审核*/
    function picture_shenhe(obj, id) {
        layer.confirm('资料审核通过？', {
                    btn: ['通过', '不通过'],
                    shade: false
                },
                function () {
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">审核通过</span>');
                    $.ajax({
                        data: {
                            'table': 'identify',
                            'where': 'identify_id',
                            'wheFile': id,
                            'upFile': 'admin_tag',
                            'up': 10
                        },
                        dadaType: 'json',
                        url: '{{URL('up/file/all')}}',
                        type: 'post',
                        success: function (obj) {

                        },
                        error: function (obj) {

                        }
                    });
                    layer.msg('已发布', {icon: 6, time: 1000});
                },
                function () {
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">审核失败</span>');
                    $.ajax({
                        data: {
                            'table': 'identify',
                            'where': 'identify_id',
                            'wheFile': id,
                            'upFile': 'admin_tag',
                            'up': 20
                        },
                        dadaType: 'json',
                        url: '{{URL('up/file/all')}}',
                        type: 'post',
                        success: function (obj) {

                        },
                        error: function (obj) {

                        }
                    });
                    layer.msg('未通过', {icon: 5, time: 1000});
                });
    }


    /*图片-下架*/
    function picture_stop(obj, id) {
        layer.confirm('确认要修改审核失败吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!', {icon: 5, time: 1000});
        });
    }

    /*图片-发布*/
    function picture_start(obj, id) {
        layer.confirm('确定要审核成功？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!', {icon: 6, time: 1000});
        });
    }

    /*图片-申请上线*/
    function picture_shenqing(obj, id) {
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1, time: 2000});
    }
    /*图片-编辑*/
    function picture_edit(title, url, id) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-删除*/
    function picture_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'post',
                data: {'table': 'identify', 'identify_id': id},
                dataType: 'json',
                url: '{{URL("pur/del")}}',
                success: function (obj) {
                },
                error: function (obj) {
                }
            });
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }
</script>
</body>
</html>