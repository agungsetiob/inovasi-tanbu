@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('message')
            <div class="container-fluid slide-it" id="app">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Pesan</h1>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row g-3">
                            <div class="col">
                                <label class="font-weight-bold">Mulai tanggal :</label>
                                <input type="date" name="startdate" class="form-control" id="startdate">
                            </div>
                            <div class="col">
                                <label class="font-weight-bold">Sampai tanggal :</label>
                                <input type="date" name="enddate" class="form-control" id="enddate">
                            </div>
                            <div class="col" style="padding-top: 2rem;" >
                                <a href="" onclick="this.href='messages/laporan/'+ document.getElementById('startdate').value + '/' +document.getElementById('enddate').value" class=" d-sm-inline-block btn btn-danger shadow-sm" target="_blank"><i class="fas fa-print text-white"></i> Cetak</a>
                            </div>
                        </div>
                    </div>
                </div>   

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Pesan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th width="20%">Email</th>
                                        <th width="35%">Pesan</th>
                                        <th>Tanggal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $mes)
                                    <tr id="index_{{$mes->id}}">
                                        <td> {{$mes->name}} </td>
                                        <td> {{$mes->email}} </td>
                                        <td> {{$mes->message}} </td>
                                        <td> {{$mes->created_at}} </td>
                                        <td>
                                            <button class="btn btn-outline-danger btn-sm delete-button" title="hapus" 
                                            data-toggle="modal" 
                                            data-target="#deleteModal" 
                                            data-message-id="{{ $mes->id }}"
                                            data-message-name="{{ $mes->name }}"><i class="fas fa-trash"></i></button>       
                                        </td>
                                    </tr>
                                    @endforeach
                                    <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                                        <span id="success-message"></span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div id="error-alert" class="alert alert-danger d-none">
                                        <span id="error-message"></span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- end container fluid -->

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
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<x-delete-message/>
<x-logout/>
@endfragment
@endsection