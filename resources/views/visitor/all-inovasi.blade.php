@extends ('layouts.header-all')
@section ('content')
<section class="page-section bg-inovation portfolio masthead-carousel mt-3" id="portfolio">
    <div class="container">
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <!-- Portfolio Item 1-->
            @forelse ($proposals as $prop)
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto show-inovasi" data-bs-toggle="modal" data-bs-target="#showInovasi" data-id="{{$prop->id}}">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
                    </div>
                    @if ($prop->tahapan->nama === 'ujicoba')
                    <img class="img-fluid" src="{{asset('assets/img/portfolio/cabin.png')}}" alt="..." />
                    @elseif ($prop->tahapan->nama === 'inisiatif')
                    <img class="img-fluid" src="{{asset('assets/img/portfolio/cake.png')}}" alt="..." />
                    @elseif ($prop->tahapan->nama === 'penerapan')
                    <img class="img-fluid" src="{{asset('assets/img/portfolio/game.png')}}" alt="..." />
                    @endif
                </div>
                <div class="portfolio-caption text-center text-white mt-1">
                    <h6>{{ $prop->nama }}</h6>
                </div>
            </div>
            @empty
            <div class="alert alert-dark text-center">
                No data available.
            </div>
            @endforelse
        </div>
        <div class="text-center mt-3">
            {{ $proposals->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@include ('components.footer-visitor')
<!-- Bootstrap core JS-->
<script src="{{asset('js/js/bootstrap.bundle.min.js')}}"></script> 
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<script src="{{asset('js/js/scripts.js')}}"></script>
@include ('visitor.modal-detail-inovasi')
@endsection