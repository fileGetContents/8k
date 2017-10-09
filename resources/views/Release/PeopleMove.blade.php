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
    <form method="post" action="{{URL('people/move')}}">
        <ul>
            <li id="choose">
                <span>您搬家的需要的车型是?(单选)(必填)</span>
                <input type="radio" name="car" value="小面包车"/>小面包车
                <input type="radio" name="car" value="金杯"/>金杯
                <input type="radio" name="car" value="小型平板车"/>小型平板车
                <input type="radio" name="car" value="依维柯"/>依维柯
                <input type="radio" name="car" value="货厢"/>货厢
            </li>
            <li>
                <span>您是否需要搬运工?(单选)(必填)</span>
                <input type="radio" name="carry" value="1"/>是,我需要
                <input type="radio" name="carry" value="0"/>不,我不需要
            </li>
            <li>
                <span>您要搬出的地方是否有电梯吗？(单选)(必填)</span>
                <input type="radio" name="elevator" value="yes">有电梯
                <input type="radio" name="elevator" value="1-3">1-3层
                <input type="radio" name="elevator" value="4-7">4-7层
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

            var name = new Array('car', 'carry', 'elevator', 'elevator1', 'time', 'depart', 'purpose');
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
