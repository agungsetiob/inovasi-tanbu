@forelse ($proposals as $prop)
    <div class="col-md-6 col-lg-4 mb-2">
        <div class="portfolio-item mx-auto show-inovasi " data-bs-toggle="modal" data-bs-target="#showInovasi" data-id="{{ $prop->id }}">
            @if ($prop->category->name === 'Digital')
            <img class="img-fluid rotate-full" src="assets/img/digital.png" alt="..." />
            @elseif ($prop->category->name === 'Non Digital')
            <img class="img-fluid rotate-full" src="assets/img/nondigital.png" alt="..." />
            @endif
            <div class="portfolio-caption text-center text-white mt-1">
                <h6>{{ $prop->nama }}</h6>
            </div>
        </div>
    </div>
@empty
<div class="alert alert-danger text-center">
    No data available.
</div>
@endforelse
