@extends ('layouts.header-inovasi')
@section ('content')
<header class="masthead-carousel bg-carousel text-white text-center">
    <div class="d-flex">
        <style>
            .thebox {
                display: inline-block;
                width: 150px;
            }

            .slotholder {
                background-color: white;
            }

            #slider .item {
                opacity: 0.4;
                transition: .4s ease all;
                margin: 0 20px;
                transform: scale(.9);
                padding: 1px 0;
            }

            #slider .item img {
                box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.30);
                border-radius: 20px;
                width: 100%;
                height: 100%;
                max-height: 410px;
                max-height: 550px;
            }

            #slider .active .item {
                opacity: 1;
                transform: scale(1);
            }

            #slider .owl-item {
                -webkit-backface-visibility: hidden;
                -webkit-transform: translateZ(0) scale(1.0, 1.0);
            }

            #slider .owl-dots {
                padding-bottom: 3px;
                }

                #slider .owl-nav {
                    z-index: 2;
                }

                #slider .owl-carousel .owl-wrapper {
                    display: flex !important;
                    flex-direction: column
                }

                #slider .owl-carousel .owl-item {
                    width: 100%;
                }

                #slider .owl-carousel .owl-item img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    max-width: initial;
                }

                @media(max-width:1000px) {
                    #slider .item {
                        margin: 0;
                        /* transform: scale(.9) */
                    }
                }

                @media screen and (max-width: 900px) {
                    #slider .owl-carousel .owl-item img {
                        border-radius: 0px;
                        object-fit: cover;
                    }


                    #slider .item {
                        margin: 0px;
                        padding: 0px;
                    }

                    #slider .owl-dots {
                        padding-bottom: 0px !important;
                        padding-top: 0px;
                    }

                    .thebox {
                        display: inline-block;
                        width: 30%;
                    }
                }
            </style>
        <!-- Masthead Avatar Image-->
            <div class="owl-carousel owl-theme" id="slider">
                @foreach ($carousels as $carousel)
                <div class="item"> <img src="{{url('storage/carousels/'. $carousel->image)}}" class="d-block img-fluid rounded"> </div>
                @endforeach
            </div>
    </div>
</header>
<!-- Portfolio Section-->
<section class="page-section bg-inovation portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->

        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <!-- Portfolio Item 1-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100 rotate-full">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/portfolio/cabin.png" alt="..." />
                </div>
            </div>
            <!-- Portfolio Item 2-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100 rotate-full">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/portfolio/cake.png" alt="..." />
                </div>
            </div>
            <!-- Portfolio Item 3-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal3">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100 rotate-full">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/portfolio/circus.png" alt="..." />
                </div>
            </div>
            <!-- Portfolio Item 4-->
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal4">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100 rotate-full">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/portfolio/game.png" alt="..." />
                </div>
            </div>
            <!-- Portfolio Item 5-->
            <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal5">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100 rotate-full">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/portfolio/safe.png" alt="..." />
                </div>
            </div>
            <!-- Portfolio Item 6-->
            <div class="col-md-6 col-lg-4">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal6">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100 rotate-full">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="assets/img/portfolio/submarine.png" alt="..." />
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-secondary btn-outline-light" href="#">
                <i class="fas fa-atom me-2 fa-spin"></i>
                Lihat semua
            </a>
        </div>
    </div>
</section>
<!-- About Section-->
<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        @foreach ($settings as $s)        
        <h2 class="page-section-heading text-center text-uppercase text-white">{{$s->nama_sistem}}</h2>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-mosque fa-fade"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row">
            <div class="col-lg-12 ms-auto"><p class="lead">{{$s->tentang}}</p></div>
        </div>
        @endforeach
    </div>
</section>
<!-- Contact Section-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@include ('visitor.send-message-form')
@include ('components.footer-visitor')
<!-- Portfolio Modals-->
<!-- Portfolio Modal 1-->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Rumah Belajar</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image-->
                            <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cabin.png" alt="..." />
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
                            <button class="btn btn-primary" data-bs-dismiss="modal">
                                <i class="fas fa-xmark fa-fw"></i>
                                Close Window
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="js/js/bootstrap.bundle.min.js"></script> 
<script src="js/owl.carousel.min.js"></script>
<script src="js/js/scripts.js"></script>
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<script>
    $('#slider').owlCarousel({
        // stagePadding: 200,
        // stagePadding: 50,
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
                // stagePadding: 250
                stagePadding: 130
            },
            1400: {
                items: 1,
                // stagePadding: 300
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
    })
</script>
@endsection