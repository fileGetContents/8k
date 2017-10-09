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
    <form method="post" action="{{URL('escort')}}">
        <ul>
            <li id="choose">
                <span>您想要的陪护类型是？(单选)（必填）</span>
                <input type="radio" name="type" value="老人陪护"/>老人陪护
                <input type="radio" name="type" value="病人陪护"/>病人陪护
                <input type="radio" name="type" value="小孩陪护"/>小孩陪护
                <input type="radio" name="type" value="残疾人陪护">残疾人陪护
                <input type="radio" name="type" value="想进一步和服务商沟通">想进一步和服务商沟通
            </li>
            <li>
                <span>陪护的工作地点是？(单选)（必填）</span>
                <input type="radio" name="pace" value="居家陪护">居家陪护
                <input type="radio" name="pace" value="住院陪护">住院陪护
                <input type="radio" name="pace" value="想进一步和服务商沟通">想进一步和服务商沟通
            </li>
            <li>
                <span>您希望陪护的性别是？(单选)（必填）</span>
                <input type="radio" name="sex" value="男">男
                <input type="radio" name="sex" value="女">女
            </li>
            <li>
                <span>您希望陪护是临时还是长期？(单选)（必填）</span>
                <input type="radio" name="long" value="长期">长期
                <input type="radio" name="long" value="临时">临时
            </li>
            <li>
                <span>需陪护者的自理情况如何？(单选)（必填）</span>
                <input type="radio" name="case" value="自理">自理
                <input type="radio" name="case" value="半自理">半自理
                <input type="radio" name="case" value="完全不能自理">完全不能自理
                <input type="radio" name="case" value="想进一步和服务商沟通">想进一步和服务商沟通
            </li>
            <li>
                <span>您理想的陪护到岗时间？(单选)（必填）</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="一个月以内">一个月以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
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
            var name = new Array('type', 'pace', 'sex', 'long','case','time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 5) {
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
