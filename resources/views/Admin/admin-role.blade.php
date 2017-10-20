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
    <script type="text/javascript" src="lib/html5.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <script type="text/javascript" src="lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="admin/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/css/H-ui.admin.css" rel="stylesheet" type="text/css"/>
    <link href="admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>角色管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span
            class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r mr-20"
                                                  style="line-height:1.6em;margin-top:3px"
                                                  href="javascript:location.replace(location.href);" title="刷新"><i
                class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
        <tr class="text-c">
            <th width="100">用户名:</th>
            <th width=""><input class="input-text" type="text" placeholder="用户名" value="" name="admin"></th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-c">
            <td>密码:</td>
            <td>
                <input class="input-text" type="text" placeholder="密码" value="" name="password">
            </td>
        </tr>

        <tr class="text-c">
            <td></td>
            <td><input id="btn" class="btn btn-primary radius" value="确认修改" type="button"></td>
        </tr>

        </tbody>

    </table>
</div>
<script type="text/javascript" src="admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="admin/js/H-ui.js"></script>
<script type="text/javascript" src="admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    //    /*管理员-角色-添加*/
    //    function admin_role_add(title, url, w, h) {
    //        layer_show(title, url, w, h);
    //    }
    //    /*管理员-角色-编辑*/
    //    function admin_role_edit(title, url, id, w, h) {
    //        layer_show(title, url, w, h);
    //    }
    //    /*管理员-角色-删除*/
    //    function admin_role_del(obj, id) {
    //        layer.confirm('角色删除须谨慎，确认要删除吗？', function (index) {
    //            //此处请求后台程序，下方是成功后的前台处理……
    //            $(obj).parents("tr").remove();
    //            layer.msg('已删除!', {icon: 1, time: 1000});
    //        });
    //    }

    $("#btn").click(function () {
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {"admin": $("input[name='admin']").val(), "pass": $("input[name='password']").val()},
            url: '{{URL("alert/admin")}}',
            success: function (obj) {

            },
            error: function () {

            }
        })
    })


</script>
</body>
</html>