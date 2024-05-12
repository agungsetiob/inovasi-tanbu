@extends ('layouts.header-inovasi')
@section ('content')
<header class="masthead-carousel bg-carousel text-white text-center" hx-history="false">
    <div class="d-flex">
        <style>
            @keyframes fade-in {
                from { opacity: 0; }
            }

            @keyframes fade-out {
                to { opacity: 0; }
            }

            @keyframes slide-from-right {
                from { -webkit-transform: translateX(90px); transform: translateX(90px); }
            }

            @keyframes slide-to-left {
                to { -webkit-transform: translateX(-90px); transform: translateX(-90px); }
            }
               .slide-it {
                 view-transition-name: slide-it;
               }

               ::view-transition-old(slide-it) {
                 animation: 180ms cubic-bezier(0.4, 0, 1, 1) both fade-out,
                 600ms cubic-bezier(0.4, 0, 0.2, 1) both slide-to-left;
               }
               ::view-transition-new(slide-it) {
                 animation: 420ms cubic-bezier(0, 0, 0.2, 1) 90ms both fade-in,
                 600ms cubic-bezier(0.4, 0, 0.2, 1) both slide-from-right;
               }
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

            body {
                opacity: 1;
                transition: opacity 0.1s ease-in-out;
            }

            body.fade-out {
                opacity: 0;
            }

        </style>
        {{--owl carousel--}}
        <div class="owlslider owl-carousel mb-0 owl-loaded owl-drag owl-theme owl-carousel-init" id="slider">
            @foreach ($carousels as $carousel)
                <div class="item">
                    <img src="{{url('storage/carousels/' . $carousel->image)}}" class="d-block img-fluid" alt="slider-{{$carousel->id}}">
                </div>
            @endforeach
        </div>
    </div>
</header>
@include('visitor.partial.data-inovasi')
@include('visitor.partial.winner')
@include('visitor.partial.about')
@include('visitor.send-message-form')
@include('components.footer-visitor')
<script>
    $('#slider').owlCarousel({
        items: 1,
        lazyLoad: true,
        nav: false,
        navText: false,
        loop: true,
        autoplay: true,
        dots: false,
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

    document.body.addEventListener('htmx:afterSwap', function(event) {
        htmx.removeClass(htmx.find('#loading-overlay'), 'loading-overlay');
    });
</script>
@endsection