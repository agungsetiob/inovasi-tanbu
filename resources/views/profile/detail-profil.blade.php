@extends('layouts.header')
@section('content')
<style type="text/css">

    nav > .nav.nav-tabs{

      border: none;
      color:#fff;
      background:#272e38;
      border-radius:0;

  }
  nav > div a.nav-item.nav-link,
  nav > div a.nav-item.nav-link.active
  {
      border: none;
      padding: 18px 25px;
      color:#fff;
      background:#272e38;
      border-radius:0;
  }

  nav > div a.nav-item.nav-link.active:after
  {
      content: "";
      position: relative;
      bottom: -60px;
      left: -5%;
      border: 15px solid transparent;
      border-top-color: #e74c3c ;
  }
  .tab-content{
      background: #fdfdfd;
      line-height: 25px;
      border: 1px solid #ddd;
      border-top:5px solid #e74c3c;
      border-bottom:5px solid #e74c3c;
      padding:1px 1px;
  }

  nav > div a.nav-item.nav-link:hover,
  nav > div a.nav-item.nav-link:focus
  {
      border: none;
      background: #e74c3c;
      color:#fff;
      border-radius:0;
      transition:background 0.20s linear;
  }
</style>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Kabupaten Tanah Bumbu</h1>
        <a id="edit-profile" href="javascript:void(0)" class="btn btn-sm btn-primary shadow-sm" data-profile-id="{{$profile->id}}" data-toggle="modal" data-target="#editProfile">
            <i class="fa-solid fa-user-secret"></i> Update Profile
        </a>
    </div>
    <div class="card shadow mb-4">
        <nav style="padding-bottom: 1.3rem;">
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profil</a>
                <a class="nav-item nav-link" id="nav-indikator-tab" data-toggle="tab" href="#indikators" role="tab" aria-controls="indikator" aria-selected="false">Indikator</a>
            </div>
        </nav>
        <div class="tab-content px-sm-0" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Nama Pemda:</strong><br>
                        {{$profile->nama}}
                    </li>
                    <li class="list-group-item">
                        <strong>SKPD yang menangani:</strong><br>
                        {{$profile->skpd}}
                    </li>
                    <li class="list-group-item">
                        <strong>Alamat:</strong><br>
                        {{$profile->alamat}}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong><br>
                        {{$profile->email}}
                    </li>
                    <li class="list-group-item">
                        <strong>Nomor Telepon:</strong><br>
                        {{$profile->telp}}
                    </li>
                    <li class="list-group-item">
                        <strong>Nama Admin:</strong><br>
                        {{$profile->admin}}
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="indikators" role="tabpanel" aria-labelledby="nav-indikator-tab">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped" width="100%" cellspacing="0" id="files-table">
                            <thead>
                                <tr>
                                    <th>Indikator</th>
                                    <th width="57%">Informasi</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profile->indikators as $indikator)
                                <tr id="@foreach ($indikator->files()->get() as $item)index_{{$item->id}}@endforeach">
                                    <td>{{$indikator->nama}}</td>
                                    <td>@foreach ($indikator->files()->get() as $item) {{$item->bukti->nama}} @endforeach</td>
                                    <td class="text-center">
                                        @forelse ($indikator->files()->get() as $item)
                                        <a class="btn btn-outline-secondary btn-sm btn-edit" title="edit" href="javascript:void(0)" data-toggle="modal" data-target="#editSpd" 
                                        data-profile-id="{{$profile->id}}" 
                                        data-indikator-id="{{$indikator->id}}" 
                                        data-bukti-id="{{$item->bukti->id}}">
                                        <i class="fa fa-pen-to-square"></i>
                                        </a>
                                        <a class="btn btn-outline-success btn-sm" title="download" href="{{url('/storage/docs/'. $item->file )}}" target="_blank">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        @empty
                                        <button class="btn btn-outline-primary btn-sm btn-add" data-in-id="{{$indikator->id}}" title="upload" href="#" data-toggle="modal" data-target="#uploadFile">
                                            <i class="fa fa-pen-to-square"></i>
                                        </button>
                                        @endforelse
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
@include('components.modal-add-spd')
@include('components.modal-edit-spd')
@include('profile.modal-edit-profile')
<x-logout/>
<x-alert-modal/>
@endsection