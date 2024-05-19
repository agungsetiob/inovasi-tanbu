<section class="page-section bg-contact mb-0" id="winner">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-secondary">Daftar pemenang inovation award</h4>
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-trophy fa-shake"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <ul class="nav nav-pills mb-0 nav-fill" id="pills-tab" role="tablist">
                    @foreach ($years as $index => $year )
                        <li class="nav-item bg-tab-winner" role="presentation">
                            <button class="nav-link {{$index === 0 ? 'active' : ''}} fw-semibold fs-5" id="tab-{{ $year->tahun }}" data-bs-toggle="pill" data-bs-target="#content-{{ $year->tahun }}"
                                type="button" role="tab" aria-controls="content-{{ $year->tahun }}" aria-selected="{{$index === 0 ? 'true' : 'false'}}"
                                style="border-radius:0;">{{ $year->tahun }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content bg-light" id="pills-tabContent">
                    @foreach ($winners as $index => $w )
                        <div class="tab-pane fade {{$index === 0 ? 'active' : ''}} show p-2" id="content-{{$w->tahun}}" role="tabpanel" aria-labelledby="tab-{{$w->tahun}}">
                            <div class="row">
                                <div class="col-lg-4 col-xl-4 col-md-4 col-sm-8" role="tablist">
                                    <div class="col-12">
                                        <button class="btn btn-secondary active btn-md btn-block text-uppercase mb-2 w-100" id="skpd-winner{{$w->tahun}}" data-bs-toggle="pill" data-bs-target="#winner-skpd-{{$w->tahun}}"
                                            type="button" role="tab" aria-controls="winner-skpd-{{$w->tahun}}" aria-selected="true">Kategori SKPD</button>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-secondary btn-md btn-block text-uppercase mb-2 w-100" id="nonskpd-winner{{$w->tahun}}" data-bs-toggle="pill" data-bs-target="#winner-nonskpd-{{$w->tahun}}"
                                            type="button" role="tab" aria-controls="winner-nonskpd-{{$w->tahun}}" aria-selected="false">Kategori non SKPD</button>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-xl-8 col-md-8 col-sm-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="winner-skpd-{{$w->tahun}}" role="tabpanel" aria-labelledby="skpd-winner{{$w->tahun}}">
                                            <h5 class="fw-bold">Daftar Pemenang TIA Kategori SKPD {{$w->tahun}}</h5>
                                            <ul>
                                                @foreach($winners->where('kategori', 'skpd')->where('tahun', $w->tahun) as $winner)
                                                    <li>{{$winner->pengusul}} - {{$winner->proposal->nama}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="winner-nonskpd-{{$w->tahun}}" role="tabpanel" aria-labelledby="nonskpd-winner{{$w->tahun}}">
                                            <h5 class="fw-bold">Daftar Pemenang TIA Kategori Non SKPD {{$w->tahun}}</h5>
                                            <ul>
                                                @foreach($winners->where('kategori', 'nonskpd')->where('tahun', $w->tahun) as $winner)
                                                    <li>{{$winner->pengusul}} - {{$winner->proposal->nama}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-line"></div>
        </div>
    </div>
</section>