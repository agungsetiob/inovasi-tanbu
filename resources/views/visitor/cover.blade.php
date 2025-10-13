<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
    <meta name="description" content="SERASI Tanah Bumbu" />
    <meta name="author" content="Tanah Bumbu" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Informasi Riset dan Inovasi</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo.png')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="js/js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="{{asset('js/font-awesome.js')}}" crossorigin="anonymous" defer></script>
    <script src="js/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/use-bootstrap-select@2.1.1/dist/use-bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/use-bootstrap-select@2.1.1/dist/use-bootstrap-select.min.js"></script>
    <script type="text/javascript" src="{{asset('vendor/tanbu/tanbu.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/tanbu/loading-states.js')}}"></script>

    <style>
        :root {
            --primary: #3a86ff;
            --primary-light: #8bb4ff;
            --secondary: #ff6b6b;
            --accent: #06d6a0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #b1c5e7ff 0%, #e4edf5 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
            background-position: cover;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 0;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            height: 70px;
            transition: var(--transition);
        }

        .logo:hover {
            transform: translateY(-3px);
        }

        .hero-section {
            text-align: center;
            padding: 3rem 0 5rem;
        }

        .main-logo {
            max-height: 180px;
            margin-bottom: 0.5rem;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
        }

        .title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 2px;
        }

        .subtitle {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .menu-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--accent));
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .menu-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            box-shadow: 0 5px 15px rgba(58, 134, 255, 0.3);
            transition: var(--transition);
        }

        .menu-card:hover .menu-icon {
            transform: scale(1.1);
        }

        .menu-icon img {
            width: 50px;
            height: 50px;
        }

        .menu-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .menu-description {
            color: var(--gray);
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .menu-button {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
        }

        .menu-button:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(58, 134, 255, 0.3);
        }

        .loading-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            z-index: 9999;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .loading-indicator.active {
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                transform: scaleX(0);
            }

            50% {
                transform: scaleX(1);
            }

            100% {
                transform: scaleX(0);
                transform-origin: right;
            }
        }

        @media (max-width: 768px) {
            .header-bar {
                flex-direction: column;
                gap: 1rem;
            }

            .logo-container {
                justify-content: center;
            }

            .title {
                font-size: 2rem;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }
        }

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

    <div class="loading-indicator" id="loadingIndicator"></div>

    <div class="container">
        <div class="header-bar">
            <div class="logo-container">
                <img class="logo" src="assets/img/logo.png" title="garuda" alt="garuda" />
                <img class="logo" src="assets/img/akhlak.png" title="tanbu" alt="tanbu" />
            </div>
        </div>
    </div>

    <section class="hero-section">
        <div class="container">
            @foreach ($settings as $s)
                <div class="logo-container justify-content-center">
                    <img class="main-logo" src="{{url('storage/system/' . $s->logo_cover)}}" title="logo" alt="logo" />
                </div>
            @endforeach

            <h1 class="title">Sistem Informasi Riset dan Inovasi</h1>
            <p class="subtitle">Kabupaten Tanah Bumbu - Menghadirkan solusi inovatif untuk kemajuan daerah</p>

            <div class="menu-grid">
                <div class="menu-card">
                    <div class="menu-icon">
                        <img src="assets/img/rocket.png" alt="Inovasi" />
                    </div>
                    <h3 class="menu-title">INOVASI</h3>
                    <p class="menu-description">Temukan berbagai inovasi terbaru yang dikembangkan di Kabupaten Tanah
                        Bumbu</p>
                    <a hx-get="{{url('inovasi')}}" hx-trigger="click" hx-target="#page-top"
                        hx-swap="outerHTML transition:true" hx-push-url="true" hx-indicator="#loadingIndicator"
                        class="menu-button">Jelajahi</a>
                </div>

                <div class="menu-card">
                    <div class="menu-icon">
                        <img src="assets/img/atom.png" alt="Riset" />
                    </div>
                    <h3 class="menu-title">RISET</h3>
                    <p class="menu-description">Akses hasil penelitian dan riset yang mendukung pembangunan daerah</p>
                    <a hx-get="{{url('risets')}}" hx-trigger="click" hx-target="#page-top"
                        hx-swap="outerHTML transition:true" hx-push-url="true" hx-indicator="#loadingIndicator"
                        class="menu-button">Jelajahi</a>
                </div>

                <div class="menu-card">
                    <div class="menu-icon">
                        <img src="assets/img/microscope.png" alt="Evaluasi" />
                    </div>
                    <h3 class="menu-title">EVALUASI</h3>
                    <p class="menu-description">Tinjau evaluasi program dan kebijakan untuk perbaikan berkelanjutan</p>
                    <a hx-get="{{ url('evaluasi') }}" hx-trigger="click" hx-target="#page-top"
                        hx-swap="outerHTML transition:true" hx-push-url="true" hx-indicator="#loadingIndicator"
                        class="menu-button">Jelajahi</a>
                </div>
            </div>
            <a class="floating-wa-button" href="https://wa.me/{{$telp}}" target="_blank"
                title="Chat with us on WhatsApp">
                <i class="fa-brands text-wa fa-square-whatsapp fa-3x"></i>
            </a>
        </div>
    </section>

    <script>
        // Add loading indicator animation
        document.addEventListener('htmx:beforeRequest', function () {
            document.getElementById('loadingIndicator').classList.add('active');
        });

        document.addEventListener('htmx:afterRequest', function () {
            document.getElementById('loadingIndicator').classList.remove('active');
        });

        // Carousel initialization (if needed)
        $('#slider').owlCarousel({
            items: 1,
            lazyLoad: true,
            nav: false,
            navText: false,
            loop: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1,
                    stagePadding: 0
                },
                600: {
                    items: 1,
                    stagePadding: 0
                },
                900: {
                    items: 1,
                    stagePadding: 100
                },
                1200: {
                    items: 1,
                    stagePadding: 130
                },
                1400: {
                    items: 1,
                    stagePadding: 130
                },
                1600: {
                    items: 1,
                    stagePadding: 350
                },
                1800: {
                    items: 1,
                    stagePadding: 400
                }
            }
        });
    </script>
</body>

</html>