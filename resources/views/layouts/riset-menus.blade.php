<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="htmx-config" content='{"refreshOnHistoryMiss":"true"}' />
    <title>{{ config('app.title') }}</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/stepper.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/selectize.min.css')}}" />
    <link rel="shortcut icon" href="{{url ('assets/img/logo.png')}}" type="image/x-icon" />
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('vendor/tanbu/tanbu.min.js')}}"></script>
    <script src="{{asset('vendor/tanbu/loading-states.js')}}"></script>
    <style>
        .floating-wa-button {
            position: fixed;
            bottom: 65px;
            right: 17px;
            z-index: 1000;
        }
    </style>
</head>
<body id="page-top" class="slide-on" hx-ext="loading-states">
    <div id="wrapper">
        <x-riset-menus />
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" @foreach ($backgrounds as $background) style="background: url('{{url("storage/backgrounds/" .
                $background->background)}}'); background-position: center; background-repeat: no-repeat; background-size:
                cover;" @endforeach>
                <nav class="navbar navbar-expand navbar-light bg-gradient-primary topbar mb-4 shadow">
                    <button title="bars" id="sidebarToggleTop" class="btn btn-link rounded mr-3">
                        <i class="fa fa-bars text-dark"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow" id="userMenuContainer">
                            <a id="userMenu" class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-caret-down text-white mr-1"></i>
                                <span class="mr-2 d-none d-lg-inline text-white small">{{Auth::user()->name}}</span>
                                @if (Auth::user()->avatar)
                                <img class="img-profile rounded-circle" src="{{url('storage/ava/'.Auth::user()->avatar)}}" alt="ava">
                                @else
                                <img class="img-profile rounded-circle" src="{{url('storage/ava/avas.png')}}" alt="ava">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div id="userInformation" class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{url('edit-profile', Auth::user()->id)}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                                    Edit Profile
                                </a>
                                <a class="dropdown-item" href="{{url('change-password')}}">
                                    <i class="fas fa-key fa-sm fa-fw mr-2"></i>
                                    Change password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div data-loading-class="loading-overlay"></div>
                <div id="loadingIndicator" class="htmx-indicator d-flex align-items-center justify-content-center"
                    style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                    <i class="fas fa-circle-notch fa-spin fa-4x text-primary"></i>
                </div>
                <div id="htmx-alert" hidden class="text-center align-items-center justify-content-center text-danger"
                    style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1090;"></div>
                <noscript>
                    @include('errors.noscript')
                </noscript>
                @yield ('content')
            </div>
            <a class="text-success floating-wa-button" href="https://wa.me/082225976594" target="_blank"
                title="Chat with us on WhatsApp">
                <i class="fa-brands fa-square-whatsapp fa-3x"></i>
            </a>
            <x-footer />
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <x-logout />
</body>
</html>
