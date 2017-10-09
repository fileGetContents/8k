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
    <form method="post" action="{{URL('air/conditioning')}}">
        <ul>
            <li id="choose">
                <span>您属于企业搬家还是工厂搬迁(单选)(必填)</span>
                <input type="radio" class="required" name="company" value="企业搬家"/>企业搬家
                <input type="radio" class="required" name="company" value="工厂搬迁"/>工厂搬迁
                <input type="radio" class="required" name="company" value="工厂搬迁"/>工厂搬迁
            </li>
            <li>
                <span>您搬运的物件是否含易碎物品?(单选)(必填)</span>
                <input type="radio" class="required" name="fragile" value="不包含"/>不包含
                <input type="radio" class="required" name="fragile" value="包含"/>包含
            </li>
            <li>
                <span>您要搬出的地方是否有电梯吗？(单选)(必填)</span>
                <input type="radio" class="required" name="elevator" value="yes">有电梯
                <input type="radio" class="required" name="elevator" value="1-3">1-3层
                <input type="radio" class="required" name="elevator" value="4-7">4-7层
            </li>
            <li>
                <span>你想搬去的地方有电梯吗？(单选)(必填)</span>
                <input type="radio" name="elevator1" value="yes">有电梯
                <input type="radio" name="elevator1" value="1-3">1-3层
                <input type="radio" name="elevator1" value="4-7">4-7层
            </li>
            <li>
                <span>你理想的搬家时间是什么时候？(单选)(必填)</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您的出发地和目的地分别是哪里？(必填)</span>
                <input type="text" class="required" name="depart" placeholder="出发地"/>
                <input type="text" class="required" name="purpose" placeholder="目的地"/>
            </li>
            <li>
                <span>您在搬家/搬运时需要额外的增值服务吗?(多选)(必填)</span>
                <input type="checkbox" class="required" value="物品打包" name="server[]"/>物品打包
                <input type="checkbox" class="required" value="叉车、吊车、起重机等工业搬运车辆" name="server[]"/>叉车、吊车、起重机等工业搬运车辆
                <input type="checkbox" class="required" value="途中卸载" name="server[]"/>途中卸载
                <input type="checkbox" class="required" value="办公家具拆卸组装" name="server[]"/>办公家具拆卸组装
                <input type="checkbox" class="required" value="临时厂库" name="server[]"/>临时仓库
                <input type="checkbox" class="required" value="想和服务商进一步沟通" name="server[]"/>想和服务商进一步沟通
                <input type="checkbox" class="required" value=大型设备搬运 name="server[]"/>大型设备搬运
            </li>
            <li>
                <span>您还有其他需要特别说明的吗？</span>
                <textarea  class="not_required" name="replenish" placeholder="若您还需要其他增值服务(如贵重物品搬运、途中装卸等),请在此处填写。"></textarea>
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

            var name = new Array('company', 'fragile', 'elevator', 'elevator1', 'time', 'depart', 'server', 'replenish');

            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 4) {
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
                    } else {
                        alert('此项必填')
                    }
                } else if ($('#choose').index() == 6) {
                    var check = '';
                    $('input[type=checkbox]:checked').each(function () {
                        check += $(this).val();
                    });
                    if (check != '') {
                        nextChoose();
                        $(this).css('display', 'none');
                        $('input[type=submit]').css('display', 'block');
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
