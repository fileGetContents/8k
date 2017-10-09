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
    <form method="post" action="{{URL('internationalSeed')}}">
        <ul>
            <li id="choose">
                <span>您希望寄往哪个国家？(单选)（必填）</span>
                <input type="radio" name="country" value="中国香港/澳门"/>中国香港/澳门
                <input type="radio" name="country" value="中国台湾"/>中国台湾
                <input type="radio" name="country" value="韩国"/>韩国
                <input type="radio" name="country" value="日本"/>日本
                <input type="radio" name="country" value="美国"/>美国
                <input type="radio" name="country" value="加拿大"/>加拿大
                <input type="radio" name="country" value="东南亚"/>东南亚
                <input type="radio" name="country" value="其他国家">其他国家
            </li>
            <li>
                <span>你希望快递什么物品？(单选)（必填）</span>
                <input type="radio" name="goods" value="普货运输"/>普货运输
                <input type="radio" name="goods" value="粉末空运"/>粉末空运
                <input type="radio" name="goods" value="液体空运"/>液体空运
                <input type="radio" name="goods" value="宠物托运"/>宠物托运
                <input type="radio" name="goods" value="食品空运"/>食品空运
                <input type="radio" name="goods" value="化工品空运"/>化工品空运
                <input type="radio" name="goods" value="危险品空运"/>危险品空运
                <input type="radio" name="goods" value="参展物品空运"/>参展物品空运
            </li>
            <li>
                <span>您需要我们帮您准备快递包装吗？(单选)（必填）</span>
                <input type="radio" name="need" value="不需要，我自己准备">不需要，我自己准备
                <input type="radio" name="need" value="需要，请帮我准备">需要，请帮我准备
            </li>
            <li>
                <span>您希望您的寄件大概什么时候到目的地？(单选)（必填）</span>
                <input type="radio" name="time" value="越快越好"/>越快越好
                <input type="radio" name="time" value="一周以内"/>一周以内
                <input type="radio" name="time" value="一个月以内"/>一个月以内
                <input type="radio" name="time" value="选择具体的时间"/>选择具体的时间
            </li>
            <li>
                <span>告诉我们您的地址，以便我们上门取件？（必填）</span>
                <input type="text" name="depart" placeholder="出发地"/>
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
            var name = new Array('country', 'goods', 'need', 'time');
            $("input[type=button]").click(function () {
                var InputName = name[$('#choose').index()];
                if ($('#choose').index() <= 3) {
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
