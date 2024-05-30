@extends('layouts.header')
@section('content')
    @fragment('evaluasi')
            <div class="container-fluid slide-it" id="app">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Evaluasi</h1>
                    <a
                    hx-get="{{ route('evaluasi.create') }}" 
                    hx-trigger="click" 
                    hx-target="#app" 
                    hx-swap="outerHTML"
                    hx-push-url="true"
                    hx-indicator="#loadingIndicator" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Buat Evaluasi</a>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Evaluasi</h6>
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
                url: '/api/evaluasi',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    dataTable = $('#tabel-evaluasi').DataTable({
                        data: response.data,
                        columns: [
                            { 
                                render: function (data, type, row, meta) {
                                    return meta.row + 1 + '.';
                                }
                            },
                            { data: 'judul' },
                            { data: 'created_at', className: 'text-center' },
                            { 
                                data: null, 
                                className: 'text-center', 
                                render: function (data, type, row) {
                                    return `
                                        <a href="/evaluasi/${row.id}/edit" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteEvaluasi(${row.id})">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    `;
                                }
                            },
                        ],
                        "initComplete": function( settings, json ) {
                            htmx.process('#tabel-evaluasi');
                        },
                    });
                },
                error: function (error) {
                    console.error('Error fetching evaluasi:', error);
                },
            });
        });

        function deleteEvaluasi(id) {
            if (confirm('Are you sure you want to delete this evaluasi?')) {
                $.ajax({
                    url: `/evaluasi/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        $('#success-message').text('Evaluasi successfully deleted');
                        $('#success-alert').removeClass('d-none');
                        dataTable.ajax.reload(function() {
                            htmx.process('#tabel-evaluasi');
                        }, false);
                    },
                    error: function (error) {
                        $('#error-message').text('Error deleting evaluasi');
                        $('#error-alert').removeClass('d-none');
                        console.error('Error deleting evaluasi:', error);
                    }
                });
            }
        }

        document.body.addEventListener("reloadTable", function(evt){
            dataTable.ajax.reload(function() {
                htmx.process('#tabel-evaluasi');
            }, false);
        });
    </script>
    @endfragment
@endsection
