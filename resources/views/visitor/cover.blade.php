<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Informasi Riset dan Inovasi</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body id="page-top" class="bg-pattern-doubs">
    <div class="container">
        <div class="row justify-content-between pt-4">
            <img style="width:93px" class="img-fluid" src="img/garuda.png" title="garuda" alt="garuda" />
            <img style="width:93px" class="img-fluid" src="assets/img/logo.png" title="tanbu" alt="tanbu" />
        </div>
    </div>
    <!-- Masthead-->
    <header class="masthead text-white text-center">
        @foreach ($settings as $s)
        <div class="container d-flex align-items-center justify-content-center">
            <img style="height:193px" class="img-fluid mb-5" src="{{url('storage/system/' . $s->logo_cover)}}" title="logo" alt="logo" />
        </div>
        @endforeach
        <div class="container d-flex align-items-center flex-column">
            <h1 class="text-uppercase mb-4">Kabupaten Tanah Bumbu</h1>
            <!-- Icon Divider-->
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="portfolio-item mx-auto text-center">
                        <img class="img-fluid menu-logo fa-bounce bounce-no-animation" src="assets/img/rocket.png" alt="..." />
                        <a href="/inovasi" class="btn btn-lg btn-outline-primary btn-block masthead-subheading text-white fw-semibold mb-0" style="display: flex; justify-content: center; align-items: center;">INOVASI</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="portfolio-item mx-auto">
                        <img class="img-fluid menu-logo fa-flip" src="assets/img/microscope.png" alt="..." />
                        <a href="/litbang" class="btn btn-lg btn-outline-primary btn-block masthead-subheading text-white fw-semibold mb-0" style="display: flex; justify-content: center; align-items: center;">LITBANG</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="portfolio-item mx-auto">
                        <img class="img-fluid menu-logo-atom fa-spin-pulse" src="assets/img/atom.png" alt="..." />
                        <a href="/riset" class="btn btn-lg btn-outline-primary btn-block masthead-subheading text-white fw-semibold mb-0" style="display: flex; justify-content: center; align-items: center;">RISET</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/js/scripts.js"></script>
</body>
</html>