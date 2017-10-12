@extends('public')
@section('title')选择发布需求分类@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/choose.css') }}"/>
@endsection
@section('body')
    <input type="text" name="address[]" class="place address" placeholder="目的地">
    1@endsection
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