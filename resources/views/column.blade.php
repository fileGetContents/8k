@extends('public')

@section('title')选择发布需求分类@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/choose.css') }}"/>
@endsection

@section('body')
    <div class="top">
        您需要发布下面哪种类型的需求
    </div>
    <ul class="left_menu">
        @foreach($top as $value)
            <li>{{$value->column_name}}</li>
        @endforeach
    </ul>
    @foreach($child as $value)
        <ul class="right_menu">
            @foreach($value as $v)
                <li><a href="{{URL('user/choose/'.$v->id)}}">{{ $v->column_name }}</a></li>
            @endforeach
        </ul>
    @endforeach

@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            $('.right_menu').eq(0).css('display', 'block')
        })
    </script>
    <script type="text/javascript" src="{{ asset('js/choose.js') }}"></script>
@endsection