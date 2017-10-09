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
    <form method="post" action="{{URL('patient/escort')}}">
        <ul>
            <li id="choose">
                <span>您希望陪护的性别为？(单选)（必填）</span>
                <input type="radio" value="男" name="sex_peo">男
                <input type="radio" value="女" name="sex_peo">女
                <input type="radio" value="无所谓" name="sex_peo">无所谓
            </li>
            <li>
                <span>病人的性别是？(单选)（必填）</span>
                <input type="radio" value="男" name="sex_need">男
                <input type="radio" value="女" name="sex_need">女
            </li>
            <li>
                <span>病人的年龄是？(单选)（必填）</span>
                <input type="radio" name="years" value="30岁以内">30岁以内
                <input type="radio" name="years" value="31-40岁">31-40岁
                <input type="radio" name="years" value="41-50岁">41-50岁
                <input type="radio" name="years" value="51-60岁">51-60岁
                <input type="radio" name="years" value="51-60岁">51-60岁
            </li>
            <li>
                <span>病人在什么时间需要陪护？(单选)（必填）</span>
                <input type="radio" name="pat_time" value="白天">白天
                <input type="radio" name="pat_time" value="夜间">夜间
                <input type="radio" name="pat_time" value="24小时">24小时
            </li>
            <li>
                <span>您希望陪护是临时还是长期？(单选)（必填）</span>
                <input type="radio" name="time_limit" value="长期陪护">长期陪护
                <input type="radio" name="time_limit" value="临时陪护">临时陪护
            </li>
            <li>
                <span>您希望陪护有几年工作经验？(单选)（必填）</span>
                <input type="radio" name="work_year" value="1-3年">1-3年
                <input type="radio" name="work_year" value="4-6年">4-6年
                <input type="radio" name="work_year" value="7-10年">7-10年
                <input type="radio" name="work_year" value="10年以上">10年以上
            </li>
            <li>
                <span>您是否需要陪护提供相关资格证书？(单选)（必填）</span>
                <input type="radio" name="certificate">健康证
                <input type="radio" name="certificate">不需要
            </li>
            <li>
                <span>您希望陪护什么时候到岗？(单选)（必填）</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="一个月以内">一个月以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您希望获得的服务内容是？(多选)（必填）</span>
                <input type="checkbox" class="server" name="server[]" value="饮食护理">饮食护理
                <input type="checkbox" class="server" name="server[]" value="压疮预防">压疮预防
                <input type="checkbox" class="server" name="server[]" value="康复锻炼">康复锻炼
                <input type="checkbox" class="server" name="server[]" value="排泄护理">排泄护理
                <input type="checkbox" class="server" name="server[]" value="病情/用药观察">病情/用药观察
                <input type="checkbox" class="server" name="server[]" value="病人心理护理">病人心理护理
                <input type="checkbox" class="server" name="server[]" value="入浴与日常清洁">入浴与日常清洁
                <input type="checkbox" class="server" name="server[]" value="环境整理/生活照顾">环境整理/生活照顾
                <input type="checkbox" class="server" name="server[]" value="想进一步和服务商沟通">想进一步和服务商沟通
            </li>
            <li>
                <span>您需要哪种陪护类型？(多选)（必填）</span>
                <input type="checkbox" class="type" name="type[]" value="重症陪护">重症陪护
                <input type="checkbox" class="type" name="type[]" value="偏瘫照护">偏瘫照护
                <input type="checkbox" class="type" name="type[]" value="短期住院陪护">短期住院陪护
                <input type="checkbox" class="type" name="type[]" value="术后/康复期陪护">术后/康复期陪护
                <input type="checkbox" class="type" name="type[]" value="其他">其他
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

            var name = new Array('sex_peo', 'sex_need', 'years', 'pat_time', 'time_limit', 'work_year', 'certificate', 'time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 7) {
                    if ($('input[name=' + InputName + ']:checked').val() != null) {
                        nextChoose()
                    } else {
                        alert('此项必填');
                    }
                } else if ($('#choose').index() == 10) {
                    var depart = $('input[name=depart]').val();
                    if (depart != '') {
                        nextChoose();
                        $(this).css('display', 'none');
                        $('input[type=submit]').css('display', 'block');
                    } else {
                        alert('此项必填')
                    }
                } else {

                    if ($("#choose").index() == 8) {
                        var four = '';
                        $('input.server:checked').each(function () {
                            four += $(this).val();
                        });
                        if (four != '') {
                            nextChoose();
                        } else {
                            alert('此项必填')
                        }
                    } else if ($('#choose').index() == 9) {
                        var sex = '';
                        $('input.type:checked').each(function () {
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
