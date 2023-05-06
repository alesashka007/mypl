<!DOCTYPE html>
<head>
    <title>@yield('title')</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha3/css/bootstrap.min.css" integrity="sha512-iGjGmwIm1UHNaSuwiNFfB3+HpzT/YLJMiYPKzlQEVpT6FWi5rfpbyrBuTPseScOCWBkRtsrRIbrTzJpQ02IaLA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<style>
    .required:after {
        content: '*';
        color: red;
        margin-left: 1px
    }

    body {
        background: url("http://m.gettywallpapers.com/wp-content/uploads/2022/05/Wallpaper-CS-Go.jpg");
        background-attachment:fixed;
    }
</style>
<body>
<div class="d-flex flex-column justify-content-between min-vh-5 ">
    @include('inc.header')
    <div class="col-12 col-md-8 offset-md-2 mt-5 card container">
        @include('layouts.alert')
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                {{--                <a class="navbar-brand" href="#">HOSTSERV</a>--}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link
                        @if (Route::currentRouteName() == 'home')
                        disabled
                        @else
                        active
                        @endif
                        " aria-current="page" href="{{route('home')}}">{{__('Главная')}}</a>
                        @yield('navbar')
                    </div>
                </div>
            </div>
        </nav>
        <main class="flex-grow-1 mb-5 mt-5">
            @yield('content')
        </main>

        @include('inc.footer')
    </div>
</div>

</body>
</html>
