@extends('public')

@section('css')
@endsection


@section('body')
    <form action="{{ URL('add/replenish') }}" method="post">
        <input type="text" hidden="hidden" name="id" value="{{ $id }}">
        <ul>
            @foreach($replenish as $value)
                <li>
                    <span>{{$value->prompting}}</span>
                    {!! $value->choose !!}
                </li>
            @endforeach
            <input type="submit" value="提交"/>
        </ul>
    </form>

@endsection


@section('js')

@endsection