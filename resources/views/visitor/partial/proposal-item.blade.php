@foreach ($proposals as $prop)
    <div class="col-md-6 col-lg-4 mb-5">
        <div class="portfolio-item mx-auto show-inovasi" data-bs-toggle="modal" data-bs-target="#showInovasi" data-id="{{ $prop->id }}">
            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-rocket fa-3x"></i></div>
            </div>
            @if ($prop->tahapan->nama === 'ujicoba')
            <img class="img-fluid" src="assets/img/portfolio/cabin.png" alt="..." />
            @elseif ($prop->tahapan->nama === 'inisiatif')
            <img class="img-fluid" src="assets/img/portfolio/cake.png" alt="..." />
            @elseif ($prop->tahapan->nama === 'penerapan')
            <img class="img-fluid" src="assets/img/portfolio/game.png" alt="..." />
            @endif
        </div>
        <div class="portfolio-caption text-center text-white mt-1">
            <h6>{{ $prop->nama }}</h6>
        </div>
    </div>
@endforeach
