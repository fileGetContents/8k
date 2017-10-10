@extends('public')

@section('title')选择发布需求分类@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/choose.css') }}"/>
@endsection
@section('body')
    <input type="text" name="address[]" class="place address" placeholder="目的地">
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

            $('.class').change(function () {
                $.ajax({
                    type: 'get',
                    url: 'http://apis.map.qq.com/ws/place/v1/suggestion/?keyword=' + $(this).val() + '&key=EOWBZ-23M3S-FHWOP-6H5NO-3BVO5-ENBTR',
                    success: function (obj) {
                        console.log(obj);
                    },
                    error: function (obj) {

                    }
                })
            })

        })
    </script>
@endsection