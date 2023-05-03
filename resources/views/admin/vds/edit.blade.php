@extends('layouts.base')
@section('title')
    {{__('Создание VDS')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="{{route('admin.vds')}}">{{__('VDS')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Изменение VDS')}} # {{$vds->id}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Изменение VDS')}} #{{$vds->id}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.vds.edit', $vds->id)}}">
                            @csrf
                            <select class="form-control" name="status">
                                <option @if($vds->status == 1) selected @endif value="1">{{_('Активная')}}</option>
                                <option @if($vds->status == 0) selected @endif value="0">{{_('Не активная')}}</option>
                            </select>
                            <div class="mb-3">
                                <x-label class="required">{{__('IP')}}</x-label>
                                <x-input name="ip" value="{{$vds->ip}}" placeholder="127.0.0.1" autofocus />
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Порт')}}</x-label>
                                <x-input name="port" value="{{$vds->port}}" placeholder="22"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Логин')}}</x-label>
                                <x-input name="login" value="{{$vds->login}}" placeholder="root"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Пароль')}}</x-label>
                                <x-input name="password" value="{{$vds->password}}" placeholder="{{__('root123')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Кол-во Ядер')}}</x-label>
                                <x-input name="cores" value="{{$vds->cores}}" placeholder="4"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Локация')}}</x-label>
                                <select class="form-control" name="location">
                                    @foreach($locs as $loc)
                                        @if($loc->id == $vds->location_id)
                                            <option selected value="{{$loc->id}}">{{$loc->name}}</option>
                                        @else
                                            <option value="{{$loc->id}}">{{$loc->name}}</option>
                                        @endif
                                    @endforeach
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
