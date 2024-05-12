<section class="page-section bg-inovation portfolio" id="inovasi-info">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">Data Inovasi Daerah</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-rocket fa-bounce"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row justify-content-center" id="content-container">
            {{--@include('visitor.partial.proposal-item', ['proposals' => $proposals])--}}
            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12 d-flex justify-content-center align-items-center pb-2">
                <button class="btn btn-outline-light btn-lg btn-block text-uppercase fw-semibold fs-5 w-100 position-relative">Total Inovasi <br> 
                    <span class="fs-1 fw-bold">{{$totalProposals}}</span> 
                    <i class="fas fa-layer-group fa-xl bottom-0 end-0 p-1 position-absolute"></i>
                </button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12 d-flex justify-content-center align-items-center p-2">
                <button class="btn btn-outline-light btn-lg btn-block text-uppercase fw-semibold fs-5 w-100 position-relative">Inovasi inisiatif<br> 
                    <span class="fs-1 fw-bold">{{$inisiatif}}</span> 
                    <i class="fas fa-layer-group fa-xl position-absolute bottom-0 end-0 p-1"></i>
                </button>
            </div>
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12 d-flex justify-content-center align-items-center p-2">
                <button class="btn btn-outline-light btn-lg btn-block text-uppercase fw-semibold fs-5 w-100 position-relative">Inovasi Ujicoba<br> 
                    <span class="fs-1 fw-bold">{{$ujicoba}}</span> 
                    <i class="fas fa-layer-group fa-xl position-absolute bottom-0 end-0 p-1"></i>
                </button>
            </div>
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12 d-flex justify-content-center align-items-center p-2">
                <button class="btn btn-outline-light btn-lg btn-block text-uppercase fw-semibold fs-5 w-100 position-relative">Inovasi Ujicoba<br> 
                    <span class="fs-1 fw-bold">{{$implementasi}}</span> 
                    <i class="fas fa-layer-group fa-xl position-absolute bottom-0 end-0 p-1"></i>
                </button>
            </div>
        </div>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row justify-content-center" id="content-container">
            <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12 d-flex justify-content-center align-items-center pb-2">
                <button class="btn btn-outline-light btn-lg btn-block text-uppercase fw-semibold fs-5 w-100 position-relative">Total Inovasi {{ now()->year }} <br> 
                    <span class="fs-1 fw-bold">{{$currentYearProposals}}</span> 
                    <i class="fas fa-layer-group fa-xl bottom-0 end-0 p-1 position-absolute"></i>
                </button>
            </div>
        </div>
        {{--<div class="text-center mt-2" id="show-prop">
            <button id="buttonShow" class="btn btn-xl btn-secondary btn-outline-light" 
            hx-get="{{ url('inovasi/all') }}" 
            hx-trigger="click" 
            hx-target="#content-container" 
            hx-swap="innerHtml transition:true"
            hx-indicator="#loadingIndicator"><i class="fa fa-rocket me-2"></i>
            Lihat semua
            </button>
        </div>--}}
    </div>
</section>