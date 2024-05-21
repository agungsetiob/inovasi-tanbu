{{-- @if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.previous') !!}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        {!! __('pagination.previous') !!}
                    </a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">{!! __('pagination.next') !!}</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{!! __('pagination.next') !!}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif --}}

@if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    <div class="mt-4 row" id="load-more-container">
        @if ($paginator->onFirstPage())
            <div class="text-start col-6">
                <button class="btn btn-lg btn-outline-light invisible">Previous</button>
            </div>
        @else
            <div class="text-start col-6">
                <button class="btn btn-lg btn-outline-light justify-content-start" 
                        hx-get="{{ $paginator->previousPageUrl() }}" 
                        hx-target="#page-top" 
                        hx-swap="outerHTML transition:true"
                        hx-indicator="#loadingIndicator">Previous</button>
            </div>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <div class="text-end col-6">
                <button class="btn btn-lg btn-outline-light justify-content-end" 
                        hx-get="{{ $paginator->nextPageUrl() }}" 
                        hx-target="#page-top" 
                        hx-swap="outerHTML transition:true"
                        hx-indicator="#loadingIndicator">Next</button>
            </div>
        @else
            <div class="text-start col-6">
                <button class="btn btn-lg btn-outline-light invisible">Next</button>
            </div>
        @endif
    </div>
@endif
