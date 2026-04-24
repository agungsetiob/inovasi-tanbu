@extends('layouts.header')
@section('content')
    @fragment('all-inovations')
        <div class="container-fluid slide-it" id="app">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Daftar Inovasi</h1>
                <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
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
        <script type="text/javascript">
            var dataTable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/api/all/inovations',
                    type: 'GET',
                    dataSrc: 'data'
                },
                order: [[0, 'desc']],
                columns: [
                    {
                        data: 'proposal.nama',
                        name: 'nama',
                        render: function (data, type, full) {
                            var badgeClass = (full.proposal.status === 'draft') ? 'badge-warning' : 'badge-success';
                            return data + ' <span class="badge rounded-pill ' + badgeClass + '">' + full.proposal.status + '</span>';
                        }
                    },
                    { data: 'skpd', name: 'skpd_id' },
                    {
                        data: 'skor',
                        name: 'total_skor',
                        className: 'text-center',
                        orderable: true,
                        render: function (data, type) {
                            var val = data || 0;
                            if (type === 'display') {
                                var colorClass = (val < 70) ? 'text-danger' : '';
                                return '<span class="' + colorClass + ' font-weight-bold">' + val + '</span>';
                            }
                            return val;
                        }
                    },
                    {
                        data: 'proposal.created_at',
                        name: 'created_at',
                        className: 'text-center',
                        render: function (data, type) {
                            if (type === 'display' || type === 'filter') {
                                return data ? new Date(data).getFullYear() : '-';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'proposal.id',
                        orderable: false,
                        className: 'text-center',
                        render: function (data) {
                            return '<a hx-get="{{ url("bukti-dukung") }}/' + data + '" ' +
                                'hx-trigger="click" hx-target="#app" hx-swap="outerHTML" ' +
                                'hx-push-url="true" hx-indicator="#loadingIndicator" ' +
                                'class="btn btn-outline-primary btn-sm mt-1">' +
                                '<i class="fas fa-folder-closed"></i></a>';
                        }
                    },
                    {
                        data: 'proposal.id',
                        orderable: false,
                        render: function (data) {
                            return '<div class="text-center">' +
                                '<a href="{{url("print/report")}}/' + data + '" target="_blank" ' +
                                'class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak">' +
                                '<i class="fas fa-file-alt"></i></a></div>';
                        }
                    }
                ],
                rowId: function (row) {
                    return 'index_' + row.proposal.id;
                },
                initComplete: function () {
                    htmx.process('#dataTable');
                    // custom debounce untuk pencarian
                    var typingTimer;
                    var doneTypingInterval = 350;
                    var $input = $('#dataTable_filter input');

                    $input.unbind(); // hapus event bawaan
                    $input.bind('keyup', function () {
                        clearTimeout(typingTimer);
                        var value = this.value;
                        typingTimer = setTimeout(function () {
                            if (value.length >= 3) {
                                // jalankan pencarian kalau >= 3 huruf
                                dataTable.search(value).draw();
                            } else if (value.length === 0) {
                                // kalau kosong, reset pencarian dan load data awal
                                dataTable.search('').draw();
                            }
                        }, doneTypingInterval);
                    });
                },
                drawCallback: function (settings) {
                    htmx.process('#dataTable');
                },
                error: function (xhr, error, thrown) {
                    console.error('DataTables error:', error, thrown);
                    alert('Error loading data. Please try again later.');
                }
            });

            document.body.addEventListener("reloadAll", function () {
                dataTable.ajax.reload(null, false);
            });
        </script>
    @endfragment
@endsection