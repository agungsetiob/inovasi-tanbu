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
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-4">
                                <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                <span class="bs-stepper-circle">4</span>
                                </button>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#test-l-5">
                                <button type="button" class="step-trigger" role="tab" id="stepper1trigger5" aria-controls="test-l-5">
                                <span class="bs-stepper-circle">5</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form action="{{ route('riset.store') }}" method="POST" enctype="multipart/form-data"  hx-history="false">
                                @csrf
                                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="judul">Judul Kajian:</label>
                                        <textarea id="judul" type="text" class="form-control @error('judul') is-invalid @enderror" name="judul">{{ old('judul') }}</textarea>
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
                                    <button type="button" class="btn btn-primary next">Next <i class="fa-solid fa-forward"></i></button>
                                </div>

                            {{-- part two --}}
                                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="maksud">Maksud dan Tujuan:</label>
                                        <textarea id="maksud" class="editor form-control @error('maksud') is-invalid @enderror" name="maksud">{{ old('maksud') }}</textarea>
                                        @error('maksud')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="ruang_lingkup">Ruang Lingkup Kajian:</label>
                                        <textarea id="ruang_lingkup" class="editor form-control @error('ruang_lingkup') is-invalid @enderror" name="ruang_lingkup">{{ old('ruang_lingkup') }}</textarea>
                                        @error('ruang_lingkup')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="target">Target dan Sasaran:</label>
                                        <textarea id="target" class="editor form-control @error('target') is-invalid @enderror" name="target">{{ old('target') }}</textarea>
                                        @error('target')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-primary prev"><i class="fa-solid fa-backward"></i> Previous</button>
                                    <button type="button" class="btn btn-primary next">Next <i class="fa-solid fa-forward"></i></button>
                                </div>
                                {{-- part 3 --}}
                                <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="output">Output Kajian:</label>
                                        <textarea id="output" class="editor form-control @error('output') is-invalid @enderror" name="output">{{ old('output') }}</textarea>
                                        @error('output')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="manfaat">Manfaat Kajian:</label>
                                        <textarea id="manfaat" class="editor form-control @error('manfaat') is-invalid @enderror" name="manfaat">{{ old('manfaat') }}</textarea>
                                        @error('manfaat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="dana">Sumber Pendanaan:</label>
                                        <textarea id="dana" class="editor form-control @error('dana') is-invalid @enderror" name="dana">{{ old('dana') }}</textarea>
                                        @error('dana')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-primary prev"><i class="fa-solid fa-backward"></i> Previous</button>
                                    <button type="button" class="btn btn-primary next">Next <i class="fa-solid fa-forward"></i></button>
                                </div>
                                {{-- part 4 --}}
                                <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
                                    <div class="form-group">
                                        <label for="uploadAnggaran" class="font-weight-bold">Rencana Anggaran Biaya:</label>
                                        <div class="input-group "> 
                                            <label class="input-group-btn">
                                            <span class="btny btn-outline-primary">
                                                Browse<input accept="application/pdf" id="uploadAnggaran" type="file" style="display: none;" name="rab">
                                            </span>
                                            </label>
                                            <input id="fileAnggaran" type="text" class="form-control @error('rab') is-invalid @enderror" readonly placeholder="Choose a file">
                                        </div>
                                        <script type="text/javascript">
                                            document.getElementById("uploadAnggaran").onchange = function (){
                                            document.getElementById("fileAnggaran").value = this.value;
                                            }
                                        </script>
                                        @error('rab')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="peneliti">Spesifikasi Peneliti/Tenaga Ahli:</label>
                                        <textarea id="peneliti" class="editor form-control @error('peneliti') is-invalid @enderror" name="peneliti">{{ old('peneliti') }}</textarea>
                                        @error('peneliti')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tahapan">Tahapan Kegiatan:</label>
                                        <textarea id="tahapan" class="editor form-control @error('tahapan') is-invalid @enderror" name="tahapan">{{ old('tahapan') }}</textarea>
                                        @error('tahapan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="jangka">Jangka Waktu Pelaksanaan:</label>
                                        <textarea id="jangka" class="editor form-control @error('jangka') is-invalid @enderror" name="jangka">{{ old('jangka') }}</textarea>
                                        @error('jangka')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-primary prev"><i class="fa-solid fa-backward"></i> Previous</button>
                                    <button type="button" class="btn btn-primary next">Next <i class="fa-solid fa-forward"></i></button>
                                </div>
                                {{-- part 5 --}}
                                <div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
                                    <h4>Metodologi</h4>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="jenis_sumber_data">A. Jenis Sumber Data:</label>
                                        <textarea id="jenis_sumber_data" class="editor form-control @error('jenis_sumber_data') is-invalid @enderror" name="jenis_sumber_data">{{ old('jenis_sumber_data') }}</textarea>
                                        @error('jenis_sumber_data')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold" for="teknik">B. Teknik Pengumpulan Data:</label>
                                        <textarea id="teknik" class="editor form-control @error('teknik') is-invalid @enderror" name="teknik">{{ old('teknik') }}</textarea>
                                        @error('teknik')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="analisa">C. Teknik Analisa Data:</label>
                                        <textarea id="analisa" class="editor form-control @error('analisa') is-invalid @enderror" name="analisa">{{ old('analisa') }}</textarea>
                                        @error('analisa')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
<x-logout/>
<script type="text/javascript">
  $(document).ready(function () {
    var stepper = new Stepper($('#stepper1')[0],{
      linear: false
    });
    $(".next").click(function () {
      stepper.next();
    });
    $(".prev").click(function () {
      stepper.previous();
    });

    CKEDITOR.replace('judul');
    CKEDITOR.replace('hukum');
    CKEDITOR.replace('maksud');
    CKEDITOR.replace('ruang_lingkup');
    CKEDITOR.replace('latar');
    CKEDITOR.replace('target');
    CKEDITOR.replace('output');
    CKEDITOR.replace('manfaat');
    CKEDITOR.replace('dana');
    CKEDITOR.replace('peneliti');
    CKEDITOR.replace('tahapan');
    CKEDITOR.replace('jangka');
    CKEDITOR.replace('jenis_sumber_data');
    CKEDITOR.replace('teknik');
    CKEDITOR.replace('analisa');
  });

</script>
@endfragment
@endsection