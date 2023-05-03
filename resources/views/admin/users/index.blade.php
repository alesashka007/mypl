@extends('layouts.base')
@section('title')
    {{__('Новости')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Пользователи')}}</a>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">{{__('Имя')}}</th>
            <th scope="col">{{__('Фамилия')}}</th>
            <th scope="col">{{__('Email')}}</th>
            <th scope="col">{{__('Баланс')}}</th>
            <th scope="col">{{__('Права')}}</th>
            <th scope="col">{{__('Дата создания')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        @php
        if($user->admin){
        $user_rights = __('Администратор');
    }else{
        $user_rights = __('Клиент');
    }
    @endphp
    <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->firstname}}</td>
        <td>{{$user->lastname}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->balance}} $</td>
        <td>{{$user_rights}}</td>
        <td>{{$user->created_at}}</td>
        <td>
            <a class="fa-solid fa-edit" href="{{route('admin.users.edit', $user->id)}}"></a>
            <a class="fa-solid fa-trash" href="{{route('admin.users.destroy', $user->id)}}"></a>
        </td>
    </tr>
@endforeach
</tbody>
</table>
<div class="mx-auto" style="width: 200px;">{{ $users->links() }}</div>
@endsection
