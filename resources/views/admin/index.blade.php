@extends('layouts.base')
@section('title')
    {{__('Админка')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Админка')}}</a>
@endsection
@section('content')
    <style>
        .col-sm-4{
            margin-top: 5px;
        }
    </style>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-newspaper"> </i>{{__('Новости')}}</h5>
                    <p class="card-text">{{__('Всего новостей'). ' (' . modelCount('News')}})</p>
                    <a href="{{route('admin.news')}}" class="btn btn-primary">{{__('Просмотр')}}</a>
                    <a href="{{route('admin.news.create')}}" class="btn btn-primary">{{__('Создать')}}</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-users"> </i>{{__('Пользователи')}}</h5>
                    <p class="card-text">{{__('Всего Пользователей').' (' . modelCount('User')}})</p>
                    <a href="{{route('admin.users')}}"
                       class="btn btn-primary">{{__('Просмотр')}}</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{__('Локации')}}</h5>
                    <p class="card-text">{{__('Всего локаций') .' (' . modelCount('Location')}})</p>
                    <a href="{{route('admin.location')}}" class="btn btn-primary">{{__('Просмотр')}}</a>
                    <a href="{{route('admin.location.create')}}" class="btn btn-primary">{{__('Создать')}}</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{__('VDS Server')}}</h5>
                    <p class="card-text">{{__('Всего серверов') .' (' . modelCount('Vds')}})</p>
                    <a href="{{route('admin.vds')}}" class="btn btn-primary">{{__('Просмотр')}}</a>
                    <a href="{{route('admin.vds.create')}}" class="btn btn-primary">{{__('Создать')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
