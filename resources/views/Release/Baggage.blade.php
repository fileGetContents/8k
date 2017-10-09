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

    <form method="post" action="{{URL('baggage')}}">
        <ul>
            <li id="choose">
                <span>您需要托运的物品大概重量是？(单选)（必填）</span>
                <input type="radio" name="weight" value="40公斤以下"/>40公斤以下
                <input type="radio" name="weight" value="40公斤至100公斤"/>40公斤至100公斤
                <input type="radio" name="weight" value="100公斤以上"/>100公斤以上
            </li>
            <li>
                <span>你理想时间是什么时候？(单选)(必填)</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span> 您托运的行李包装包括？(多选)（必填）</span>
                <input type="checkbox" class="packaging" value="纸箱" name="packaging[]"/>纸箱
                <input type="checkbox" class="packaging" value="木箱" name="packaging[]"/>木箱
                <input type="checkbox" class="packaging" value="铁箱" name="packaging[]"/>铁箱
                <input type="checkbox" class="packaging" value="胶带、泡沫" name="packaging[]"/>胶带、泡沫
            </li>
            <li>
                <span>您需要托运的行李中包含以下货物吗？(多选)（必填）</span>
                <input type="checkbox" class="contains" value="普通货物" name="contains[]"/>普通货物
                <input type="checkbox" class="contains" value="贵重物品" name="contains[]"/>贵重物品
                <input type="checkbox" class="contains" value="易碎品" name="contains[]"/>易碎品
            </li>
            <li>
                <span>您您在搬家时需要额外的增值服务吗？(多选)（必填）</span>
                <input type="checkbox" class="server" value="物品打包" name="server[]"/>物品打包
                <input type="checkbox" class="server" value="临时仓储" name="server[]"/>临时仓储
                <input type="checkbox" class="server" value="家具拆解组装" name="server[]"/>家具拆解组装
                <input type="checkbox" class="server" value="家具拆解组装" name="server[]"/>家具拆解组装
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
            var name = new Array('weight', 'time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 1) {
                    if ($('input[name=' + InputName + ']:checked').val() != null) {
                        nextChoose()
                    } else {
                        alert('此项必填');
                    }
                } else if ($('#choose').index() == 2) {
                    var four = '';
                    $('input.packaging:checked').each(function () {
                        four += $(this).val();
                    });
                    if (four != '') {
                        nextChoose();
                    } else {
                        alert('此项必填')
                    }
                } else if ($('#choose').index() == 3) {
                    var five = '';
                    $('input.contains:checked').each(function () {
                        five += $(this).val();
                    });
                    if (five != '') {
                        nextChoose();
                    } else {
                        alert('此项必填')
                    }
                } else if ($('#choose').index() == 4) {
                    var sex = '';
                    $('input.server:checked').each(function () {
                        sex += $(this).val();
                    });
                    if (sex != '') {
                        nextChoose();
                    } else {
                        alert('此项必填')
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
