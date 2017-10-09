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
    <form method="post" action="{{URL('nursery/teacher')}}">
        <ul>
            <li>
                <span>您希望育婴师是什么学历？(单选)（必填）</span>
                <input type="radio" name="educational" value="初中">初中
                <input type="radio" name="educational" value="高中">高中
                <input type="radio" name="educational" value="大专及以上">大专及以上
                <input type="radio" name="educational" value="没有要求">没有要求
            </li>
            <li>
                <span>您的宝宝有多大了？(单选)（必填）</span>
                <input type="radio" name="long" value="刚满月">刚满月
                <input type="radio" name="long" value="满月-1岁">满月-1岁
                <input type="radio" name="long" value="1-2岁">1-2岁
                <input type="radio" name="long" value="2-3岁">2-3岁
            </li>
            <li>
                <span>您希望育婴师住家还是不住家？(单选)（必填）</span>
                <input type="radio" name="live" value="住家"> 住家
                <input type="radio" name="live" value="不住家">不住家
            </li>
            <li>
                <span>您希望育婴师有几年工作经验？(单选)（必填）</span>
                <input type="radio" name="years" value="3-5年">3-5年
                <input type="radio" name="years" value="5-7年">5-7年
                <input type="radio" name="years" value="7-10年">7-10年
                <input type="radio" name="years" value="10年以上">10年以上
            </li>
            <li>
                <span>您希望育婴师什么时候到岗？(单选)（必填）</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="一个月以内">一个月以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您是否需要育婴师提供相关资格证书？(多选)（必填）</span>
                <input type="checkbox" class="certificate" name="certificate[]" value="健康证">健康证
                <input type="checkbox" class="certificate" name="certificate[]" value="育婴师资格证书">育婴师资格证书
                <input type="checkbox" class="certificate" name="certificate[]" value="不需要">不需要
                <input type="checkbox" class="certificate" name="certificate[]" value="其他技能证书">其他技能证书
            </li>
            <li>
                <span>您希望获得的服务内容是？(多选)（必填）</span>
                <input type="checkbox" class="server" name="server[]" value="日常生活照料">日常生活照料
                <input type="checkbox" class="server" name="server[]" value="日常保健护理">日常保健护理
                <input type="checkbox" class="server" name="server[]" value="行为培养">行为培养
                <input type="checkbox" class="server" name="server[]" value="早期教育及启蒙">早期教育及启蒙
                <input type="checkbox" class="server" name="server[]" value="疾病预防护理">疾病预防护理
                <input type="checkbox" class="server" name="server[]" value="适量家务劳动">适量家务劳动
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
            var name = new Array('educational', 'long', 'live', 'years', 'time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 4) {
                    if ($('input[name=' + InputName + ']:checked').val() != null) {
                        nextChoose()
                    } else {
                        alert('此项必填');
                    }
                } else if ($('#choose').index() == 4) {
                    var depart = $('input[name=depart]').val();
                    if (depart != '') {
                        nextChoose();
                        $(this).css('display', 'none');
                        $('input[type=submit]').css('display', 'block');
                    } else {
                        alert('此项必填')
                    }
                } else {
                    if ($("#choose").index() == 5) {
                        var four = '';
                        $('input.certificate:checked').each(function () {
                            four += $(this).val();
                        });
                        if (four != '') {
                            nextChoose();
                        } else {
                            alert('此项必填')
                        }
                    } else if ($("#choose").index() == 6) {
                        var five = '';
                        $('input.server:checked').each(function () {
                            five += $(this).val();
                        });
                        if (five != '') {
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
