@extends('layouts.base')
@section('title')
    {{$game->name}} | {{config('app.name')}}
@endsection
@section('navbar')
    <a class="nav-link" aria-current="page" href="{{route('order')}}">{{__('Услуги')}}</a>
    <a class="nav-link disabled" aria-current="page" href="#">{{$game->name}}</a>
@endsection
@section('content')
    <ul class="nav nav-tabs nav-pills">
        @foreach($games as $gam)
            <li class="active">
                <a href="{{route('order.game', $gam->id)}}"><img
                        src="https://demo.gamepl.su/img/games2/{{$gam->code}}.png"
                        style="margin-left: 4px; margin-right: 4px; width: 70px;"></a>
            </li>
        @endforeach
    </ul>
    <div class="row mt-5">
        <div class="col-12 col-md-7 offset-md-3">
            <x-card>
                <x-card-body>
                    <h4 class="m-0">
                        {{__('Аренда игрового сервера')}}
                    </h4>
                </x-card-body>
                <x-card-body>
                    <x-form action="{{route('order.buy')}}">
                        @csrf
                        <x-label>Загруженность:</x-label>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="100" id="loaded"></div>
                        </div>
                        <div class="mb-3">
                            <x-label>{{__('Тариф')}}:</x-label>
                            <select class="form-control" name="rate" id="rates"></select>
                        </div>
                        <div class="mb-3">
                            <x-label>{{__('Кол-во слотов')}}:</x-label>
                            <select class="form-control" name="slots" id="slots"></select>
                        </div>
                        <div class="mb-3">
                            <x-label>{{__('Период оплаты')}}:</x-label>
                            <select class="form-control" name="time" id="time">
                                <option value="1">{{__('30 дней')}}</option>
                                <option value="3">{{__('90 дней - 5% скидка')}}</option>
                                <option value="6">{{__('180 дней - 15% скидка')}}</option>
                            </select>
                        </div>

{{--                        <div class="mb-3">--}}
{{--                            <x-label>{{__('Купон')}}:</x-label>--}}

{{--                            <div class="mb-3">--}}
{{--                                <div class="input-group">--}}
{{--                                    <x-input id="cupon" name="cupon" placeholder="{{__('Купон')}}"/>--}}
{{--                                    <span class="input-group-btn">--}}
{{--                                <button class="btn btn-primary cupon-check" type="button"><i class="fa fa-check"></i> {{__('Проверить')}}</button>--}}
{{--                            </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="mb-3">
                             <input type="submit" id="subbuy" class="btn btn-primary" >
                        </div>
                    </x-form>
                    <table class="table table-striped table-bordered mt-5">
                        <tr>
                            <td>{{__('FTP Доступ')}}</td>
                            <td>{{__('Репозиторий')}}</td>
                            <td>{{__('Fast DL')}}</td>
                            <td>{{__('TV')}}</td>
                            <td>{{__('Диск МБ')}}</td>
                            <td>{{__('Tickrate')}}</td>
                            <td>{{__('IP Адрес')}}</td>
                            <td>{{__('Расположение')}}</td>
                        </tr>
                        <tr>
                            <td id="ftp"></td>
                            <td id="addons"></td>
                            <td id="fastdl"></td>
                            <td id="tv"></td>
                            <td id="quota"></td>
                            <td id="tick"></td>
                            <td id="ip"></td>
                            <td id="location"></td>
                        </tr>
                    </table>
                </x-card-body>
            </x-card>
        </div>
    </div>
    <script>
        var rates = [];
        var rate_name = [];
        var rate_min_slot = [];
        var rate_max_slot = [];
        var rate_price = [];
        var addons = [];
        var ftp = [];
        var fastdl = [];
        var tv = [];
        var quota = [];
        var tick = [];
        var ip = [];
        var location_name = [];
        var game = '{{$game->code}}';

        var location_cpu = [];

        @foreach($rates as $rate)
            @if($game->id == $rate->game_id)
            @if($rate->status == 1 & $rate->vds->status == 1 & $rate->vds->location->status == 1)

            rates[{{$rate->id}}] = '{{$rate->game->code}}';
        rate_name[{{$rate->id}}] = '{{$rate->name}}';
        rate_min_slot[{{$rate->id}}] = {{$rate->min_s}};
        rate_max_slot[{{$rate->id}}] = {{$rate->max_s}};
        rate_price[{{$rate->id}}] = {{$rate->price}};
        addons[{{$rate->id}}] = {{$rate->addons}};
        ftp[{{$rate->id}}] = {{$rate->ftp}};
        fastdl[{{$rate->id}}] = {{$rate->fastdl}};
        tv[{{$rate->id}}] = {{$rate->tv}};
        quota[{{$rate->id}}] = {{$rate->quota}};
        tick[{{$rate->id}}] = {{$rate->tick}};
        ip[{{$rate->id}}] = '{{$rate->vds->ip}}';
        location_name[{{$rate->id}}] = '{{$rate->vds->location->name}}';

        {{--location_cpu[{{$rate->id}}] = --}}
        @endif
            @endif
            @endforeach
        var buy_go = [];

        function buy() {
            var ratesgo = $('#rates').val();
            var time = $('#time').val();
            var slots = $('#slots').val();

            $("#ftp").empty();
            if (ftp[ratesgo] == 1) {
                $("#ftp").append('<i class="fa fa-check font-blue"></i>');
            } else {
                $("#ftp").append('<i class="fa fa-remove font-red"></i>');
            }

            $("#fastdl").empty();
            if (fastdl[ratesgo] == 1) {
                $("#fastdl").append('<i class="fa fa-check font-blue"></i>');
            } else {
                $("#fastdl").append('<i class="fa fa-remove font-red"></i>');
            }

            $("#addons").empty();
            if (addons[ratesgo] == 1) {
                $("#addons").append('<i class="fa fa-check font-blue"></i>');
            } else {
                $("#addons").append('<i class="fa fa-remove font-red"></i>');
            }

            $("#quota").empty();
            $("#quota").append(quota[ratesgo]);

            $("#location").empty();
            $("#location").append(location_name[ratesgo]);

            $("#tick").empty();
            if (game == 'cs') {
                $("#tick").append(tick[ratesgo]);
            } else if (game == 'css') {
                $("#tick").append(tick[ratesgo]);
            } else if (game == 'css34') {
                $("#tick").append(tick[ratesgo]);
            } else if (game == 'csgo') {
                $("#tick").append(tick[ratesgo]);
            } else {
                $("#tick").append('<i class="fa fa-remove font-red"></i> {{__('Не доступно')}}');
            }
            $("#tv").empty();
            if (tv[ratesgo] == 1) {
                $("#tv").append('<i class="fa fa-check font-blue"></i>');
            } else {
                $("#tv").append('<i class="fa fa-remove font-red"></i>');
            }
            $("#ip").empty();
            $("#ip").append(ip[ratesgo]);

            cpu = 43;
            $('#loaded').css('width', cpu+'%');
            $('#loaded').removeClass('bg-success');
            $('#loaded').removeClass('bg-info');
            $('#loaded').removeClass('bg-warning');
            $('#loaded').removeClass('bg-danger');
            if(cpu<'30'){$('#loaded').addClass('bg-success');}
            if(cpu<'60'){$('#loaded').addClass('bg-info');}
            if(cpu>'60'){$('#loaded').addClass('bg-warning');}
            if(cpu>'80'){$('#loaded').addClass('bg-danger');}


            if (buy_go['game'] != game) {
                $("#rates").empty();
                for (var key in rates) {
                    var val = rates[key];
                    if (val == game) {
                        $("#rates").append('<option value="' + key + '">' + rate_name[key] + ' </option>');
                    }
                }

                buy_go['game'] = game;
            }

            if (buy_go['ratesgo'] != ratesgo) {
                $("#slots").empty();
                var sl;
                for (var i = rate_min_slot[ratesgo]; i < rate_max_slot[ratesgo] + 1; i++) {
                    sl = sl + '<option value="' + i + '">' + i + ' </option>';
                }

                $("#slots").append(sl);
                buy_go['ratesgo'] = ratesgo;
            }
            price = rate_price[ratesgo];

            var a = 0;
            var b = 0;
            var c = 0;
            // if (cupon['sum']) {
            //     c = cupon['sum'];
            // }
            if (time == "1") {
                b = price;
            }

            if (time == "3") {
                c = c + 5;
                b = price;
            } else if (time == "6") {
                c = c + 15;
                b = price;
            }
            a = price * slots * time - (price * slots * time / 100) * c;

            a = parseInt(a);
            b = parseInt(b);
            c = parseInt(c);
            $("#subbuy").val('{{__('Слот')}}: ' + b + ' $. | {{__('Скидка')}} ' + c + '% | {{__('Итого')}}: ' + a + ' $. {{__('Продолжить')}}');

            setTimeout(function () {
                buy();
            }, 500);
        }

        buy();
    </script>
@endsection
