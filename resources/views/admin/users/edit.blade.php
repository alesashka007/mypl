{{--@dd($news)--}}
@extends('layouts.base')
@section('title')
    {{$user->firstname . ' ' . $user->lastname}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="{{route('admin.users')}}">{{__('Пользователи')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Изменение пользователя')}} # {{$user->id}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Изменение пользователя')}} #{{$user->id}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.users.update', $user->id)}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Имя')}}</x-label>
                                <x-input name="firstname" value="{{$user->firstname}}" placeholder="{{__('Имя')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Фамилия')}}</x-label>
                                <x-input name="lastname" value="{{$user->lastname}}" placeholder="{{__('Имя')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Email')}}</x-label>
                                <x-input name="email" value="{{$user->email}}" placeholder="{{__('Email')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Баланс')}} $</x-label>
                                <x-input name="balance" type="number" value="{{$user->balance}}" placeholder="{{__('100')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Права')}}</x-label>
                                <select class="form-control" name="admin">
                                    <option @if($user->admin == 1) selected @endif value="1">{{_('Администратор')}}</option>
                                    <option @if($user->admin == 0) selected @endif value="0">{{_('Клиент')}}</option>
                                </select>
                            </div>
                            <x-button type="submit" >{{__('Сохранить')}}</x-button>
                        </x-form>
                    </x-card-body>
                </x-card>
            </div>
        </div>
    </section>
@endsection
