{{--@dd($news)--}}
@extends('layouts.base')
@section('title')
    {{$news->title}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link" aria-current="page" href="{{route('admin.news')}}">{{__('Новости')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Изменение новости')}} # {{$news->id}}</a>
@endsection
@section('content')
    <x-errors/>
    <section>
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <x-card>
                    <x-card-body>
                        <h4 class="m-0">
                            {{__('Изменение новости')}} #{{$news->id}}
                        </h4>
                    </x-card-body>
                    <x-card-body>
                        <x-form action="{{route('admin.news.update', $news->id)}}">
                            @csrf
                            <div class="mb-3">
                                <x-label class="required">{{__('Заголовок')}}</x-label>
                                <x-input name="title" value="{{$news->title}}" placeholder="{{__('Заголовок')}}"/>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Описание')}}</x-label>
                                <textarea class="form-control" name="text" placeholder="{{__('Описание')}}">{{$news->text}}</textarea>
                            </div>
                            <div class="mb-3">
                                <x-label class="required">{{__('Статус')}}</x-label>
                                <select class="form-control" name="status">
                                    <option @if($news->status == 1) selected @endif value="1">{{_('Активная')}}</option>
                                    <option @if($news->status == 0) selected @endif value="0">{{_('Не активная')}}</option>
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
