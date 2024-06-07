@extends('layouts.header-sholat')
@section('content')
<section class="page-section bg-inovation portfolio" style="padding-top: 9rem;">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">Pilih Tanggal untuk Menampilkan Jadwal
            Sholat</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-hands-praying"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <form id="jadwalForm" class="mb-4" 
            hx-get="{{ route('sholat.jadwal', ['date' => '']) }}"
            hx-trigger="input from:#datepicker"
            hx-target="#jadwal"
            hx-swap="outerHTML transition:true"
            hx-indicator="#loadingIndicator">
            <div class="form-group row justify-content-center">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <input type="date" id="datepicker" name="date" class="form-control">
                </div>
                <!-- <div class="col-6">
                    <button type="submit" class="btn btn-outline-primary w-100">Lihat Jadwal</button>
                </div> -->
            </div>
        </form>
        <div id="jadwal">
            @fragment('jadwal')
            @if(isset($jadwal))
                <div class="row justify-content-center slide-on" id="jadwal">
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Imsak
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['imsak'] }}</h5>
                                <i class="fas fa-moon fa-xl text-warning position-absolute bottom-0 end-0 p-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Subuh
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['subuh'] }}</h5>
                                <i class="fas fa-mosque fa-xl position-absolute bottom-0 end-0 p-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Terbit
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['terbit'] }}</h5>
                                <i class="fas fa-sun fa-xl text-danger position-absolute bottom-0 end-0 p-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Dhuha
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['dhuha'] }}</h5>
                                <i class="fa-brands fa-ussunnah fa-2x position-absolute bottom-0 end-0 p-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Dzuhur
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['dzuhur'] }}</h5>
                                <i class="fas fa-mosque fa-xl position-absolute bottom-0 end-0 p-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Ashar
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['ashar'] }}</h5>
                                <i class="fas fa-mosque fa-xl position-absolute bottom-0 end-0 p-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Maghrib
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['maghrib'] }}</h5>
                                <i class="fas fa-mosque fa-xl position-absolute bottom-0 end-0 p-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-4 col-sm-6 d-flex justify-content-center align-items-center p-2">
                        <div class="card text-center w-100">
                            <div class="card-header">
                                Isya
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal['isya'] }}</h5>
                                <i class="fas fa-mosque fa-xl position-absolute bottom-0 end-0 p-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(isset($error))
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 p-1">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center">{{ $error }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endfragment
        </div>
    </div>
</section>
@include('visitor.partial.footer-visitor')
@endsection

@section('scripts')
<script>
    document.getElementById('datepicker').addEventListener('change', function () {
        var form = document.getElementById('jadwalForm');
        form.setAttribute('hx-get', form.getAttribute('hx-get') + this.value);
    });
</script>
@endsection
