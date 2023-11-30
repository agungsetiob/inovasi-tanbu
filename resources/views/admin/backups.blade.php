@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('backups')
        @if (Auth::user()->role === 'admin')
        <div class="container-fluid slide-it" id="app" data-loading-class="d-none">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Backups</h1>
                <a href="/backup/only-db" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Create Backup</a>
            </div>
            <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List of Backups</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama File</th>
                                        <th>Ukuran</th>
                                        <!-- <th>Created Date</th> -->
                                        <th>Waktu pembuatan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($backups as $backup)
                                    <tr>
                                        <td>{{$loop->iteration}}.</td>
                                        <td> {{$backup['file_name']}} </td>
                                        <td> {{ \App\Http\Controllers\BackupController::humanFilesize($backup['file_size']) }} </td>
                                        <!-- <td> {{ date('F jS, Y, g:ia (T)',$backup['last_modified']) }} </td> -->
                                        <td> {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }} </td>
                                        <td>
                                            <a class="btn btn-outline-warning btn-sm" href="{{ asset('storage/serasi/' . $backup['file_name']) }}"><i class="fa fa-download"></i> Download</a>

                                            <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Do you really want to delete this file?')" data-button-type="delete"
                                            href="{{ url('backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash"></i>
                                        Delete</a> 
                                    </td>      
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    No backup available.
                                </div>
                                @endforelse
                                @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                    @php
                                    Session::forget('error');
                                    @endphp
                                </div>
                                @elseif (Session::has('delete'))
                                <div class="alert alert-dark">
                                    {{ Session::get('delete') }}
                                    @php
                                    Session::forget('delete');
                                    @endphp
                                </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!-- /.container-fluid -->
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
@else
<div id="loadingIndicator" class="d-flex align-items-center justify-content-center" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
  <i class="fas fa-compass fa-spin fa-8x"></i>
</div>
@endif
@endfragment
@endsection