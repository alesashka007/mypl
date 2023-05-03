@extends('layouts.base')
@section('title')
    {{__('Создание Игры')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="#{{route('admin.games')}}">{{__('Игры')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Создание Игры')}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Создание Игры')}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.games.store')}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Название')}}</x-label>
                                <x-input name="name" placeholder="San Andreas Multi Player, Counter-Strike 1.6, Counter-Strike Global Offensive" autofocus/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Короткий код')}}</x-label>
                                <x-input name="code" placeholder="cs,css,css34,csgo,samp"/>
                            </div>
                            <x-button type="submit" >{{__('Создать')}}</x-button>
                        </x-form>
                    </x-card-body>
                </x-card>
            </div>
        </div>
    </section>
@endsection
