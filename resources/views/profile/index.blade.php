@extends('layouts.header')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Profil Pemda</h1>
        @if ($dataExist)
        <!-- <i class="fa-solid fa-user-secret"></i> -->
        @else
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#createProfile"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Create Profile</a>
        @endif
    </div>
    <!-- DataTables Example -->
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
        @php
        Session::forget('success');
        @endphp
    </div>
    @elseif (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
        @php
        Session::forget('error');
        @endphp
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Indikator SPD</th>
                            <th width="16%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($profiles as $p)
                        <tr>
                            <td>Kabupaten {{ $p->nama }} </td>
                            <td> 
                                <a href="{{url('indikator/spd', $p->id)}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-folder-closed"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="{{url('indikator/spd', $p->id)}}" target="_blank" class="btn btn-outline-secondary btn-sm" title="detail profil"><i class="fa-solid fa-user-secret"></i></a>
                            </tr>
                            @empty
                            <div class="alert alert-danger">
                                Data is not available.
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@include ('profile.modal-create-profile')

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<x-logout/>
@endsection