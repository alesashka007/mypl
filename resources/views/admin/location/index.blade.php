@extends('layouts.base')
@section('title')
    {{__('Локации')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Локации')}}</a>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">{{__('Название')}}</th>
            <th scope="col">{{__('Статус')}}</th>
            <th scope="col">{{__('Дата создания')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($locs as $loc)
            @php
                if($loc->status == 1){
                $loc_status['status'] = 'success';
                $loc_status['message'] = __('Активный');
            }else{
                $loc_status['status'] = 'danger';
                $loc_status['message'] = __('Не активный');
            }
            @endphp
    <tr>
        <th scope="row">{{$loc->id}}</th>
        <td>{{$loc->name}}</td>
        <td><p class="btn btn-{{$loc_status['status']}}">{{$loc_status['message']}}</p></td>
        <td>
            {{$loc->created_at}}
        </td>
        <td>
            <a class="fa-solid fa-edit" href="{{route('admin.location.edit', $loc->id)}}" />&nbsp;
            <a class="fa-solid fa-trash" href="{{route('admin.location.destroy', $loc->id)}}" />
        </td>
    </tr>
@endforeach
</tbody>
</table>
<div class="mx-auto" style="width: 200px;">{{ $locs->links() }}</div>
@endsection
