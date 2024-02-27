@extends('layouts.riset-menus')
@section('content')
@fragment('create-riset')
<div class="container-fluid slide-it" id="app">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Formulir Pengajuan Riset</h1>
    </div>
    <div class="row">
        <div class="col-md-12 slide-it">
        <div class="card border-0 shadow rounded mb-4">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger data-dismiss alert-dismissible">
                    <i class="fa fa-solid fa-bell fa-shake"></i>
                    @foreach ($errors->all() as $error)
                    <li>
                    {{ $error }}
                    </li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                    <div id="stepper1" class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#test-l-1">
                                <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                <span class="bs-stepper-circle">1</span>
                                </button>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-2">
                                <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                                <span class="bs-stepper-circle">2</span>
                                </button>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-3">
                                <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                <span class="bs-stepper-circle">3</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form action="{{ route('pengajuan-riset.store') }}" method="POST" enctype="multipart/form-data"  hx-history="false">
                                @csrf
                                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="nama">Judul Kajian:</label>
                                        <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul kajian">
                                        @error('judul')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="latar">Latar Belakang Kajian:</label>
                                        <textarea id="latar" type="text" class="editor form-control @error('latar') is-invalid @enderror" name="latar">{{ old('latar') }}</textarea>
                                        @error('latar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="hukum">Dasar Hukum:</label>
                                        <textarea rows="3" id="hukum" class="editor form-control @error('hukum') is-invalid @enderror" name="hukum">{{ old('hukum') }}</textarea>
                                        @error('hukum')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-primary" id="nextB">Next <i class="fa-solid fa-forward"></i></button>
                                </div>

                            <!-- part two -->
                                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="manfaat">Manfaat yang diperoleh:</label>
                                        <textarea id="manfaat" rows="3" class="editor form-control @error('manfaat') is-invalid @enderror" name="manfaat" placeholder="Masukkan manfaat dari inovasi yang dilakukan">{{ old('manfaat') }}</textarea>
                                        @error('manfaat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="hasil">Hasil inovasi:</label>
                                        <textarea id="hasil" rows="3" class="editor form-control @error('hasil') is-invalid @enderror" name="hasil" placeholder="Masukkan hasil dari inovasi yang dilakukan">{{ old('hasil') }}</textarea>
                                        @error('hasil')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="row g-3">
                                            <div class="col d-none">
                                                <label class="font-weight-bold" for="skpd">Dibuat oleh:</label>
                                                <select name="skpd" id="skpd" class="form-control @error('skpd') is-invalid @enderror" required>
                                                    <option value="{{Auth::user()->skpd->id}}" selected>{{Auth::user()->skpd->nama}}</option>
                                                </select>
                                                @error('skpd')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="nextC">Next <i class="fa-solid fa-forward"></i></button>
                                    <button type="button" class="btn btn-primary prev"><i class="fa-solid fa-backward"></i> Previous</button>
                                    <button type="submit" class="btn btn-md btn-outline-primary float-right"><i class="fa fa-save"></i> Save</button>
                                </div>

                                <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="manfaat">Manfaat yang diperoleh:</label>
                                        <textarea id="manfaat" rows="3" class="editor form-control @error('manfaat') is-invalid @enderror" name="manfaat" placeholder="Masukkan manfaat dari inovasi yang dilakukan">{{ old('manfaat') }}</textarea>
                                        @error('manfaat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="hasil">Hasil inovasi:</label>
                                        <textarea id="hasil" rows="3" class="editor form-control @error('hasil') is-invalid @enderror" name="hasil" placeholder="Masukkan hasil dari inovasi yang dilakukan">{{ old('hasil') }}</textarea>
                                        @error('hasil')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="row g-3">
                                            <div class="col d-none">
                                                <label class="font-weight-bold" for="skpd">Dibuat oleh:</label>
                                                <select name="skpd" id="skpd" class="form-control @error('skpd') is-invalid @enderror" required>
                                                    <option value="{{Auth::user()->skpd->id}}" selected>{{Auth::user()->skpd->nama}}</option>
                                                </select>
                                                @error('skpd')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary prev"><i class="fa-solid fa-backward"></i> Previous</button>
                                    <button type="submit" class="btn btn-md btn-outline-primary float-right"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<x-logout/>
<script type="text/javascript">
  $(document).ready(function () {
    var stepper = new Stepper($('#stepper1')[0],{
      linear: false
    });
    $("#nextB").click(function () {
      stepper.next();
    });
    $("#nextC").click(function () {
      stepper.next();
    });
    $("#prevB").click(function () {
      stepper.previous();
    });
    $(".prev").click(function () {
      stepper.previous();
    });

    $('select').selectize({
      sortField: 'id',
      plugins: ['remove_button']
    });

    CKEDITOR.replace('hukum');

    CKEDITOR.replace('manfaat');

    CKEDITOR.replace('hasil');

    CKEDITOR.replace('latar') 
  });

  document.addEventListener('htmx:afterRequest', function (event) {
    $('select').each(function () {
      var selectize = $(this)[0].selectize;
      if (selectize) {
        selectize.destroy();
      }
    });
  });

</script>
@endfragment
@endsection