<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no,width=device-width">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/choose.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('js/LCalendar/css/LCalendar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/timepicki.css')}}"/>
    <style>
        #choose_b {
            display: block;
        }

        .choose_n {
            display: none;
        }
    </style>
</head>
<body>
<div class="bar ">
    <p>免费发布需求，废旧物品一收了之</p>
</div>
<form action="" method="post" name="Form" id="Form">
    <div class="content">
        <ul>
            @foreach($options as $value)
                <li @if($value->required) {{'required'}} @endif  name="{{ $value->name }}">
                    {!! $value->prompting !!}
                    {!! $value->choose !!}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="footer">
        <button class="goon" onclick="return false" id="next">下一步</button>
        <input class="goon" onclick="return true" type="submit" value="提交" style="display: none">
    </div>
    <span class="last" id="last" style="display: none">上一步</span>
</form>

<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/timepicki.js')}}"></script>
<script src="{{asset('js/LCalendar/js/LCalendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/choose.js')}}"></script>
<script>
    $("#time").timepicki();
    $(function () {
        $("ul li").attr('class', 'choose_n').eq(0).attr('id', 'choose_b');
        $('#next').click(function () {
            if ($('#choose_b').attr('required') == "required") {
                var name = $('#choose_b').attr('name');
                var type = $('.' + name).eq(0).attr('type');
                if (type == "checkbox") {          // 单选框
                    var string = '';
                    $('.' + name + ':checked').each(function () {
                        string += $(this).val();
                    });
                    if (string == '') {
                        alert('此项必填');
                        return false
                    }
                } else if (type == "radio") {     // 多选框
                    if ($('.' + name + ':checked').val() == null) {
                        alert('选项必填');
                        return false;
                    }
                } else if (type == "text") {      // 输入框
                    var textString = 0;
                    var num = 0;
                    $('.' + name).each(function () {
                        if ($(this).val() != '') {
                            textString++
                        }
                        num++
                    });
                    // 验证
                    if (textString != num) {
                        alert('此项必填');
                        return false;
                    }
                }
                nextStep();
            } else {
                nextStep();
            }
        });

        // 上一步
        $("#last").click(function () {
            var eq = $("#choose_b").index();
            if (eq == 1) {
                $(this).css('display', 'none');
            }
            // 上一个展示
            $('#choose_b').attr('id', '').prev().attr('id', 'choose_b');
            // 下一个按钮展示
            $('#next').css('display', 'block');
            $('.goon').eq(1).css('display', 'none')
        });
        // 单选跳转
        $('input[type=radio]').click(function () {
            nextStep();
        });
        // 地址选择
        $('.address').keydown(function () {

            $.ajax({
                type: 'post',
                data: {'keyword': $(this).val()},
                dataType: 'json',
                url: '{{URL("map/similarity")}}',
                success: function (obj) {
                    //$('#search_word_result').empty();
                    console.log(obj);
                    obj.data.map(function (value, index, array) {
                        $(this).parent().append('<div>' + value['address'] + '</div>');
                    })
                },
                error: function (obj) {

                }
            })
        })

    });

    /**
     *  下一步
     */
    function nextStep() {
        // 验证是否是最倒数第二个选项
        var eq = parseInt($('#choose_b').index()) + 2;
        if (eq == $('ul li').length) {
            $('.goon').eq(0).css('display', 'none');
            $('.goon').eq(1).css('display', 'block');
        }
        $('#last').css('display', 'block');
        $('#choose_b').attr('id', '').next().attr('id', 'choose_b');
    }
</script>


</body>
</html>
