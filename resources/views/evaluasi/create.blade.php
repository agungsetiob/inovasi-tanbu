@extends('layouts.header')
@section('content')
    @fragment('create-evaluasi')
        <div class="container-fluid slide-it" id="app">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Form Evaluasi</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded mb-4">
                        <div class="card-body">
                            <form action="{{ route('evaluasi.store') }}" method="POST" enctype="multipart/form-data"
                                hx-history="false">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold" for="judul">Judul:</label>
                                    <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror"
                                        name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul evaluasi">
                                    @error('judul')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold" for="deskripsi">Deskripsi:</label>
                                    <textarea id="deskripsi"
                                        class="editor form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                        placeholder="Masukkan deskripsi evaluasi">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row g-2">
                                        <div class="col">
                                            <label class="font-weight-bold" for="uploadBtn">Foto:</label>
                                            <div class="input-group">
                                                <label class="input-group-btn">
                                                    <span class="btny btn-outline-primary">
                                                        Browse<input accept=".jpg,.jpeg,.png,.gif,.svg" id="uploadBtn"
                                                            type="file" style="display: none;" name="foto">
                                                    </span>
                                                </label>
                                                <input id="uploadFile" type="text"
                                                    class="form-control @error('foto') is-invalid @enderror" readonly
                                                    placeholder="Choose a photo">
                                            </div>
                                            @error('foto')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="font-weight-bold" for="link">Link:</label>
                                            <input id="link" type="text" value="{{ old('link') }}"
                                                class="form-control @error('link') is-invalid @enderror" name="link"
                                                placeholder="Link eksternal">
                                            @error('link')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    document.getElementById("uploadBtn").onchange = function () {
                                        document.getElementById("uploadFile").value = this.value;
                                    }
                                </script>
                                <button type="submit" class="btn btn-md btn-outline-primary float-right">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                CKEDITOR.replace('deskripsi', {
                    contentsCss: ["{{ asset('vendor/ckeditor/plugins/wordcount/css/wordcount.css') }}"],
                    extraPlugins: 'wordcount',
                    wordcount: {
                        showParagraphs: true,
                        showWordCount: true
                    }
                });
            });
        </script>
    @endfragment
@endsection