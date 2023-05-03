@extends('layouts.base')
@section('title')
    Вход | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link " aria-current="page" href="#">{{__('Вход')}}</a>
@endsection
@section('content')
    <x-errors />
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <x-card>
                <x-card-body>
                    <h4 class="m-0">
                        Вход
                    </h4>
                </x-card-body>
                <x-card-body>
                    <x-form action="{{route('login.store')}}" method="post" class="">
                        @csrf
                        <div class="mb-3">
                            <label class="required">Email</label>
                            <x-input type="email" name="email" placeholder="Email" autofocus/>
                        </div>
                        <div class="mb-3">
                            <label class="required">Пароль</label>
                            <x-input type="password" name="password" placeholder="Пароль"/>
                        </div>
                        <div class="mb-3">
                            <div class="form-checkbox">
                                <input type="checkbox" name="remember" value="1" class="form-check-input" id="remember"/>
                                <x-label for="remember">{{__('Запомнить меня')}}</x-label>
                            </div>
                        </div>
                        <x-button type="submit">{{__('Войти')}}</x-button>
                    </x-form>
                </x-card-body>
            </x-card>
        </div>
    </div>
    </section>
@endsection
