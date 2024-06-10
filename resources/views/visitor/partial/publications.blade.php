@fragment('publication-section')
    <section class="page-section bg-inovation portfolio" id="publications">
        <div class="container">
            <h4 class="page-section-heading text-center text-uppercase text-white">Publikasi Daerah se Indonesia</h4>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-newspaper"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-9 col-md-12 p-1">
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
                                <tr>
                                    <td colspan="3" class="text-center">Select year and kabupaten to show data.</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <div id="loadingPub"
                                    class="htmx-indicator text-primary d-flex align-items-center justify-content-center mt-3">
                                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                                </div> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 p-1">
                    <div class="p-3 bg-white rounded shadow">
                        <form method="GET" action="{{ route('publications.table') }}"
                            hx-get="{{ route('publications.table') }}" hx-target="#tabel-pub" hx-trigger="submit from:form"
                            hx-swap="outerHTML transition:true" hx-indicator="#loadingPub">
                            <!-- <div class="mb-3">
                                    <label for="searchInput" class="form-label">Keywords:</label>
                                        <input type="text" id="searchInput" name="keywords" class="form-control" placeholder="Keywords" value="{{ request('keywords') }}">
                                </div> -->
                            <div class="mb-3">
                                <label for="yearFilter" class="form-label">Tahun:</label>
                                <select id="yearFilter" name="year" class="form-select" data-searchable="true">
                                    <option value="">-- Tahun --</option>
                                    @for ($year = now()->year; $year >= now()->year - 3; $year--)
                                        <option value="{{ $year }}" @if($year == request('year')) selected @endif>{{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kabFilter" class="form-label">Kabupaten:</label>
                                <select id="kabFilter" name="domain_id" class="form-select" data-searchable="true"
                                    data-clearable="true" is-valid>
                                    <option value="">-- Kabupaten --</option>
                                    @foreach ($kabupatenData['data'][1] as $kabupaten)
                                        <option value="{{ $kabupaten['domain_id'] }}"
                                            @if($kabupaten['domain_id'] == request('domain_id')) selected @endif>
                                            {{ $kabupaten['domain_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-100" data-loading-class="d-none">
                                    Filter</button>
                                <button type="submit" class="btn btn-primary w-100 d-none" disabled
                                    data-loading-class-remove="d-none"><i class="fa fa-spinner fa-spin"></i> Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const kabFilter = new UseBootstrapSelect(document.getElementById('kabFilter'));
        const yearFilter = new UseBootstrapSelect(document.getElementById('yearFilter'));
    </script>
    <style>
        #tabel-pub {
            position: relative;
        }

        #loadingPub {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endfragment