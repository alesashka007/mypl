@extends('layouts.base')
@section('title')
    {{$rate->name}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="{{route('admin.rates')}}">{{__('Тарифы')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Изменение тарифа')}} #{{$rate->id}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Изменение тарифа')}} #{{$rate->id}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.rates.update', $rate->id)}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Название')}}</x-label>
                                <x-input name="name" value="{{$rate->name}}" placeholder="default Public 700 tickrate" autofocus />
                            </div>
                            <select class="form-control" name="status">
                                <option @if($rate->status == 1) selected @endif value="1">{{_('Активная')}}</option>
                                <option @if($rate->status == 0) selected @endif value="0">{{_('Не активная')}}</option>
                            </select>
                            <div class="mb-3">
                                <x-label class="required">{{__('Минимум слотов')}}</x-label>
                                <x-input type="number" value="{{$rate->min_s}}" name="min_s" placeholder="10"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Максимум слотов')}}</x-label>
                                <x-input type="number" value="{{$rate->max_s}}" name="max_s" placeholder="32"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Цена/Слот')}}</x-label>
                                <x-input type="number" value="{{$rate->price}}" name="price" step="0.50" placeholder="8"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Места на диске в мб')}}</x-label>
                                <x-input name="quota" value="{{$rate->quota}}" placeholder="{{__('5000')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">Tickrate</x-label>
                                <x-input name="tick" value="{{$rate->tick}}" placeholder="300/600/1000"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Vds')}}</x-label>
                                <select class="form-control" name="vds_id">
                                    @foreach($vds as $vd)
                                        <option @if($rate->vds_id == $vd->id) selected @endif value="{{$vd->id}}">{{$vd->location->name . ' -- ' .$vd->ip}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Игры')}}</x-label>
                                <select class="form-control" name="game_id">
                                    @foreach($games as $game)
                                        <option @if($rate->game_id == $game->id) selected @endif value="{{$game->id}}">{{$game->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Дополнения')}}</x-label>
                                <select class="form-control" name="addons">
                                    <option @if(!$rate->addons) selected @endif value="0">{{__('Выключено')}}</option>
                                    <option @if($rate->addons) selected @endif value="1">{{__('Включено')}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">FTP {{__('Доступ')}}</x-label>
                                <select class="form-control" name="ftp">
                                    <option @if(!$rate->ftp) selected @endif value="0">{{__('Выключено')}}</option>
                                    <option @if($rate->ftp) selected @endif value="1">{{__('Включено')}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">FastDL</x-label>
                                <select class="form-control" name="fastdl">
                                    <option @if(!$rate->fastdl) selected @endif value="0">{{__('Выключено')}}</option>
                                    <option @if($rate->fastdl) selected @endif value="1">{{__('Включено')}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">HLTV</x-label>
                                <select class="form-control" name="tv">
                                    <option @if(!$rate->tv) selected @endif value="0">{{__('Выключено')}}</option>
                                    <option @if($rate->tv) selected @endif value="1">{{__('Включено')}}</option>
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
