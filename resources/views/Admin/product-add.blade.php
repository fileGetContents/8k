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
    <link href="{{asset('admin/lib/icheck/icheck.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/lib/webuploader/0.1.5/webuploader.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/choose.css')}}"/>
    <link rel="stylesheet" href="{{asset('js/LCalendar/css/LCalendar.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/timepicki.css')}}"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="{{asset('admin/lib/DD_belatedPNG_0.0.8a-min.js')}}"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>新增图片</title>
</head>
<body>
<div class="pd-20">
    <div class="row cl">
        <label class="form-label col-2"><span class="c-red">*</span>分类栏目：</label>
        <div class="formControls col-2"> <span class="select-box">
			    	<select name="column" class="select">
                        @foreach($column as $value)
                            <option value="{{  $value->id }}">{{ $value->column_name }}</option>
                        @endforeach
                    </select>
				</span>
        </div>
        <label class="form-label col-2">排序值：</label>
        <div class="formControls col-2">
            <input type="text" class="input-text" value="0" placeholder="" id="soft" name="">
        </div>
        <label class="form-label col-2">用户提示语：</label>
        <div class="formControls col-2">
            <input type="text" class="input-text" value="0" placeholder="" id="mean" name="">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-2">后台获取名称(限英文+数字)：</label>
        <div class="formControls col-2">
            <input type="text" class="input-text" value="0" placeholder="" id="get-php" name="">
        </div>
        <label class="form-label col-2">后台获取名称(限英文+数字)：</label>
        <div class="formControls col-2">
            <input type="text" class="input-text" value="0" placeholder="" id="get-php" name="">
        </div>
        <label class="form-label col-2">是否必填：</label>
        <div class="formControls col-2 skin-minimal">
            <div class="check-box">
                <input type="checkbox" id="checkbox-1" value="1">
                <label for="checkbox-1">&nbsp;</label>
            </div>
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-2">选择提示语言:</label>
        <div class="formControls col-2">
            <input type="text" class="input-text" value="0" placeholder="" id="prompting" name="">
        </div>
    </div>

    <div class="contener">

    </div>

    <div class="row cl">
        <label class="form-label col-2"><span class="c-red"></span></label>
        <div class="formControls col-2">
                <span class="select-box">
			    	<select id="choose" class="select">
                        <option value="1">单选</option>
                        <option value="2">多选</option>
                        <option value="3">地点</option>
                        <option value="4">输入</option>
                        <option value="5">时间（直接添加选项点击保存即可）</option>
                    </select>
				</span>
        </div>
        <button id="add_choose" class="btn " type="button">添加选项</button>
    </div>
    <div class="row cl">
        <div class="col-10 col-offset-2">
            <button id="submit" class="btn btn-primary radius" type="submit">
                <i class="Hui-iconfont">&#xe632;</i> 提交并保存
            </button>
            <button class="btn btn-default radius" type="button">
                &nbsp;&nbsp;取消&nbsp;&nbsp;
            </button>
        </div>
    </div>

</div>
</div>
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/layer/1.9.3/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/My97DatePicker/WdatePicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/icheck/jquery.icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/Validform/5.3.2/Validform.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/webuploader/0.1.5/webuploader.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/H-ui.admin.js')}}"></script>
<script>
    $(function () {

        $("#add_choose").click(function () {
            var way = $("#choose").val();
            if (way == 1) {            // 单选框
                var stringr = '<input   type="text"  placeholder="选择栏目提示语"  att="radio"  class="input_choose input-text" value="">';
                $(".contener").append(stringr);
            } else if (way == 2) {    // 多选
                var stringc = '<input type="text" placeholder="选择栏提示语"  att="check" class="input_choose input-text  " value="" >';
                $(".contener").append(stringc);
            } else if (way == 3) {    // 选择地址
                var stringa = '<input type="text" placeholder="选择栏提示语"  att="address" class="input_choose input-text  " value="" >';
                $('.contener').append(stringa)
            } else if (way == 4) {    // 输入框
                var stringe = '<input type="text" placeholder="选择栏提示语"  att="replenishment" class="input_choose input-text  " value="" >';
                $('.contener').append(stringe)
            } else if (way == 5) {    // 添加时间
                var stringt = '<input type="text" placeholder="时间"   att="time"  class="input_choose input-text">';
                $('.contener').append(stringt);
            }

        });
        // 另外选择
        $('#choose').change(function () {
            $('.contener').empty();
        });

        // 提交选项
        $('#submit').click(function () {
            var id = $("select[name=column]").val();        // 编号
            var soft = $('#soft').val();                    // 排序
            var mean = $('#mean').val();                    // 用户提示语
            var phpName = $('#get-php').val();              // 后台获取名称
            var check = $('#checkbox-1:checked').val();     // 是否必填
            var choose = $('#choose').val();                // 选型
            var prompting = $('#prompting').val();          // 选项用语

            if (check == null) {
                var required = 1;
            } else {
                var required = 0;
            }

            var string = '';
            $('.input_choose').map(function () {
                string += $(this).val() + '/';              // 选项值
            });
            $.ajax({
                type: 'post',
                data: {
                    'id': id,
                    'soft': soft,
                    'mean': mean,
                    'name': phpName,
                    'required': check,
                    'string': string,
                    'choose': choose,
                    'prompting': prompting
                },
                dataType: 'json',
                url: '{{URL('ajax/add/column')}}',
                success: function (obj) {
                    if (obj.info == 0) {
                        alert('添加成功');
                        history.go(0)
                    }
                },
                error: function (obj) {

                }


            });
        });


    })


</script>

</body>
</html>