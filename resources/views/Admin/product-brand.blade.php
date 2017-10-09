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
    <link href="{{asset('admin/ss/H-ui.admin.css')}}c" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/lib/Hui-iconfont/1.0.1/iconfont.css')}}" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>认证申请</title>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i>
    首页 <span class="c-gray en">&gt;</span> 产品管理
    <span class="c-gray en">&gt;</span> 品牌管理
    <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px"
       href="javascript:location.replace(location.href);" title="刷新"><i
                class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="pd-20">
    {{--<div class="text-c">--}}
    {{--<form class="Huiform" method="post" action="" target="_self">--}}
    {{--<input type="text" placeholder="分类名称" value="" class="input-text" style="width:120px">--}}
    {{--<span class="btn-upload form-group">--}}
    {{--<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly datatype="*"--}}
    {{--nullmsg="请添加附件！" style="width:200px">--}}
    {{--<a href="javascript:void();" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i>--}}
    {{--浏览文件</a>--}}
    {{--<input type="file" multiple name="file-2" class="input-file">--}}
    {{--</span> <span class="select-box" style="width:150px">--}}
    {{--<select class="select" name="brandclass" size="1">--}}
    {{--<option value="1" selected>国内品牌</option>--}}
    {{--<option value="0">国外品牌</option>--}}
    {{--</select>--}}
    {{--</span>--}}
    {{--<button type="button" class="btn btn-success" id="" name="" onClick="picture_colume_add(this);"><i--}}
    {{--class="Hui-iconfont">&#xe600;</i> 添加--}}
    {{--</button>--}}
    {{--</form>--}}
    {{--</div>--}}
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg ">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="70">ID</th>
                <th width="80">账号</th>
                <th width="200">金额</th>
                <th width="120">时间</th>
                <th>图片</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($identify as $value)
                <tr class="text-c">
                    <td><input name="" type="checkbox" value=""></td>
                    <td>{{$value->identify_id}}</td>
                    <td>{{$value->telephone}}</td>
                    <td>{{$value->price}}</td>
                    <td class="text-l">{{ date('Y-m-d H:i:s',$value->time) }}</td>
                    <td class="text-l">
                        @foreach(unserialize($value->images) as $v)
                            <img src="{!! $v !!}" alt="">
                        @endforeach
                    </td>
                    <td class="td-manage">

                        <a style="text-decoration:none" onClick="member_stop(this,'10001')"
                           href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i>
                        </a>
                        <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-add','4','','510')"
                           class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a title="删除" href="javascript:;"
                           onclick="member_del(this,'1')"
                           class="ml-5"
                           style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!!$identify->render()!!}
    </div>
</div>
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/1.9.3/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.admin.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.admin.product.js')}}"></script>
<script type="text/javascript">
    $('.table-sort').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable": false, "aTargets": [0, 6]}// 制定列不参与排序
        ]
    });
</script>
<script type="text/javascript">
    $(function () {
        $('.table-sort').dataTable({
            "aaSorting": [[1, "desc"]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable": false, "aTargets": [0, 8, 9]}// 制定列不参与排序
            ]
        });
        $('.table-sort tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
    });
    /*用户-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-查看*/
    function member_show(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-停用*/
    function member_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
            $(obj).remove()
            layer.msg('已停用!', {icon: 5, time: 1000});
        });
    }

    /*用户-启用*/
    function member_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
            $(obj).remove();
            layer.msg('已启用!', {icon: 6, time: 1000});
        });
    }
    /*用户-编辑*/
    function member_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*密码-修改*/
    function change_password(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }
</script>
</body>
</html>