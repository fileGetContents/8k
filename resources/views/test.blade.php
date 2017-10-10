@extends('public')

@section('title')选择发布需求分类@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/choose.css') }}"/>
@endsection
@section('body')
    <input type="text" name="address[]" class="place address" placeholder="目的地">
    <div id="search_word_result" style="border: 1px solid #c5c5c5;width: 100%">
        {{--<div>后海酒吧美食街</div>--}}
        {{--<div>王府井小吃街</div>--}}
        {{--<div>美食一条街</div>--}}
        {{--<div>鲜鱼口老字号美食街</div>--}}
        {{--<div>畅春园·食街</div>--}}
        {{--<div>本垒美式烤肉(霄云路店)</div>--}}
        {{--<div>都一处(方庄店)</div>--}}
        {{--<div>美食好景酒楼</div>--}}
        {{--<div>美食美客(麻辣香锅)</div>--}}
        {{--<div>美食一条街</div>--}}
    </div>
    <input class="address" type="submit" value="成都"/>
@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            $('.right_menu').eq(0).css('display', 'block')
        })
    </script>
    <script type="text/javascript" src="{{ asset('js/choose.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.address').keydown(function () {
                $.ajax({
                    type: 'post',
                    data: {'keyword': $(this).val()},
                    dataType: 'json',
                    url: '{{URL("map/similarity")}}',
                    success: function (obj) {
                        $('#search_word_result').empty();
                        console.log(obj);
                        obj.data.map(function (value, index, array) {
                            $('#search_word_result').append('<div>' + value['address'] + '</div>');
                        })
                    },
                    error: function (obj) {

                    }
                })
            })
        });


    </script>
@endsection