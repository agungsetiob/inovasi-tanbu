@extends('layouts.header')
@section('content')
@fragment('evaluasi')
    <div class="container-fluid slide-it" id="app">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Evaluasi</h1>
            <a hx-get="{{ route('evaluasi.create') }}" hx-trigger="click" hx-target="#app" hx-swap="outerHTML"
                hx-push-url="true" hx-indicator="#loadingIndicator" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white fa-flip"></i> Buat Evaluasi
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Evaluasi</h6>
            </div>
            <div class="card-body">
                @include('components.alerts.alerts')
                <div class="table-responsive" hx-history="false">
                    <table class="table table-borderless table-striped" id="tabel-evaluasi" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Judul</th>
                                <th width="10%">Tahun</th>
                                <th width="35%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- server side dataTable gan -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        var dataTable;
        $(document).ready(function () {
            dataTable = $('#tabel-evaluasi').DataTable({
                ajax: {
                    url: '/api/evaluasi',
                    dataSrc: 'data',
                    processing: true,
                    serverSide: true,
                },
                columns: [
                    {
                        render: function (data, type, row, meta) {
                            return meta.row + 1 + '.';
                        }
                    },
                    { data: 'judul' },
                    { data: 'created_at', className: 'text-center' },
                    {
                        data: 'id',
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `
                                <a class="btn btn-sm btn-outline-warning" hx-get="{{ url("list/evaluasi") }}/${row.id}/edit" 
                                hx-target="#app" hx-swap="outerHTML" hx-push-url="true" hx-indicator="#loadingIndicator">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="delete-evaluasi btn btn-sm btn-outline-danger" 
                                data-toggle="modal" data-target="#deleteModal" 
                                data-evaluasi-id="${row.id}" data-evaluasi-judul="${row.judul}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            `;
                        }
                    },
                ],
                initComplete: function (settings, json) {
                    htmx.process('#tabel-evaluasi');
                },
            });
        });

        document.body.addEventListener("reloadTable", function (evt) {
            dataTable.ajax.reload(function () {
                htmx.process('#tabel-evaluasi');
            }, false);
        });
    </script>
    @include('components.evaluasi.delete-modal')
    @include('components.alert-modal')
@endfragment
@endsection