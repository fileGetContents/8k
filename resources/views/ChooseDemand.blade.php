@extends('public')

@section('css')

@endsection

@section('body')
    <style type="text/css">
        #choose {
            display: block;
        }

        .choose_all {
            display: none;
        }
    </style>
    <form method="post" action="{{URL('add/demand')}}">

        <input type="text" name="id" hidden="hidden" value="{{ $id }}">

        <ul class="ul">
            @foreach( $options  as $value)
                <li>
                    <span>{{$value->choose}}</span>
                    {!! $value->prompting !!}
                </li>
            @endforeach
        </ul>
        <span id="pre" style="display: none">上一页</span>
        <input type="button" value="下一个">
        <input type="submit" style="display: none" value="提交">
    </form>
@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            $('.ul li').attr('class', 'choose_all').eq(0).attr('id', 'choose');
            // 单选框跳转
            $('input[type=radio]').click(function () {
                nextChoose();
                $('#pre').css('display', 'block');
                getSub();
            });
            // 选择判断
            $('input[type=button]').click(function () {
                var attrClass = $('#choose input').attr('class');
                if (attrClass == 'required') {
                    var input_type = $('#choose').children().eq(1).attr('type');
                    if (input_type == 'radio') {
                        var whether = $('#choose').children('input[type=radio]:checked').val();
                    } else if (input_type == 'checkbox') {
                        var whether = null;
                        $('#choose').children('input[type=checkbox]:checked').each(function () {
                            whether += $(this).val();
                        });
                    } else {
                        var text_len = $('#choose').children('input[type=text]').length;
                        var val_len = 0;
                        $('#choose').children('input[type=text]').each(function () {
                            if ($(this).val() != '') {
                                val_len++;
                            }
                        });
                        if (text_len == val_len) {
                            var whether = '33333'
                        } else {
                            var whether = null;
                        }
                    }
                    if (whether != null) {
                        nextChoose()
                    } else {
                        alert('此项必填')
                    }
                } else {
                    nextChoose()
                }

                getSub();

                if ($('#choose').index() == 1) {
                    $('#pre').css('display', 'block');
                }
            });

            $('#pre').click(function () {
                $("#choose").removeAttr('id').prev().attr('id', 'choose');
                $('input[type=button]').css('display', 'block');
                $('input[type=submit]').css('display', 'none');
                if ($('#choose').index() == 0) {
                    $('#pre').css('display', 'none');
                } else {
                    $('#pre').css('display', 'block');
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
        /**
         *  获取提交
         */
        function getSub() {
            // 获取提交
            var len = $('.ul').children().length;
            len = len - 1;
            if (len == Math.abs($('#choose').index())) {
                $('input[type=button]').css('display', 'none');
                $('input[type=submit]').css('display', 'block');
            }
        }
    </script>
@endsection


