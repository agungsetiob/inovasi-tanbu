@extends('layouts.riset-menus')
@section('content')
@fragment('riset')
        <div class="container-fluid slide-it" id="app">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Riset</h1>
                <a
                hx-get="{{ route('riset.create') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML"
                hx-push-url="true"
                hx-indicator="#loadingIndicator" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Ajukan Riset</a>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengajuan Riset</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success data-dismiss alert-dismissible">
                            <i class="fa fa-solid fa-check"></i>
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger data-dismiss alert-dismissible">
                            <i class="fa fa-solid fa-bell fa-shake"></i>
                            {{ Session::get('error') }}
                            @php
                            Session::forget('error');
                            @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive" hx-history="false">
                        <table class="table table-borderless table-striped" id="tabel-riset" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="50%">Judul Kajian</th>
                                    <th width="20%">SKPD</th>
                                    <th width="5%">Tahun</th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- server side dataTable gan -->
                            </tbody>
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                                <i class="fa fa-solid fa-check"></i>
                                <span id="success-message"></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div id="error-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                <i class="fa fa-solid fa-bell fa-shake"></i>
                                <span id="error-message"></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<script>
    var dataTable;
    $(document).ready(function () {
        $.ajax({
            url: '/pengajuan-riset',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                dataTable = $('#tabel-riset').DataTable({
                    data: response.data,
                    columns: [
                        { 
                            render: function (data, type, row, meta) {
                                return meta.row + 1 + '.';
                            }
                        },
                        { data: 'judul'},
                        { data: 'skpd.nama'},
                        { 
                            data: 'created_at',
                            className: 'text-center',
                            render: function (data, type, full, meta) {
                                if (type === 'display') {
                                    return new Date(data).getFullYear();
                                }
                                return data;
                            }
                        },
                        { 
                            data: 'id',
                            render: function (data, type, row) {
                                var urlButtonColor = row.url ? 'btn-outline-primary' : 'btn-outline-warning';
                                var buttonsHtml = '<div class="text-center">';
                                @if (auth()->user()->role == 'admin')
                                    buttonsHtml += '<button id="url-' + data + '" class="url-button btn ' + urlButtonColor + ' btn-sm mr-1 mt-1" title="url" data-toggle="modal" data-target="#addUrl" data-riset-id="' + data + '" data-riset-judul="' + row.judul + '"><i class="fas fa-link"></i></button>';
                                @endif
                                buttonsHtml += '<a href="{{url("print/riset")}}/' + data + '" target="_blank" class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak"><i class="fas fa-file-alt"></i></a>';
                                if (row.user_id == {{ auth()->user()->id }}) {
                                    buttonsHtml += '<button id="hapus-' + data + '" class="delete-button btn btn-outline-danger btn-sm mr-1 mt-1" title="Hapus" data-toggle="modal" data-target="#deleteModal" data-riset-id="' + data + '" data-riset-judul="' + row.judul + '"><i class="fas fa-trash"></i></button>';
                                    buttonsHtml += '<a id="edit-' + data + '" hx-get="{{ url("riset")}}/'+ data +'/edit" hx-trigger="click" hx-target="#app" hx-swap="outerHTML" hx-push-url="true" hx-indicator="#loadingIndicator" class="btn btn-outline-success btn-sm mr-1 mt-1" title="Edit"><i class="fas fa-pencil-alt" alt="edit"></i></a>';
                                }
                                buttonsHtml += '</div>';
                                return buttonsHtml;
                            }
                        },
                    ],
                    "initComplete": function( settings, json ) {
                        htmx.process('#tabel-riset');
                    },
                });
            },
            error: function (error) {
                console.error('Error fetching proposals:', error);
            },
        });
    });
    
    document.body.addEventListener("reloadTable", function(evt){
        dataTable.ajax.reload(function() {
            htmx.process('#tabel-riset');
        }, false)
    });
</script>
<x-alert-modal/>
@include('components.modal-delete-pengajuan-riset')
@include('components.modal-url-riset')
@endfragment
@endsection
