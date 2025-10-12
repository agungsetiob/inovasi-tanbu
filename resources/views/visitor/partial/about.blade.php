<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        @foreach ($settings as $s)
            <h4 class="page-section-heading text-center text-uppercase text-white">{{$s->nama_sistem}}</h4>
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-mosque fa-fade"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row">
                <div class="col-lg-12 ms-auto">
                    <p class="lead">{{$s->tentang}}</p>
                </div>
                <div class="col-lg-12 ms-auto text-center mt-2">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <a href="{{ url('assets/manual-book-serasi.pdf') }}" target="_blank"
                            class="btn btn-outline-light btn-download shadow-sm" title="Download panduan penggunaan sistem SERASI">
                            <i class="fas fa-book-open me-2"></i> Manual Book SERASI
                        </a>
                        <a href="{{ url('assets/InnovationEvidenceHandbook.pdf') }}" target="_blank"
                            class="btn btn-outline-light btn-download shadow-sm" title="Download Hanbook Bukti Inovasi">
                            <i class="fas fa-lightbulb me-2"></i> Innovation Evidence Handbook
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>