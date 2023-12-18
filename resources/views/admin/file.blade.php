@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('bukti-dukung')
        <div class="container-fluid slide-it" id="app">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">{{ $proposal->nama }}</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-sm-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar File Bukti Dukung</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- previous alert -->
                            <table class="table table-borderless table-striped" width="100%" cellspacing="0" id="files-table">
                                <thead>
                                    <tr>
                                        <th>Indikator</th>
                                        <th width="53%">Bukti</th>
                                        <th>Bobot</th>
                                        <th width="12%"></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th>{{$totalBobot}}</th>
                                    </tr>
                                    <tr>
                                        <td>* wajib diisi</td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    {{--@foreach ($proposal->indikators()->get() as $indikator)--}}
                                    @foreach ($proposal->indikators as $indikator)
                                    <tr>
                                        <td>{{$indikator->nama}}</td>
                                        <td>@foreach ($indikator->files()->where('proposal_id', $proposalId)->get() as $item) {{$item->bukti->nama}} @endforeach</td>
                                        <td class="text-center">@foreach ($indikator->files()->where('proposal_id', $proposalId)->get() as $item) {{$item->bukti->bobot}} @endforeach</td>
                                        <td class="text-center">
                                            @if ($proposal->status === 'draft' && Auth::user()->id === $proposal->user_id)
                                                @forelse ($indikator->files()->where('proposal_id', $proposalId)->get() as $item)
                                                    <a class="btn-edit btn btn-outline-secondary btn-sm" title="edit" href="javascript:void(0)" data-toggle="modal" data-target="#editModal"
                                                    data-indikator-id="{{$indikator->id}}"
                                                    data-indikator-nama="{{$indikator->nama}}" 
                                                    data-file-id="{{$item->id}}" 
                                                    data-proposal-id="{{$proposal->id}}"
                                                    data-bukti-id="{{$item->bukti->id}}"
                                                    data-file-informasi="{{$item->informasi}}"
                                                    ><i class="fa fa-pen-to-square"></i></a>
                                                    @if ($item->file)
                                                    <a class="btn btn-outline-success btn-sm" title="download" href="{{url('/storage/docs/'. $item->file )}}" target="_blank"><i class="fa-solid fa-download"></i></a>
                                                    @endif
                                                @empty
                                                    <button class="btn-add btn btn-outline-primary btn-sm" data-id="{{$indikator->id}}" title="upload" href="#" data-toggle="modal" data-target="#uploadFile">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </button>
                                                @endforelse
                                            @elseif ($proposal->status === 'sent')
                                                @foreach ($indikator->files()->where('proposal_id', $proposalId)->get() as $item)
                                                    @if ($item->file)
                                                        <a class="btn btn-outline-success btn-sm" title="download" href="{{url('/storage/docs/'. $item->file )}}" target="_blank"><i class="fa-solid fa-download"></i></a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- container-fluid --}}

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
@include('components.modal-add-indikator')
@include('components.modal-edit-indikator')
<x-alert-modal/>
<x-logout/>
@endfragment
@endsection