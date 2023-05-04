@extends('layouts.base')
@section('title')
    {{__('Локации')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('VDS')}}</a>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">{{__('Статус')}}</th>
            <th scope="col">{{__('Локация')}}</th>
            <th scope="col">IP:PORT</th>
            <th scope="col">{{__('Ядер')}}</th>
            <th scope="col">{{__('Создана')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($vds as $vd)
            @php
                if($vd->status == 1){
                $vd_status['status'] = 'success';
                $vd_status['message'] = __('Активный');
            }else{
                $vd_status['status'] = 'danger';
                $vd_status['message'] = __('Не активный');
            }
            @endphp
            <tr>
                <th scope="row">{{$vd->id}}</th>
                <td><p class="btn btn-{{$vd_status['status']}}">{{$vd_status['message']}}</p></td>
                <td>{{$vd->location->name}}</td>
                <td>{{$vd->ip.':'.$vd->port}}</td>
                <td>{{$vd->cores}}</td>
                <td>
                    {{$vd->created_at}}
                </td>
                <td>
                    <a class="fa-solid fa-edit" href="{{route('admin.vds.edit', $vd->id)}}"/>&nbsp;
                    <a class="fa-solid fa-trash" href="{{route('admin.vds.destroy', $vd->id)}}"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mx-auto" style="width: 200px;">{{ $vds->links() }}</div>
@endsection
