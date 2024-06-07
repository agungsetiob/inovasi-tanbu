@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.previous') !!}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" hx-get="{{ $paginator->previousPageUrl() }}" 
                        hx-target="#tabel-pub" 
                        hx-swap="outerHTML transition:true"
                        hx-indicator="#loadingPub" rel="prev">
                        {!! __('pagination.previous') !!}
                    </a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" hx-get="{{ $paginator->nextPageUrl() }}" 
                        hx-target="#tabel-pub" 
                        hx-swap="outerHTML transition:true"
                        hx-indicator="#loadingPub" rel="next">{!! __('pagination.next') !!}</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.next') !!}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

{{--@if ($paginator->hasPages())
    <div class="mt-4 row justify-content-between" id="load-more-container">
        @if ($paginator->onFirstPage())
            <div class="text-start col-6">
                <button class="btn btn-lg btn-outline-primary invisible">Previous</button>
            </div>
        @else
            <div class="text-start col-6">
                <button class="btn btn-lg btn-outline-primary" 
                        hx-get="{{ $paginator->previousPageUrl() }}" 
                        hx-target="#tabel-pub" 
                        hx-swap="outerHTML transition:true"
                        hx-indicator="#loadingPub">Previous</button>
            </div>
        @endif

        @if ($paginator->hasMorePages())
            <div class="text-end col-6">
                <button class="btn btn-lg btn-outline-primary" 
                        hx-get="{{ $paginator->nextPageUrl() }}" 
                        hx-target="#tabel-pub" 
                        hx-swap="outerHTML transition:true"
                        hx-indicator="#loadingPub">Next</button>
            </div>
        @else
            <div class="text-start col-6">
                <button class="btn btn-lg btn-outline-primary invisible">Next</button>
            </div>
        @endif
    </div>
@endif--}}
