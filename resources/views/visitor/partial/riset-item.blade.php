<div class="list-group">
    @forelse ($risets as $riset)
        <a href="{{$riset->url}}" target="_blank" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-primary">{!!$riset->judul!!}</h5>
            </div>
            <p class="mb-1">{!! $riset->peneliti !!}</p>
            <p class="mb-1 text-end">Tahun Kajian: {{ $riset->tahun }}</p>
            <small>{{ $riset->updated_at }}</small>
        </a>
    @empty
        <div class="alert alert-danger text-center">
            No data available.
        </div>
    @endforelse
</div>
