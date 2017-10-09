@extends('public')

@section('css')

@endsection



@section('body')

    <style type="text/css">
        * {
            list-style: none
        }

        html {
            width: 100%;
            height: 100%;
            padding: 0;
        }

        ul li {
            list-style: none;
            display: none;
        }

        #choose {
            display: block;
        }
    </style>
    <form method="post" action="{{URL('equipment/move')}}">
        <ul>
            <li id="choose">
                <span>告诉我们你需要的项目服务？(单选)(必填)</span>
                <input type="checkbox" name="project[]" value="设备搬迁"/>设备搬迁
                <input type="checkbox" name="project[]" value="起重吊装"/>起重吊装
                <input type="checkbox" name="project[]" value="管路、路线拆除及安装"/>路线拆除及安装
                <input type="checkbox" name="project[]" value="设备解体与安装"/>设备解体与安装
                <input type="checkbox" name="project[]" value="电气系统拆卸及安装"/>电气系统拆卸及安装
                <input type="checkbox" name="project[]" value="设备清洗">设备清洗
            </li>
            <li>
                <span>您需要搬迁的设备属于(单选)(必填)</span>
                <input type="radio" name="equipment" value="相机类"/>相机类
                <input type="radio" name="equipment" value="集装箱类"/>集装箱类
                <input type="radio" name="equipment" value="机械机床类"/>机械机床类
                <input type="radio" name="equipment" value="锅炉设备"/>锅炉设备
                <input type="radio" name="equipment" value="流水线整体设备"/>流水线整体设备
            </li>
            <li>
                <span>您预计会有多少件设备？(单选)(必填)</span>
                <input type="radio" name="num" value="1-5件"/>1-5件
                <input type="radio" name="num" value="5-10件"/>5-10件
                <input type="radio" name="num" value="10-15件"/>10-15件
                <input type="radio" name="num" value="15-20件"/>15-20件
            </li>
            <li>
                <span>每台体积设备约？(单选)(必填)</span>
                <input type="radio" name="m" value="10立方以下"/>10立方以下
                <input type="radio" name="m" value="10-30立方"/>10-30立方
                <input type="radio" name="m" value="30-80立方"/>30-80立方
                <input type="radio" name="m" value="80-150立方"/>80-150立方
                <input type="radio" name="m" value="150立方以上"/>150立方以上
            </li>
            <li>
                <span>你理想的搬家时间是什么时候？(单选)(必填)</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您的出发地和目的地分别是哪里？(必填)</span>
                <input type="text" name="depart" placeholder="出发地"/>
                <input type="text" name="purpose" placeholder="目的地"/>
            </li>
            <li>
                <span>您还有其他需要特别说明的吗？</span>
                <textarea name="replenish" placeholder="若您还需要其他增值服务(如贵重物品搬运、途中装卸等),请在此处填写。"></textarea>
            </li>

        </ul>
        <span id="pev" style="display: none">上一步</span>
        <input type="button" value="下一步"/>
        <input type="submit" style="display:none" value="提交"/>
    </form>


@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            var name = new Array('project', 'equipment', 'num', 'm', 'time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 4 && $('#choose').index() > 0) {
                    if ($('input[name=' + InputName + ']:checked').val() != null) {
                        nextChoose()
                    } else {
                        alert('此项必填');
                    }
                } else if ($('#choose').index() == 5) {
                    var depart = $('input[name=depart]').val();
                    var purpose = $('input[name=purpose]').val();
                    if (depart != '' && purpose != '') {
                        nextChoose();
                        $(this).css('display', 'none');
                        $('input[type=submit]').css('display', 'block');
                    } else {
                        alert('此项必填')
                    }
                } else if ($("#choose").index() == 0) {
                    var check = '';
                    $('input[type=checkbox]:checked').each(function () {
                        check += $(this).val();
                    });
                    if (check != '') {
                        nextChoose();
                    } else {
                        alert('此项必填')
                    }
                }
            });

            $('#pev').click(function () {
                $("#choose").removeAttr('id').prev().attr('id', 'choose');
                $('input[type=button]').css('display', 'block');
                $('input[type=submit]').css('display', 'none');
                if ($('#choose').index() == 0) {
                    $('#pev').css('display', 'none');
                } else {
                    $('#pev').css('display', 'block');
                }
            });
        });

        function nextChoose() {
            $("#choose").removeAttr('id').next().attr('id', 'choose');
            if ($('#choose').index() == 0) {
                $('#pev').css('display', 'none');
            } else {
                $('#pev').css('display', 'block');
            }
        }
    </script>
@endsection
