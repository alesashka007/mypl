@extends('layouts.base')
@section('title')
    {{__('Создание Тарифа')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="{{route('admin.rates')}}">{{__('Тарифы')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Создание тарифа')}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Создание Тарифа')}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.rates.store')}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Название')}}</x-label>
                                <x-input name="name" placeholder="default Public 700 tickrate" autofocus />
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Минимум слотов')}}</x-label>
                                <x-input type="number" name="min_s" placeholder="10"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Максимум слотов')}}</x-label>
                                <x-input type="number" name="max_s" placeholder="32"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Цена/Слот')}}</x-label>
                                <x-input type="number" name="price" step="0.50" placeholder="8"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Места на диске в мб')}}</x-label>
                                <x-input name="quota" placeholder="{{__('5000')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">Tickrate</x-label>
                                <x-input name="tick" placeholder="300/600/1000"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Vds')}}</x-label>
                                <select class="form-control" name="vds_id">
                                    @foreach($vds as $vd)
                                        <option value="{{$vd->id}}">{{$vd->location->name . ' -- ' .$vd->ip}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Игры')}}</x-label>
                                <select class="form-control" name="game_id">
                                    @foreach($games as $game)
                                        <option value="{{$game->id}}">{{$game->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Дополнения')}}</x-label>
                                <select class="form-control" name="addons">
                                    <option value="0">{{__('Выключено')}}</option>
                                    <option value="1">{{__('Включено')}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">FTP {{__('Доступ')}}</x-label>
                                <select class="form-control" name="ftp">
                                    <option value="0">{{__('Выключено')}}</option>
                                    <option value="1">{{__('Включено')}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">FastDL</x-label>
                                <select class="form-control" name="fastdl">
                                    <option value="0">{{__('Выключено')}}</option>
                                    <option value="1">{{__('Включено')}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">HLTV</x-label>
                                <select class="form-control" name="tv">
                                    <option value="0">{{__('Выключено')}}</option>
                                    <option value="1">{{__('Включено')}}</option>
                                </select>
                            </div>
                            <x-button type="submit" >{{__('Создать')}}</x-button>
                        </x-form>
                    </x-card-body>
                </x-card>
            </div>
        </div>
    </section>
@endsection
