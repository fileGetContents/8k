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
                <input type="radio" name="type" value="挂壁式"/>挂壁式
                <input type="radio" name="type" value="立体式"/>立体式
                <input type="radio" name="type" value="嵌入式"/>嵌入式
            </li>
            <li>
                <span>您所住得楼层是?(单选)</span>
                <input type="radio" name="floors" value="2楼及其以下"/>2楼及其以下
                <input type="radio" name="floors" value="2楼至6楼"/>2楼至6楼
                <input type="radio" name="floors" value="6楼以上">6楼以上
            </li>
            <li>
                <span>您的服务是针对个人还是公司(单选)(必填)</span>
                <input type="radio" name="who" value="个人">个人
                <input type="radio" name="who" value="公司">公司
            </li>
            <li>
                <span>你想搬去的地方有电梯吗？(单选)(必填)</span>
                <input type="radio" name="horse" value="1P">1P
                <input type="radio" name="horse" value="1.5p">1.5p
                <input type="radio" name="horse" value="2p">2p
                <input type="radio" name="horse" value="2.5p">2.5p
                <input type="radio" name="horse" value="3p">3p
                <input type="radio" name="horse" value="5p">5p
                <input type="radio" name="horse" value="5p以上">5p以上
                <input type="radio" name="horse" value="不知道具体几匹数">不知道具体几匹数
                <input type="radio" name="horse" value="其他">其他
            </li>
            <li>
                <span>你理想的搬家时间是什么时候？(单选)(必填)</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您的大概位置是哪里？(必填)</span>
                <input type="text" name="depart" placeholder="出发地"/>
            </li>
            <li>
                <span>您在搬家/搬运时需要额外的增值服务吗?(多选)(必填)</span>
                <input type="checkbox" value="空调清洗" name="server[]"/>空调清洗
                <input type="checkbox" value="空调维修" name="server[]"/>空调维修
                <input type="checkbox" value="空调加液" name="server[]"/>空调加液
                <input type="checkbox" value="不需要" name="server[]"/>不需要
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

            var name = new Array('type', 'floors', 'who', 'horse', 'time');

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
                    if (depart != '') {
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
