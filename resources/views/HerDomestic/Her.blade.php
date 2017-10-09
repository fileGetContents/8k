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
    <form method="post" action="{{URL('her')}}">
        <ul>
            <li id="choose">
                <span>您的预产期是？(单选)（必填）</span>
                <input type="radio" name="birthday" value="宝宝已出生">宝宝已出生
                <input type="radio" name="birthday" value="1个月后">1个月后
                <input type="radio" name="birthday" value="3个月后">2个月后
                <input type="radio" name="birthday" value="3个月后">3个月后
            </li>
            <li>
                <span>您希望月嫂是哪里人？(单选)（必填）</span>
                <input type="radio" name="pace" value="本地人"/>本地人
                <input type="radio" name="pace" value="北方人"/>北方人
                <input type="radio" name="pace" value="南方人">南方人
                <input type="radio" name="pace" value="没要求">没要求
                <input type="radio" name="pace" value="其他">其他
            </li>
            <li>
                <span>您希望月嫂有几年工作经验？(单选)（必填）</span>
                <input type="radio" name="years" value="3-5年">3-5年
                <input type="radio" name="years" value="5-7年">5-7年
                <input type="radio" name="years" value="7-10年">7-10年
                <input type="radio" name="years" value="10年以上">10年以上
            </li>
            <li>
                <span>您在搬家/搬运时需要额外的增值服务吗?(多选)(必填)</span>
                <input type="radio" value="26天（基础服务天数）" name="long"/>26天（基础服务天数）
                <input type="radio" value="42天（产后最后一次产检）" name="long"/>42天（产后最后一次产检）
                <input type="radio" value="52天（双月子）" name="long"/>52天（双月子）
            </li>
            <li>
                <span>你理想的搬家时间是什么时候？(单选)(必填)</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="一个月以内">一个月以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>您的大概位置是哪里？(必填)</span>
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

            var name = new Array('birthday', 'pace', 'years', 'long', 'time');
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
