@extends('layouts.header-sholat')
@section('content')
@include('visitor.partial.carousels')
@include('visitor.partial.news-list')
@include('visitor.partial.about')
@include('visitor.partial.send-message-form')
@include('visitor.partial.footer-visitor')
<script>
    $('#slider').owlCarousel({
        items: 1,
        lazyLoad: true,
        nav: false,
        navText: false,
        loop: true,
        autoplay: true,
        // dots: false,
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
    });
</script>
@include('visitor.partial.news-detail')
@endsection
