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
    <form method="post" action="{{URL('furniture/disassembling')}}">
        <ul>
            <li id="choose">
                <span>您的服务是针对个人还是公司(单选)(必填)</span>
                <input type="radio" name="who" value="个人">个人
                <input type="radio" name="who" value="公司">公司
            </li>
            <li>
                <span>您预计会有多少小型家具呢？(单选)(必填)</span>
                <input type="radio" name="num_m" value="1-5件"/>1-5件
                <input type="radio" name="num_m" value="5-10件"/>5-10件
                <input type="radio" name="num_m" value="10-15件"/>10-15件
                <input type="radio" name="num_m" value="15-20件"/>15-20件
            </li>
            <li>
                <span>您预计会有多少大型家具呢？(单选)(必填)</span>
                <input type="radio" name="num_b" value="1-5件"/>1-5件
                <input type="radio" name="num_b" value="5-10件"/>5-10件
                <input type="radio" name="num_b" value="10-15件"/>10-15件
                <input type="radio" name="num_b" value="15-20件"/>15-20件
            </li>
            <li>
                <span>你理想时间是什么时候？(单选)(必填)</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您的家具包含了哪几种材料?(多选)(必填)</span>
                <input type="checkbox" class="material" value="皮" name="material[]"/>皮
                <input type="checkbox" class="material" value="布" name="material[]"/>布
                <input type="checkbox" class="material" value="实木" name="material[]"/>实木
                <input type="checkbox" class="material" value="玻璃" name="material[]"/>玻璃
                <input type="checkbox" class="material" value="金属" name="material[]"/>金属
                <input type="checkbox" class="material" value="塑料" name="material[]"/>塑料
            </li>
            <li>
                <span>您在搬家需要额外的增值服务吗?(多选)(必填)</span>
                <input type="checkbox" class="server" value="沙发翻新换面" name="server[]"/>沙发翻新换面
                <input type="checkbox" class="server" value="皮面清洗打蜡" name="server[]"/>叉车、吊车、起重机等工业搬运车辆
                <input type="checkbox" class="server" value="地板打蜡" name="server[]"/>途中卸载
                <input type="checkbox" class="server" value="油漆维修" name="server[]"/>办公家具拆卸组装
                <input type="checkbox" class="server" value="修复划痕" name="server[]"/>临时仓库
                <input type="checkbox" class="server" value="更换五金" name="server[]"/>想和服务商进一步沟通
                <input type="checkbox" class="server" value="想和服务商进一步沟通" name="server[]"/>想和服务商进一步沟通
            </li>


            <li>
                <span>请告诉我们您的大概位置,以便我们提供服务(必填)</span>
                <input type="text" name="depart" placeholder="出发地"/>
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
            var name = new Array('who', 'num_m', 'num_b', 'time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 3) {
                    if ($('input[name=' + InputName + ']:checked').val() != null) {
                        nextChoose()
                    } else {
                        alert('此项必填');
                    }
                } else if ($('#choose').index() == 4) {
                    var four = '';
                    $('input.material:checked').each(function () {
                        four += $(this).val();
                    });
                    if (four != '') {
                        nextChoose();
                    } else {
                        alert('此项必填')
                    }
                } else if ($('#choose').index() == 5) {
                    var five = '';
                    $('input.server:checked').each(function () {
                        five += $(this).val();
                    });
                    if (five != '') {
                        nextChoose();
                    } else {
                        alert('此项必填')
                    }
                } else if ($('#choose').index() == 6) {
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
