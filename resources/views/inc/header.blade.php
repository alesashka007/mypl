<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="fa fa-home"></i> {{__('Главная')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav" style="margin-left: 75%!important;">
                @if(!auth()->check())
                    <li><a class="dropdown-item nav-link" href="{{route('login')}}"><i
                                class="fa-solid fa-right-to-bracket"></i> {{_('Вход')}}  </a></li>
                    <li><a class="dropdown-item nav-link" href="{{route('register')}}"><i
                                class="fa-solid fa-user-plus"></i> {{_('Регистрация')}}</a></li>
                @else
                    @if(request()->user()->admin)
{{--                        <li>--}}
{{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"--}}
{{--                               data-toggle="dropdown"--}}
{{--                               aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="fa-solid fa-lock"></i> {{_('Админка')}}--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                                <a class="dropdown-item fa-solid fa-home" style="text-align: center;"--}}
{{--                                   href="{{route('admin.index')}}">{{__('Главная')}}</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <a class="dropdown-item nav-link bt-1" href="{{route('admin.index')}}"><i class="fa-solid fa-lock">&nbsp;</i>{{__('Админка')}} </a>
                    @endif
                    <li>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> {{request()->user()->firstname}}</a>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2"
                             style="text-align: center;max-width: 50px;">
                            <a class="dropdown-item"
                               href="{{route('profile')}}">{{__('Профиль')}} <i class="fa-solid fa-edit"></i>
                                <a class="dropdown-item"
                                   href="#">{{__('Баланс') . ' ' . request()->user()->balance}} <i
                                        class="fa-solid fa-dollar"></i></a>
                                <a class="dropdown-item nav-link bt-1" href="{{route('logout')}}">{{__('Выход')}}
                                    <i class="fa-solid fa-right-to-bracket"></i> </a></a>

                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
