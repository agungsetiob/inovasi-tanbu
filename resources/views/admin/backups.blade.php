@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('backups')
        @if (Auth::user()->role === 'admin')
        <div class="container-fluid slide-it" id="app">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Backups</h1>
                <a 
                hx-get="{{ url('/backup/only-db') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML"
                hx-push-url="true"
                hx-indicator="#loadingIndicator" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Create Backup</a>
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
                                <div class="alert alert-danger text-center">
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
                                @elseif (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                    Session::forget('success');
                                    @endphp
                                    <i class="fa-brands fa-space-awesome"></i>
                                </div>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div id="loadingIndicator" class="d-flex align-items-center justify-content-center" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
        <i class="fas fa-compass fa-spin fa-8x"></i>
        </div>
        @endif
@endfragment
@endsection