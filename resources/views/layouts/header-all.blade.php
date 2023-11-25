<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.title') }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo.png')}}" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
</head>
<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-light text-uppercase fixed-top border-bottom" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">
              <img width="200" src="{{asset('assets/logo.png')}}" alt="logo pemkab">
            </a>
            <a class="navbar-brand" href="#page-top">
                @foreach ($settings as $s)
                <img width="60" src="{{url ('storage/system', $s->logo_sistem)}}" alt="logo serasi" class="d-none d-md-inline-block">
                @endforeach
            </a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="/">Home</a></li>
                    @if (request()->is('inovasi/*'))
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Inovasi</a></li>
                    @elseif (request()->is('litbang/*'))
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Litbang</a></li>
                    @elseif (request()->is('riset/*'))
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Riset</a></li>
                    @endif
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">About</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Contact</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="btn btn-lg btn-outline-danger" href="https://www.lapor.go.id/" target="_blank"><i class="fa fa-arrow-right fa-flip me-2" style="--fa-flip-x: 1; --fa-flip-y: 0;"></i>Lapor</a></li>
                    @if (Auth::guest())
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('login') }}">Login</a></li>
                    @elseif (auth()->user()->role === 'admin')
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('admin.index') }}">{{Auth::user()->username}}</a></li>
                    @elseif (auth()->user()->role === 'user')
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('user.index') }}">{{Auth::user()->username}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield ('content')
</body>
</html>