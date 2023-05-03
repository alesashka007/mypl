@extends('layouts.base')
@section('title')
    {{__('Новости')}} | {{config('app.name')}}
@endsection
@section('content')
    <div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.myarena.ru/images/news/rotator/vdskvm.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.myarena.ru/images/news/rotator/dedic-antiddos.jpg" class="d-block w-100"
                     alt="...">
            </div>
            {{--            <div class="carousel-item">--}}
            {{--                <img src="..." class="d-block w-100" alt="...">--}}
            {{--            </div>--}}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @foreach($news as $new)
{{--        @dd($new)--}}
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$new->id}}"
                                aria-expanded="true" aria-controls="collapse{{$new->id}}">
                            {{$new->title}}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{$new->id}}" class="collapse {{--show--}}" aria-labelledby="heading{{$new->id}}"
                     data-parent="#accordion">
                    <div class="card-body">
                        {{$new->text}}
                        <div class="mt-2 border border-4"
                             style="max-width: max-content;margin-left: 85%;">
                            {{ date("d.m.Y", strtotime($new->created_at))}}<br/>
                            {{$new->user->firstname.' '.$new->user->lastname}}
                        </div>
                    </div>
                </div>
            </div>
        </div><br/>
    @endforeach
    <div class="mx-auto" style="width: 200px;">{{ $news->links() }}</div>
@endsection
