<section class="page-section bg-inovation portfolio" id="riset-list">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">Riset Daerah Tanah Bumbu</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-atom fa-spin"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row justify-content-center" data-loading-class="invisible">
            <div class="list-group" id="riset-item">
                @forelse ($risets as $riset)
                    <a href="{{$riset->url}}" target="_blank" class="list-group-item list-group-item-action bg-contact">
                        <h5 class="text-primary">{!!$riset->judul!!}</h5>
                        <p>{!! $riset->peneliti !!}</p>
                        <p>{{ $riset->universitas }}</p>
                        <p class="text-end">Tahun Kajian: {{ $riset->tahun }}</p>
                        <!-- <small>{{ $riset->updated_at }}</small> -->
                    </a>
                @empty
                    <div class="alert alert-danger text-center">
                        No data available.
                    </div>
                @endforelse
            </div>
        </div>
        {{--@if($risets->hasMorePages())
        <div class="text-center mt-4" id="load-more-container">
            <button class="btn btn-xl btn-outline-light" 
                    hx-get="{{ $risets->nextPageUrl() }}" 
                    hx-target="#riset-list" 
                    hx-swap="outerHTML">
                <i class="fas fa-spinner fa-spin"></i> Load More <i class="fas fa-spinner fa-spin invisible"></i>
            </button>
        </div>
        @endif--}}
        {{ $risets->links('pagination::simple-bootstrap-5') }}
    </div>
</section>
