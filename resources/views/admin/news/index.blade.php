@extends('layouts.base')
@section('title')
    {{__('Новости')}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('admin.index')}}">{{__('Админка')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{__('Новости')}}</a>
@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">{{__('Статус')}}</th>
            <th scope="col">{{__('Заголовок')}}</th>
            <th scope="col">{{__('Текст')}}</th>
            <th scope="col">{{__('Создатель')}}</th>
            <th scope="col">{{__('Дата создания')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $new)
        @php
        if($new->status == 1){
        $news_status['status'] = 'success';
        $news_status['message'] = __('Активный');
    }else{
        $news_status['status'] = 'danger';
        $news_status['message'] = __('Не активный');
    }
    @endphp
    <tr>
        <th scope="row">{{$new->id}}</th>
        <td><p class="btn btn-{{$news_status['status']}}">{{$news_status['message']}}</p></td>
        <td>{{$new->title}}</td>
        <td>{{$new->text}}</td>
        <td>{{$new->user->firstname.' '.$new->user->lastname}}</td>
        <td>
            {{$new->created_at}}
        </td>
        <td>
            <a class="fa-solid fa-edit" href="{{route('admin.news.edit', $new->id)}}" />
            <a class="fa-solid fa-trash" href="{{route('admin.news.destroy', $new->id)}}" />
        </td>
    </tr>
@endforeach
</tbody>
</table>
<div class="mx-auto" style="width: 200px;">{{ $news->links() }}</div>
@endsection
