<div class="table-responsive bg-white p-3 rounded shadow" id="tabel-pub" hx-history="false">
    <table class="table table-borderless table-hover table-striped" width="100%" cellspacing="0">
        <thead class="bg-primary">
            <tr>
                <th width="65%">Judul</th>
                <th class="text-center" width="10%">Tahun</th>
                <th class="text-center" width="25%"></th>
            </tr>
        </thead>
        <tbody data-loading-class="invisible">
            @forelse ($paginator as $publication)
                <tr>
                    <td>{{ $publication['title'] }}</td>
                    <td class="text-center">
                        {{ $publication['rl_date'] ? date('Y', strtotime($publication['rl_date'])) : '' }}</td>
                    <td class="text-center"><a class="btn btn-sm btn-primary text-center" href="{{ $publication['pdf'] }}"
                            target="_blank">Lihat <i class="fas fa-graduation-cap"></i></a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No publications available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Pagination Links -->
    <div class="d-flex justify-content-end">
        {{ $paginator->links('pagination::simple-bootstrap-5') }}
    </div>
    <div id="loadingPub" class="htmx-indicato text-primary d-flex align-items-center justify-content-center">
        <i class="fas fa-spinner fa-spin fa-2x"></i>
        <!-- <img src="{{ asset('img/loader.gif') }}" alt="loading..."> -->
    </div>
</div>