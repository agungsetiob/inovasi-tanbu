@extends('layouts.header')
@section('content')
@fragment('create-proposal')
    <div class="container-fluid slide-it" id="app">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Formulir Proposal Inovasi</h1>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card border-0 shadow rounded mb-4">
            <div class="card-body">
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
                </div>
                <div class="bs-stepper-content">
                  <form action="{{ route('inovasi.store') }}" method="POST" enctype="multipart/form-data"  hx-history="false">
                    @csrf
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                      <div class="form-group">
                        <label class="font-weight-bold" for="nama">Nama inovasi:</label>
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama inovasi">

                        <!-- error message untuk nama -->
                        @error('nama')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <div class="row g-3">
                          <div class="col">
                            <label class="font-weight-bold" for="tahapan">Tahapan inovasi:</label>
                            <select name="tahapan" id="tahapan" class="form-control @error('tahapan') is-invalid @enderror" required>
                              <option value="" disabled selected>Pilih tahapan</option>
                              @foreach ($tahapans as $tahap)
                              <option value="{{ $tahap->id }}" {{ old('tahapan') == $tahap->id ? 'selected' : ''}}>{{ $tahap->nama }}</option>
                              @endforeach
                            </select>
                            @error('tahapan')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col">
                            <label class="font-weight-bold" for="inisiator">Inisiator inovasi:</label>
                            <select name="inisiator" id="inisiator" class="form-control @error('inisiator') is-invalid @enderror" required>
                              <option value="">Pilih inisiator</option>
                              @foreach ($inisiators as $inisiator)
                              <option value="{{ $inisiator->id }}" {{ old('inisiator') == $inisiator->id ? 'selected' : ''}}>{{ $inisiator->nama }}</option>
                              @endforeach
                            </select>
                            @error('inisiator')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col">
                            <label class="font-weight-bold" for="tematik">Tematik:</label>
                            <select name="tematik" id="tematik" class="form-control @error('tematik') is-invalid @enderror" required>
                              <option value="" disabled selected>Pilih tematik</option>
                              @foreach ($tematiks as $tema)
                              <option value="{{ $tema->id }}" {{ old('tematik') == $tema->id ? 'selected' : ''}}>{{ $tema->nama }}</option>
                              @endforeach
                            </select>
                            @error('tematik')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row g-3">
                          <div class="col-md-4">
                            <label class="font-weight-bold" for="category">Jenis inovasi:</label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                              <option value="" disabled selected>Pilih jenis inovasi</option>
                              @foreach ($categories as $cat)
                              <option value="{{ $cat->id }}" {{ old('category') == $cat->id ? 'selected' : ''}}>{{ $cat->name }}</option>
                              @endforeach
                            </select>
                            @error('category')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col">
                            <label class="font-weight-bold" for="bentuk">Bentuk inovasi:</label>
                            <select name="bentuk" id="bentuk" class="form-control @error('bentuk') is-invalid @enderror" required><i class="fas fa-angle-up"></i>
                              <option value="" disabled selected>Pilih bentuk inovasi</option>
                              @foreach ($bentuks as $ben)
                              <option value="{{ $ben->id }}" {{ old('bentuk') == $ben->id ? 'selected' : ''}}>{{ $ben->nama }}</option>
                              @endforeach
                            </select>
                            @error('bentuk')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <!-- select 2 -->
                      <div class="form-group">
                        <label class="font-weight-bold" for="urusan">Urusan inovasi daerah:</label>
                        <select name="urusans[]" id="urusan" class="form-control @error('urusan') is-invalid @enderror" required multiple>
                          <option value="" disabled selected>Pilih urusan inovasi</option>
                          @foreach ($options as $klasifikasiId => $klasifikasiData)
                          <optgroup class="font-weight-bold" label="{{ $klasifikasiData['label'] }}">
                            @foreach ($klasifikasiData['children'] as $urusanId => $urusanName)
                            <option value="{{ $urusanId }}" {{ in_array($urusanId, old('urusans', [])) ? 'selected' : '' }}>
                              {{ $urusanName }}
                            </option>
                            @endforeach
                          </optgroup>
                          @endforeach
                        </select>
                        @error('urusans')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold" for="tujuan">Tujuan inovasi:</label>
                        <input id="tujuan" type="text" class="editor form-control @error('tujuan') is-invalid @enderror" name="tujuan" value="{{ old('tujuan') }}" placeholder="Masukkan tujuan pembuatan inovasi Daerah">
                        @error('tujuan')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <div class="row g-3">
                          <div class="col">
                            <label for="ujicoba" class="font-weight-bold">Waktu ujicoba:</label>
                            <input id="ujicoba" type="date" class="form-control @error('ujicoba') is-invalid @enderror" name="ujicoba" value="{{ old('ujicoba') }}" placeholder="Masukkan waktu uji coba inovasi">

                            @error('ujicoba')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col">
                            <label for="implementasi" class="font-weight-bold">Waktu implementasi:</label>
                            <input id="implementasi" type="date" class="form-control @error('implementasi') is-invalid @enderror" name="implementasi" value="{{ old('implementasi') }}" placeholder="Masukkan waktu implementasi inovasi">

                            @error('implementasi')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col">
                            <label class="font-weight-bold" for="uploadBtn">Profil:</label>
                            <div class="input-group "> 
                              <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                  Browse<input accept="application/pdf" id="uploadBtn" type="file" style="display: none;" name="profil">
                                </span>
                              </label>
                              <input id="uploadFile" type="text" class="form-control @error('profil') is-invalid @enderror" readonly placeholder="Choose a file">
                            </div>
                            @error('profil')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                            <script type="text/javascript">
                              document.getElementById("uploadBtn").onchange = function (){
                                document.getElementById("uploadFile").value = this.value;
                              }
                            </script>
                          </div>
                          <div class="col">
                            <label for="uploadAnggaran" class="font-weight-bold">Anggaran:</label>
                            <div class="input-group "> 
                              <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                  Browse<input accept="application/pdf" id="uploadAnggaran" type="file" style="display: none;" name="anggaran">
                                </span>
                              </label>
                              <input id="fileAnggaran" type="text" class="form-control @error('anggaran') is-invalid @enderror" readonly placeholder="Choose a file">
                            </div>
                            <script type="text/javascript">
                              document.getElementById("uploadAnggaran").onchange = function (){
                                document.getElementById("fileAnggaran").value = this.value;
                              }
                            </script>

                            <!-- error message untuk title -->
                            @error('anggaran')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn btn-primary" id="nextB">Next <i class="fa-solid fa-forward"></i></button>
                    </div>
                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                      <div class="form-group">
                        <label class="font-weight-bold" for="rancang">Rancang bangun:</label>
                        <textarea rows="3" id="rancang" class="editor form-control @error('rancang_bangun') is-invalid @enderror" name="rancang_bangun" placeholder="Masukkan rancang bangun dan pokok perubahan yang dilakukan">{{ old('rancang_bangun') }}</textarea>

                        <!-- error message untuk content -->
                        @error('rancang_bangun')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold" for="manfaat">Manfaat yang diperoleh:</label>
                        <textarea id="manfaat" rows="3" class="editor form-control @error('manfaat') is-invalid @enderror" name="manfaat" placeholder="Masukkan manfaat dari inovasi yang dilakukan">{{ old('manfaat') }}</textarea>

                        <!-- error message untuk title -->
                        @error('manfaat')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label class="font-weight-bold" for="hasil">Hasil inovasi:</label>
                        <textarea id="hasil" rows="3" class="editor form-control @error('hasil') is-invalid @enderror" name="hasil" placeholder="Masukkan hasil dari inovasi yang dilakukan">{{ old('hasil') }}</textarea>

                        <!-- error message untuk content -->
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

                            <!-- error message untuk title -->
                            @error('skpd')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                      </div>
                        <button type="button" class="btn btn-primary" id="prevB"><i class="fa-solid fa-backward"></i> Previous</button>
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

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<x-logout/>
<script type="text/javascript">
  $(document).ready(function () {
    var stepper = new Stepper($('#stepper1')[0],{
      linear: false
    });
    $("#nextB").click(function () {
      stepper.next();
    });
    $("#prevB").click(function () {
      stepper.previous();
    });

    $('select').selectize({
      sortField: 'id',
      plugins: ['remove_button']
    });

    CKEDITOR.replace('rancang', {
      contentsCss: ["{{asset('vendor/ckeditor/plugins/wordcount/css/wordcount.css')}}"],
      extraPlugins: 'wordcount',
      wordcount: {
        showParagraphs: false,
        showWordCount: true
      }
    });

    CKEDITOR.replace('manfaat')

    CKEDITOR.replace('hasil') 
  });

  document.addEventListener('htmx:afterRequest', function (event) {
        $('select').each(function () {
            var selectize = $(this)[0].selectize;
            if (selectize) {
                selectize.destroy();
            }
        });
    });
  // document.body.addEventListener('htmx:pushedIntoHistory', (evt) => {
  //     localStorage.removeItem('htmx-history-cache')
  //   });

</script>
@endfragment
@endsection