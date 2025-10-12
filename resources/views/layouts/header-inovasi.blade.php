<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="SERASI Tanah Bumbu" />
    <meta name="author" content="Tanah Bumbu" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.title') }}</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="js/js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"
        defer></script>
    <script src="js/js/scripts.js"></script>
    <script type="text/javascript" src="{{asset('vendor/tanbu/tanbu.min.js')}}"></script>
    <script src="{{asset('vendor/tanbu/loading-states.js')}}"></script>
    <style>
        .floating-wa-button {
            position: fixed;
            bottom: 17px;
            right: 17px;
            z-index: 1000;
        }
    </style>
</head>

<body id="page-top" hx-ext="loading-states">
    <noscript>
        @include('errors.noscript')
    </noscript>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-nav text-uppercase fixed-top border-bottom" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">
                <img width="200" src="{{asset('assets/logo.png')}}" alt="logo pemkab">
            </a>
            <a class="navbar-brand" href="#page-top">
                @foreach ($settings as $s)
                    <img width="57" src="{{ url('storage/system', $s->logo_sistem) }}" alt="logo serasi"
                        class="d-none d-md-inline-block">
                @endforeach
            </a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded" hx-get="{{url('/')}}" hx-trigger="click"
                            hx-target="#page-top" hx-swap="outerHTML transition:true" hx-push-url="true"
                            hx-indicator="#loadingIndicator">Home</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3"
                            href="#inovasi-info">Inovasi</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="#winner">TIA</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="btn btn-lg btn-outline-danger"
                            href="https://www.lapor.go.id/" target="_blank"><i class="fa fa-arrow-right fa-flip me-2"
                                style="--fa-flip-x: 1; --fa-flip-y: 0;"></i>Lapor</a></li>
                    @if (Auth::guest())
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded" hx-get="{{url('/login')}}" hx-trigger="click"
                                hx-target="#page-top" hx-swap="outerHTML transition:true" hx-push-url="true"
                                hx-indicator="#loadingIndicator">Login</a>
                        </li>
                    @elseif (auth()->user()->role === 'admin')
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded"
                                href="{{ route('admin.index') }}">{{Auth::user()->username}}</a>
                        </li>
                    @elseif (auth()->user()->role === 'user')
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                                href="{{ route('user.index') }}">{{Auth::user()->username}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @include('visitor.partial.htmx-indicator')
    <a class="floating-wa-button" href="https://wa.me/{{$telp}}" target="_blank" title="Chat with us on WhatsApp">
        <i class="fa-brands text-wa fa-square-whatsapp fa-3x"></i>
    </a>
    @yield('content')
</body>

</html>