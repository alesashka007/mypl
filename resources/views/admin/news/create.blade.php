@extends('layouts.base')
@section('title')
    {{__('Создание Новости')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="#{{route('admin.news')}}">{{__('Новости')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Создание новости')}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Создание новости')}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.news.store')}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Заголовок')}}</x-label>
                                <x-input name="title" placeholder="{{__('Заголовок')}}" autofocus/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Описание')}}</x-label>
                                <textarea class="form-control" name="text" placeholder="{{__('Описание')}}"></textarea>
                            </div>
                            <x-button type="submit" >{{__('Создать')}}</x-button>
                        </x-form>
                    </x-card-body>
                </x-card>
            </div>
        </div>
    </section>
@endsection
