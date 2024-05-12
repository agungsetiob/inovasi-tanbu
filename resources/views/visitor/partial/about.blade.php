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
            <div class="col-lg-12 ms-auto"><p class="lead">{{$s->tentang}}</p></div>
            <div class="col-lg-12 ms-auto text-center bg-pattern-doubs rounded">
                <strong class="lead">
                    <a class="text-secondary" href="{{ url('assets/manual-book-serasi.pdf') }}" target="_blank">Download manual book SERASI</a>
                </strong>
            </div>
        </div>
        @endforeach
    </div>
</section>