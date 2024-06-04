@extends('layouts.header-evaluasi')
@section('content')
<section class="page-section bg-inovation portfolio" style="padding-top: 9rem;">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">{{ $evaluasi->judul }}</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-file-signature"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-12 col-md-12 p-1">
                <div class="card">
                    <img class="card-img-top img-fluid mx-auto d-block p-2 text-center"
                        src="{{ $evaluasi->foto ? asset($evaluasi->foto) : asset('img/image.svg') }}"
                        alt="{{$evaluasi->judul}}" style="max-width: 600px;">
                    <div class="card-body">
                        <p class="card-text">{!! $evaluasi->deskripsi !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('visitor.partial.send-message-form')
@include('visitor.partial.footer-visitor')
@endsection
