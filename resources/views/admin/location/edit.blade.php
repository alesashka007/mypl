{{--@dd($news)--}}
@extends('layouts.base')
@section('title')
    {{$loc->name}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="{{route('admin.location')}}">{{__('Локации')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Изменение локации')}} # {{$loc->id}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Изменение локации')}} #{{$loc->id}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.location.update', $loc->id)}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Название')}}</x-label>
                                <x-input name="name" value="{{$loc->name}}" placeholder="{{__('Название')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Статус')}}</x-label>
                                <select class="form-control" name="status">
                                    <option @if($loc->status == 1) selected @endif value="1">{{_('Активная')}}</option>
                                    <option @if($loc->status == 0) selected @endif value="0">{{_('Не активная')}}</option>
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
