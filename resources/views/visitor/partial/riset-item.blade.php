<div class="list-group">
    @forelse ($risets as $riset)
        <div class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><a href="{{$riset->url}}" target="_blank">{!!$riset->judul!!}</a></h5>
            </div>
            <p class="mb-1">{!! $riset->peneliti !!}</p>
            <small>{{ $riset->updated_at }}</small>
        </div>
    @empty
        <div class="alert alert-danger text-center">
            No data available.
        </div>
    @endforelse
</div>
