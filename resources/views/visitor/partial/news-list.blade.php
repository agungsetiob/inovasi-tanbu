@fragment('news-section')
<section class="page-section bg-contact portfolio" id="news">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-dark">News From Kemendagri</h4>
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-flag"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        @php
            $items = collect($newsData ?? []);
            $first = $items->first();
            $rest = $items->slice(1, 2); // ambil 2 item berikutnya jika ada
            $placeholderImg = asset('assets/img/akhlak.png'); // siapkan gambar placeholder
        @endphp

        @if($items->isEmpty())
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        Tidak ada berita saat ini, sumber Kemendagri mungkin sedang tidak tersedia.
                    </div>
                </div>
            </div>
        @else
            <div class="row mb-3">
                <div class="col-lg-12 col-md-12">
                    <div class="container" hx-history="false">
                        <div class="row g-2">
                            <div class="col-lg-7">
                                <div class="img-container large">
                                    <img
                                        src="{{ data_get($first, 'photo_url', $placeholderImg) }}"
                                        alt="{{ data_get($first, 'title', 'News Image') }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                    <div class="text-container" data-id="{{ data_get($first, 'id') }}">
                                        <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#showNews">
                                            <h4>{{ data_get($first, 'title', 'Untitled') }}</h4>
                                        </a>
                                        <p>
                                            {{ data_get($first, 'created_at')
                                                ? date('F d, Y', strtotime(data_get($first, 'created_at')))
                                                : 'Tanggal tidak tersedia' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="row g-2">
                                    @forelse($rest as $item)
                                        <div class="col-12">
                                            <div class="img-container small">
                                                <img
                                                    src="{{ data_get($item, 'photo_url', $placeholderImg) }}"
                                                    alt="{{ data_get($item, 'title', 'News Image') }}"
                                                    style="width: 100%; height: auto; object-fit: cover;">
                                                <div class="text-container" data-id="{{ data_get($item, 'id') }}">
                                                    <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#showNews">
                                                        <h4>{{ data_get($item, 'title', 'Untitled') }}</h4>
                                                    </a>
                                                    <p>
                                                        {{ data_get($item, 'created_at')
                                                            ? date('F d, Y', strtotime(data_get($item, 'created_at')))
                                                            : 'Tanggal tidak tersedia' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <!-- Jika tidak ada item di sisi kanan, tampilkan placeholder elegan -->
                                        <div class="col-12">
                                            <div class="img-container small" style="min-height: 160px;">
                                                <div class="text-container">
                                                    <h5>Tidak ada berita tambahan</h5>
                                                    <p>Silakan cek kembali nanti.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Loading indicator (opsional)
                    <div id="loadingPub" class="htmx-indicator text-primary d-flex align-items-center justify-content-center mt-3">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                    </div> -->
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    #loadingPub {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    }
    .img-container {
        position: relative; background-color: #f8f9fa;
        display: flex; align-items: flex-end; justify-content: center; color: white;
    }
    .large, .small { height: 100%; }
    .text-container {
        background: rgba(0, 0, 0, 0.5); padding: 10px; position: absolute; bottom: 0; width: 100%;
    }
</style>
@endfragment
