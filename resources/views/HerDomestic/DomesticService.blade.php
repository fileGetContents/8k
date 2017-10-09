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
    <form method="post" action="{{URL('domestic/service')}}">
        <ul>
            <li id="choose">
                <span>您希望的家政服务形式是？(单选)（必填）</span>
                <input type="radio" name="type" value="一次性家政"/>一次性家政
                <input type="radio" name="type" value="短期家政"/>短期家政
                <input type="radio" name="type" value="长期家政（服务期限：至少一年）"/>长期家政（服务期限：至少一年）
            </li>
            <li>
                <span>您希望服务人员一次服务几个小时？(单选)（必填）</span>
                <input type="radio" name="long" value="时间可商量"> 时间可商量
                <input type="radio" name="long" value="2小时">2小时
                <input type="radio" name="long" value="3小时">3小时
                <input type="radio" name="long" value="4小时">4小时
                <input type="radio" name="long" value="4小时以上">4小时以上
            </li>
            <li>
                <span>您希望服务人员是哪里人？(单选)（必填）</span>
                <input type="radio" name="pace" value="本地人"/>本地人
                <input type="radio" name="pace" value="北方人"/>北方人
                <input type="radio" name="pace" value="南方人">南方人
                <input type="radio" name="pace" value="没要求">没要求
                <input type="radio" name="pace" value="其他">其他
            </li>
            <li>
                <span>您希望保姆什么时候到岗？(单选)（必填）</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="一个月以内">一个月以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您希望服务人员一周服务几天？(多选)（必填）</span>
                <input type="checkbox" class="week" name="week[]" value="星期一">星期一
                <input type="checkbox" class="week" name="week[]" value="星期二">星期二
                <input type="checkbox" class="week" name="week[]" value="星期三">星期三
                <input type="checkbox" class="week" name="week[]" value="星期四">星期四
                <input type="checkbox" class="week" name="week[]" value="星期五">星期五
                <input type="checkbox" class="week" name="week[]" value="星期六">星期六
                <input type="checkbox" class="week" name="week[]" value="星期日">星期日
            </li>
            <li>
                <span>您希望获得的服务内容是？(多选)（必填）</span>
                <input type="checkbox" class="server" name="server[]" value="日常家务与保洁">日常家务与保洁
                <input type="checkbox" class="server" name="server[]" value="买菜做饭">买菜做饭
                <input type="checkbox" class="server" name="server[]" value="照顾小孩">照顾小孩
                <input type="checkbox" class="server" name="server[]" value="照顾病人">照顾病人
                <input type="checkbox" class="server" name="server[]" value="照顾老人">照顾老人
                <input type="checkbox" class="server" name="server[]" value="一次性保洁/大扫除">一次性保洁/大扫除
                <input type="checkbox" class="server" name="server[]" value="开荒保洁">开荒保洁
                <input type="checkbox" class="server" name="server[]" value="想进一步和服务商沟通">想进一步和服务商沟通
            </li>
            <li>
                <span>请告诉我们您的大概位置，以便我们安排服务人员。（必填）</span>
                <input type="text" name="depart" placeholder="出发地"/>
            </li>
            <li>
                <span>您还有其他需要特别说明的吗？</span>
                <textarea name="replenish" placeholder="其他需求说明"></textarea>
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
            var name = new Array('type', 'long', 'pace', 'time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 3) {
                    if ($('input[name=' + InputName + ']:checked').val() != null) {
                        nextChoose()
                    } else {
                        alert('此项必填');
                    }
                } else if ($('#choose').index() == 6) {
                    var depart = $('input[name=depart]').val();
                    if (depart != '') {
                        nextChoose();
                        $(this).css('display', 'none');
                        $('input[type=submit]').css('display', 'block');
                    } else {
                        alert('此项必填')
                    }
                } else {
                    if ($("#choose").index() == 4) {
                        var four = '';
                        $('input.week:checked').each(function () {
                            four += $(this).val();
                        });
                        if (four != '') {
                            nextChoose();
                        } else {
                            alert('此项必填')
                        }
                    } else if ($("#choose").index() == 5) {
                        var sex = '';
                        $('input.server:checked').each(function () {
                            sex += $(this).val();
                        });
                        if (sex != '') {
                            nextChoose();
                        } else {
                            alert('此项必填')
                        }
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
