@extends ('layouts.header')
@section ('content')
@fragment ('setting')
            <div class="container-fluid slide-it" id="app">
                <div id="form-button" class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Pengaturan sistem</h1>
                    @if ($dataExist)
                    <a id="edit-setting" data-id="@foreach ($settings as $s){{$s->id}}@endforeach" href="javascript:void(0)" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#editSetting">
                        <i class="fa-solid fa-gear fa-spin"></i> Update setting
                    </a>
                    @else
                    <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#createSetting"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Create setting</a>
                    @endif
                </div>
                <div id="setting" class="card shadow mb-4">
                    @forelse ($settings as $set)
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nama sistem:</strong><br>
                                {{$set->nama_sistem}}
                            </li>
                            <li class="list-group-item">
                                <strong>Tentang sistem:</strong><br>
                                {{$set->tentang}}
                            </li>
                            <li class="list-group-item">
                                <strong>Alamat kantor:</strong><br>
                                {{$set->alamat}}
                            </li>
                            <li class="list-group-item">
                                <strong>Logo sistem:</strong><br>
                                <img src="{{url('storage/system/' . $set->logo_sistem)}}" class="w-25" alt="logo_sistem">
                            </li>
                            <li class="list-group-item">
                                <strong>Logo cover:</strong><br>
                                <img src="{{url('storage/system/' . $set->logo_cover)}}" class="w-25" alt="logo_cover">
                            </li>
                        </ul>
                    </div>
                    @empty
                    <div class="text-center">
                        <img class="w-25" src="{{ asset('img/setting.png') }}" alt="image sistem">
                    </div>
                    @endforelse
                </div>  
            </div>

{{--<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>--}}
@include ('setting.modal-create-setting')
@include ('setting.modal-edit-setting')
<x-logout/>
<x-alert-modal/>
@endfragment
@endsection