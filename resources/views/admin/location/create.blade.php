@extends('layouts.base')
@section('title')
    {{__('Создание Локации')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="#{{route('admin.news')}}">{{__('Локации')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Создание локации')}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Создание локации')}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.location.store')}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Название')}}</x-label>
                                <x-input name="name" placeholder="{{__('Название')}}" autofocus/>
                            </div>
                            <x-button type="submit" >{{__('Создать')}}</x-button>
                        </x-form>
                    </x-card-body>
                </x-card>
            </div>
        </div>
    </section>
@endsection
