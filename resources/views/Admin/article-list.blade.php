<!DOCTYPE HTML>
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
    <title>静态界面管理</title>

    <style>
        #DataTables_Table_0_info {
            display: none;
        }
        #DataTables_Table_0_paginate {
           display: none;
        }
    </style>

</head>
<body>

<nav class="breadcrumb">
    <i class="Hui-iconfont"></i> 首页
    <span class="c-gray en">&gt;</span> 资讯管理
    <span class="c-gray en">&gt;</span> 静态界面
    <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新">
        <i class="Hui-iconfont"></i>
    </a>
</nav>

<div class="pd-20">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th>标题</th>
                <th width="80">更新时间</th>
                <th style="display: none" width="80">来源</th>
                <th style="display: none" width="120">更新时间</th>
                <th style="display: none" width="75">浏览次数</th>
                <th style="display: none" width="60">发布状态</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($artisan as $value  )
                <tr class="text-c">
                    <td><input type="checkbox" value="" name=""></td>
                    <td>{{ $value->id }}</td>
                    <td class="text-l">
                        {{ $value->name }}
                    </td>
                    <td>{{  date( 'Y-m-d H:i:s',$value->time) }}</td>
                    <td style="display: none">H-ui</td>
                    <td style="display: none">2014-6-11 11:11:42</td>
                    <td style="display: none">21212</td>
                    <td style="display: none" class="td-status"><span class="label label-success radius">已发布</span></td>
                    <td class="f-14 td-manage">
                        {{--<a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架">--}}
                        {{--<i class="Hui-iconfont">&#xe6de;</i></a> --}}
                        <a style="text-decoration:none" class="ml-5"
                           onClick="article_edit('资讯编辑','article-add/{{ $value->id }}','10001')" href="javascript:;"
                           title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                        {{--<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除">--}}
                        {{--<i class="Hui-iconfont">&#xe6e2;</i>--}}
                        {{--</a>--}}
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

    /*资讯-添加*/
    function article_add(title, url, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*资讯-编辑*/
    function article_edit(title, url, id, w, h) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*资讯-删除*/
    function article_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $(obj).parents("tr").remove();
            layer.msg('已删除!', 1);
        });
    }
    /*资讯-审核*/
    function article_shenhe(obj, id) {
        layer.confirm('审核文章？', {
                    btn: ['通过', '不通过'],
                    shade: false
                },
                function () {
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                    $(obj).remove();
                    layer.msg('已发布', {icon: 6, time: 1000});
                },
                function () {
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                    $(obj).remove();
                    layer.msg('未通过', {icon: 5, time: 1000});
                });
    }
    /*资讯-下架*/
    function article_stop(obj, id) {
        layer.confirm('确认要下架吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!', {icon: 5, time: 1000});
        });
    }

    /*资讯-发布*/
    function article_start(obj, id) {
        layer.confirm('确认要发布吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!', {icon: 6, time: 1000});
        });
    }
    /*资讯-申请上线*/
    function article_shenqing(obj, id) {
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1, time: 2000});
    }

</script>
</body>
</html>