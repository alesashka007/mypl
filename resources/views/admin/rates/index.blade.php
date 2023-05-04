@extends('layouts.base')
@section('title')
    {{__('Тарифы')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Тарифы')}}</a>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">{{__('Название')}}</th>
            <th scope="col">{{__('Игра')}}</th>
            <th scope="col">{{__('Локация:IP')}}</th>
            <th scope="col">{{__('Статус')}}</th>
            <th scope="col">{{__('Цена/Слот')}}</th>
            <th scope="col">{{__('Создана')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($rates as $rate)
            @php
                if($rate->status == 1){
                $rate_status['status'] = 'success';
                $rate_status['message'] = __('Активный');
            }else{
                $rate_status['status'] = 'danger';
                $rate_status['message'] = __('Не активный');
            }
            @endphp
            <tr>
                <th scope="row">{{$rate->id}}</th>
                <td>{{$rate->name}}</td>
                <td>{{$rate->game->name}}</td>
                <td>{{$rate->vds->location->name.':'.$rate->vds->ip}}</td>
                <td><p class="btn btn-{{$rate_status['status']}}">{{$rate_status['message']}}</p></td>
                <td>{{$rate->price}}</td>
                <td>
                    {{$rate->created_at}}
                </td>
                <td>
                    <a class="fa-solid fa-edit" href="{{route('admin.rates.edit', $rate->id)}}"/>&nbsp;
                    <a class="fa-solid fa-trash" href="{{route('admin.rates.destroy', $rate->id)}}"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mx-auto" style="width: 200px;">{{ $rates->links() }}</div>
@endsection
