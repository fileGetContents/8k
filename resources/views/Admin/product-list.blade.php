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
    <link rel="stylesheet" href="{{asset('admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css')}}" type="text/css">
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>建材列表</title>
    <style>
        .input-text {
            width: 400px;
        }
    </style>
    <link rel="stylesheet" href="{{URL('css/choose.css')}}"/>
    <link rel="stylesheet" href="{{URL('js/LCalendar/css/LCalendar.min.css')}}"/>
    <link rel="stylesheet" href="{{URL('css/timepicki.css')}}"/>

</head>
<body class="pos-r">
<div class="pos-a"
     style="width:150px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5">
    <ul id="treeDemo" class="ztree">
    </ul>
</div>
<div style="margin-left:150px;">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span> 产品管理
        <span class="c-gray en">&gt;</span> 产品列表
        <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px"
           href="javascript:location.replace(location.href);" title="刷新">
            <i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="pd-20">
        <div id="choose" class="content"></div>
    </div>
</div>
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/1.9.3/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.admin.js')}}"></script>
<script>
    $(function () {

        $('#treeDemo').on('click', '.level2 ', function () {
            var name = $(this).attr('title');
            if (name == null) {
            } else {
                $('#choose').empty();
                $.ajax({
                    type: 'post',
                    data: {'name': name},
                    dataType: 'json',
                    url: '{{ URL("column/input") }}',
                    success: function (obj) {
                        console.log(obj);
                        $('#choose').append(obj.message);
                        $('#choose').append('<input class="btn "  type="submit"  value="更新" />');
                        $("input[type=text]").addClass('input-text');
                    },
                    error: function (obj) {

                    }
                })
            }
        });

        $("#choose").on('click', '.addChoose', function () {
            var type = $(this).prev().children().eq(1).attr('type');
            var cla = $(this).prev().children().eq(1).attr('class');
            var name = $(this).prev().children().eq(1).attr('name');
            if (type == 'radio' || type == 'checkbox') {
                // 复选框
                $(this).prev().append('<input type="' + type + '" class="' + cla + '" name="' + name + '" value=""><input type="text" name="" value="" class="input-text"><br/>')
            } else {

            }
        });

        // 绑定删除
        $("#choose").on('click', '.del', function () {
            $.ajax({
                type: 'post',
                data: {'id': $(this).attr('id'), 'table': 'options'},
                dataType: 'json',
                url: '{{URL("test")}}',
                {{--url: '{{URL("pur/del")}}',--}}
                success: function (obj) {
//                    if (obj.info == 'success') {
//                        alert('添加成功')
//                    }
                    layer.msg('已删除!', {icon: 1, time: 1000});
                },
                error: function (obj) {

                }
            })
        });

        $('#choose').on('change', '.input-text', function () {
            $.ajax({
                type: 'post',
                data: {
                    'table': 'options',
                    'where': 'id',
                    'wheFile': $(this).prev().attr('id'),
                    'upFile': 'sort',
                    'up': $(this).val()
                },
                dataType: 'json',
                url: '{{URL("up/file/all")}}',
                success: function (obj) {
                    if (obj.info == 0) {
                        alert('更新成功')
                    }
                },
                error: function (obj) {

                }
            })
        });

        $('#choose').on('change', '.req', function () {
            $.ajax({
                type: 'post',
                data: {
                    'table': 'options',
                    'where': 'id',
                    'wheFile': $(this).prev().prev().attr('id'),
                    'upFile': 'required',
                    'up': $(this).val()
                },
                dataType: 'json',
                url: '{{URL("up/file/all")}}',
                success: function (obj) {

                },
                error: function (obj) {

                }
            })
        });

        $('#choose').on('click', '.btn', function () {
            var ul_id = $('#choose').children('ul');
            console.log(ul_id)
        })

    })
</script>

<script type="text/javascript">
    var setting = {
        view: {
            dblClickExpand: false,
            showLine: false,
            selectedMulti: false
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "pId",
                rootPId: ""
            }
        },
        callback: {
            beforeClick: function (treeId, treeNode) {
                var zTree = $.fn.zTree.getZTreeObj("tree");
                if (treeNode.isParent) {
                    zTree.expandNode(treeNode);
                    return false;
                } else {
                    demoIframe.attr("src", treeNode.file);
                    return true;
                }
            }
        }
    };
    var zNodes = [
        {id: 1, pId: 0, name: "一级分类", open: true},
        {!! $string !!}
    ];
    var code;
    function showCode(str) {
        if (!code) code = $("#code");
        code.empty();
        code.append("<li>" + str + "</li>");
    }
    $(document).ready(function () {
        var t = $("#treeDemo");
        t = $.fn.zTree.init(t, setting, zNodes);
        demoIframe = $("#testIframe");
        demoIframe.bind("load", loadReady);
        var zTree = $.fn.zTree.getZTreeObj("tree");
        zTree.selectNode(zTree.getNodeByParam("id", '11'));
    });

    $('.table-sort').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            {"orderable": false, "aTargets": [0, 7]}// 制定列不参与排序
        ]
    });
    /*图片-添加*/
    function product_add(title, url) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-查看*/
    function product_show(title, url, id) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-审核*/
    function product_shenhe(obj, id) {
        layer.confirm('审核文章？', {
                    btn: ['通过', '不通过'],
                    shade: false
                },
                function () {
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                    $(obj).remove();
                    layer.msg('已发布', {icon: 6, time: 1000});
                },
                function () {
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                    $(obj).remove();
                    layer.msg('未通过', {icon: 5, time: 1000});
                });
    }
    /*图片-下架*/
    function product_stop(obj, id) {
        layer.confirm('确认要下架吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!', {icon: 5, time: 1000});
        });
    }

    /*图片-发布*/
    function product_start(obj, id) {
        layer.confirm('确认要发布吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="product_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!', {icon: 6, time: 1000});
        });
    }
    /*图片-申请上线*/
    function product_shenqing(obj, id) {
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1, time: 2000});
    }
    /*图片-编辑*/
    function product_edit(title, url, id) {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-删除*/
    function product_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }
</script>
</body>
</html>