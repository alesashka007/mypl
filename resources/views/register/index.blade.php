@extends('layouts.base')
@section('title')
    {{__('Регистрация')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="#">{{__('Регистрация')}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Регистрация')}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('register.store')}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Имя')}}</x-label>
                                <x-input name="firstname" placeholder="Ivan" autofocus/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Фамилия')}}</x-label>
                                <x-input name="lastname" placeholder="Ivanov"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Email')}}</x-label>
                                <x-input type="email" name="email" placeholder="{{__('Email')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Пароль')}}</x-label>
                                <x-input type="password" name="password" placeholder="{{__('Пароль')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Повторите Пароль')}}</x-label>
                                <x-input type="password"  name="password_confirmation" placeholder="{{__('Повторите Пароль')}}"/>
                            </div>
                            <div class="mb-3">
                                <div class="form-checkbox">
                                    <input type="checkbox" name="agreement" value="1" class="form-check-input" id="agreement"/>
                                    <x-label for="agreement">{{__('Согласие на обработку пользовательских данных')}}</x-label>
                                </div>
                            </div>
                            <x-button type="submit" >{{__('Зарегистрироваться')}}</x-button>
                        </x-form>
                    </x-card-body>
                </x-card>
            </div>
        </div>
    </section>
@endsection
