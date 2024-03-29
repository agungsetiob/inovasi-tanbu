@extends('layouts.header')
@section('content')
@fragment('all-inovations')
<div class="container-fluid slide-it" id="app">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Daftar Inovasi</h1>
        <a href="#" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal"
            data-target="#cetakLap"><i class="fas fa-print fa-sm text-white fa-flip"></i> Cetak</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Proposals</h6>
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
            @if ($errors->any())
            <div class="alert alert-danger data-dismiss alert-dismissible">
                <i class="fa fa-solid fa-bell fa-shake"></i>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="table-responsive" hx-history="false">
                <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="35%">Nama Inovasi</th>
                            <th>SKPD/UPTD</th>
                            <th>Skor</th>
                            <th width="8%">Tahun</th>
                            <th width="4%">Bukti Dukung</th>
                            <th width="17%"></th>
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
<!-- /.container-fluid -->
@include('components.cetak-laporan-inovasi')
{{-- <script>
    var dataTable;
    $(document).ready(function () {
        $.ajax({
            url: '/api/all/inovations',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                dataTable = $('#dataTable').DataTable({
                    data: response.data,
                    columns: [
                        { 
                            data: 'proposal.nama',
                            render: function (data, type, full, meta) {
                                // Check if proposal.status is 'draft' and add a badge
                                var badgeClass = (full.proposal.status === 'draft') ? 'badge rounded-pill badge-warning' : 'badge rounded-pill badge-success';
                                var badgeText = (full.proposal.status === 'draft') ? 'draft' : 'sent'; // Customize the badge text
                                return data + ' <span class="' + badgeClass + '">' + badgeText + '</span>';
                            },
                        },
                        { data: 'skpd' },
                        {
                            data: 'skor',
                            className: 'text-center',
                            render: function (data, type, full, meta) {
                                if (type === 'display') {
                                    var colorClass = (data < 70) ? 'text-danger' : '';
                                    return '<span class="' + colorClass + '">' + data + '</span>';
                                }
                                return data;
                            }
                        },
                       {
                            data: 'proposal.created_at', className: 'text-center',
                            render: function (data, type, full, meta) {
                                if (type === 'display') {
                                    return new Date(data).getFullYear();
                                }
                                return data;
                            }
                        },
                       {
                            data: 'proposal.id', className: 'text-center',
                            render: function (data, type, row) {
                                return '<a href="{{ url("bukti-dukung" )}}/' +  data + '" hx-get="{{ url("bukti-dukung")}}/'  + data + '" hx-trigger="click" hx-target="#app" hx-swap="outerHTML" hx-push-url="true" hx-indicator="#loadingIndicator" class="btn btn-outline-primary btn-sm mt-1"><i class="fas fa-folder-closed"></i></a>';
                            }
                        },
                       {
                            data: 'proposal.id',
                            render: function (data, type, row) {
                                var buttonsHtml = '<div class="text-center">';
                                buttonsHtml += '<a href="{{url("print/report")}}/' + data + '" target="_blank" class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak"><i class="fas fa-file-alt"></i></a>';
                                buttonsHtml += '</div>';

                                return buttonsHtml;
                            }
                        },
                    ],
                    "initComplete":  function (setting, json) {
                        htmx.process('#dataTable');
                    },
                    // rowId: function (row) {
                    //     return 'index_' + row.proposal.id;
                    // },
                    // createdRow: function (row, data, dataIndex) {
                    //     if (data.proposal.status === 'draft') {
                    //         $(row).addClass('bg-draft');
                    //     } else {
                    //         $(row).addClass('bg-sent');
                    //     }
                    // },
                });
            },
            error: function (error) {
                console.error('Error fetching proposals:', error);
            }
        });
    });

    document.body.addEventListener("reloadAll", function (evt) {
        dataTable.ajax.reload (function () {
            htmx.process('#dataTable');
        }, false)
    });
</script> --}}
<script type="text/javascript">
    var dataTable = $('#dataTable').DataTable({
        ajax: {
            url: '/api/all/inovations',
            dataSrc: 'data',
            processing: true,
            serverSide: true,
        },
        columns: [
            { 
                data: 'proposal.nama',
                render: function (data, type, full, meta) {
                    var badgeClass = (full.proposal.status === 'draft') ? 'badge rounded-pill badge-warning' : 'badge rounded-pill badge-success';
                    var badgeText = (full.proposal.status === 'draft') ? 'draft' : 'sent'; // Customize the badge text
                    return data + ' <span class="' + badgeClass + '">' + badgeText + '</span>';
                },
            },
            { 
                data: 'skpd' 
            },
            { 
                data: 'skor',
                className: 'text-center',
                render: function (data, type, full, meta) {
                    if (type === 'display') {
                        var colorClass = (data < 70) ? 'text-danger' : '';
                        return '<span class="' + colorClass + '">' + data + '</span>';
                    }
                    return data;
                }
            },
            {
                data: 'proposal.created_at',
                className: 'text-center',
                render: function (data, type, full, meta) {
                    if (type === 'display') {
                        return new Date(data).getFullYear();
                    }
                    return data;
                }
            },
            {
                data: 'proposal.id',
                className: 'text-center',
                render: function (data, type, row) {
                    return '<a href="{{ url("bukti-dukung" )}}/' +  data + '" hx-get="{{ url("bukti-dukung")}}/'  + data + '" hx-trigger="click" hx-target="#app" hx-swap="outerHTML" hx-push-url="true" hx-indicator="#loadingIndicator" class="btn btn-outline-primary btn-sm mt-1"><i class="fas fa-folder-closed"></i></a>';
                }
            },
            {
                data: 'proposal.id',
                render: function (data, type, row) {
                    var buttonsHtml = '<div class="text-center">';
                    buttonsHtml += '<a href="{{url("print/report")}}/' + data + '" target="_blank" class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak"><i class="fas fa-file-alt"></i></a>';
                    buttonsHtml += '</div>';

                    return buttonsHtml;
                }
            },
        ],
        "initComplete": function( settings, json ) {
            htmx.process('#dataTable');
        },
        "error": function(xhr, error, thrown) {
            console.error('DataTables error:', error, thrown);
            alert('Error loading data. Please try again later.');
        },
        rowId: function (row) {
            return 'index_' + row.proposal.id;
        },
    });

    document.body.addEventListener("reloadAll", function (evt) {
        dataTable.ajax.reload (function () {
            htmx.process('#dataTable');
        }, false)
    });
</script>
@endfragment
@endsection