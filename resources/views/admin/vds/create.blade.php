@extends('layouts.base')
@section('title')
    {{__('Создание VDS')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="{{route('admin.vds')}}">{{__('VDS')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Создание VDS')}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Создание VDS')}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.vds.store')}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('IP')}}</x-label>
                                <x-input name="ip" placeholder="127.0.0.1" autofocus />
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Порт')}}</x-label>
                                <x-input name="port" placeholder="22"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Логин')}}</x-label>
                                <x-input name="login" placeholder="root"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Пароль')}}</x-label>
                                <x-input name="password" placeholder="{{__('root123')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Кол-во Ядер')}}</x-label>
                                <x-input name="cores" placeholder="4"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Локация')}}</x-label>
                                <select class="form-control" name="location">
                                    @foreach($locs as $loc)
                                        <option value="{{$loc->id}}">{{$loc->name}}</option>
                                    @endforeach
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
