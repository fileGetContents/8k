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
    <form method="post" action="{{URL('good/service')}}">
        <ul>
            <li id="choose">
                <span>您需要服务对象是?(单选)(必填)</span>
                <input type="radio" name="car" value="小型面包车"/>小型面包车
                <input type="radio" name="car" value="中型面包车"/>中型面包车
                <input type="radio" name="car" value="小型货车"/>小型货车
                <input type="radio" name="car" value="中型货车"/>中型货车
                <input type="radio" name="car" value="小型平板车"/>小型平板车
                <input type="radio" name="car" value="中型平板车"/>中型平板车
                <input type="radio" name="car" value="依维柯"/>依维柯
            </li>
            <li>
                <span>您是否需要人工搬运？(单选)(必填)</span>
                <input type="radio" name="carry" value="是，我需要" />是，我需要
                <input type="radio" name="carry" value="不,我不需要" />不,我不需要
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
            var name = new Array('car', 'carry', 'time', 'depart', 'purpose');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 2) {
                    if ($('input[name=' + InputName + ']:checked').val() != null) {
                        nextChoose()
                    } else {
                        alert('此项必填');
                    }
                } else if ($('#choose').index() == 3) {
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
