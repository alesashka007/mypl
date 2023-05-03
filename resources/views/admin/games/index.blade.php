@extends('layouts.base')
@section('title')
    {{__('Игры')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Игры')}}</a>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">{{__('Статус')}}</th>
            <th scope="col">{{__('Код игры')}}</th>
            <th scope="col">{{__('Название')}}</th>
            <th scope="col">{{__('Дата создания')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($games as $game)
            @php
                if($game->status == 1){
                $game_status['status'] = 'success';
                $game_status['message'] = __('Активный');
            }else{
                $game_status['status'] = 'danger';
                $game_status['message'] = __('Не активный');
            }
            @endphp
            <tr>
                <th scope="row">{{$game->id}}</th>
                <td><p class="btn btn-{{$game_status['status']}}">{{$game_status['message']}}</p></td>
                <td>{{$game->code}}</td>
                <td>{{$game->name}}</td>
                <td>
                    {{$game->created_at}}
                </td>
                <td>
                    <a class="fa-solid fa-edit" href="{{route('admin.games.edit', $game->id)}}"/>
                    <a class="fa-solid fa-trash" href="{{route('admin.games.destroy', $game->id)}}"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
