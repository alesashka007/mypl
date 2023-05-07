@extends('layouts.base')
@section('title')
    {{$user->firstname . ' '. $user->lastname}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Профиль')}}</a>
@endsection
@section('content')
    <x-form action="{{route('save_profile')}}">
        @csrf
        <div class="container rounded bg-white mb-5">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-1" width="150px"
                             src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">{{__('Аватарка')}}</span>
                        <x-input style="max-width: 80%" type="file" name="avatar"/>
                    </div>
                </div>
                <div class="col-md-7 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">{{__('Настройки профиля')}}</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">{{__('Баланс')}}</label>
                                <x-input disabled name="balance" value="{{$user->balance}}"/>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">&nbsp;</label>
                                <div><a href="{{--route('pay')--}}" class="btn btn-primary">{{__('Пополнить')}}</a></div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">{{__('Имя')}}</label>
                                <x-input name="firstname" placeholder="{{__('firstname')}}"
                                         value="{{$user->firstname}}"/>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">{{__('Фамилия')}}</label>
                                <x-input name="lastname" placeholder="{{__('lastname')}}" value="{{$user->lastname}}"/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">{{__('Email')}}</label>
                                <x-input name="email" disabled value="{{$user->email}}"/>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">{{__('Текущий пароль')}}</label>
                                <x-input type="password" name="old_password" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">{{__('Новый пароль')}}</label>
                                <x-input type="password" name="password" />
                                <label class="labels">{{__('Повтор')}}</label>
                                <x-input type="password" name="password_confirmation" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center">
            <x-button class="btn btn-success" type="submit">{{__('Сохранить')}}</x-button>
        </div>
    </x-form>
@endsection
