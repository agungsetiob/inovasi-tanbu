@extends ('layouts.header-riset')
@section ('content')
@include('visitor.partial.carousels')
<section class="page-section bg-inovation portfolio" id="riset-list">
    <div class="container">
        <div class="row justify-content-center">
            @include('visitor.partial.riset-item')
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-secondary btn-outline-light" href="#">
                <i class="fas fa-atom me-2 fa-spin"></i>
                Lihat semua
            </a>
        </div>
    </div>
</section>
@include('visitor.partial.about')
@include('visitor.partial.send-message-form')
@include('visitor.partial.footer-visitor')
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/js/bootstrap.bundle.min.js"></script> 
<script src="js/owl.carousel.min.js"></script>
<script src="js/js/scripts.js"></script>
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>--}}
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