@extends('layouts.base')
@section('title')
    {{__('Услуги')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Услуги')}}</a>
@endsection
@section('content')
    <ul class="nav nav-tabs nav-pills" align="center">
@foreach($games as $game)
            <li class="active">
                <a href="{{route('order.game', $game->id)}}"><img src="https://demo.gamepl.su/img/games2/{{$game->code}}.png" style="margin-left: 4px; margin-right: 4px; width: 70px;" /></a>
            </li>
@endforeach

</ul>
@endsection
