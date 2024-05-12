@extends('layouts.header')
@section('content')
@fragment('winner')
            <div class="container-fluid slide-it" id="app">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Pemenang TIA</h1>
                    <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addWinner">
                        <i class="fas fa-plus fa-sm text-white fa-flip"></i> Input Pemenang</a>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Pemenang TIA</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" hx-history="false">
                            <table class="table table-borderless table-striped text-dark" id="winnerTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="40%">Pengusul</th>
                                        <th width="40%">Inovasi</th>
                                        <th width="10%">Kategori</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-winner">
                                    <!-- load server side dataTable here cuy -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<x-alert-modal/>
<x-logout/>
<script type="text/javascript">
    var dataTable = $('#winnerTable').DataTable({
        ajax: {
            url: '/api/winner',
            dataSrc: 'data'
        },
        columns: [
            { 
                render: function (data, type, row, meta) {
                    return meta.row + 1 + '.';
                }
            },
            { 
                data: 'pengusul' 
            },
            { 
                data: 'proposal.nama' 
            },
            { 
                data: 'kategori' 
            },
            { 
                render: function (data, type, row) {
                    return `
                        <button type="button" class="btn btn-outline-success btn-sm edit-button" title="edit" 
                            data-toggle="modal" 
                            data-target="#updateModal" 
                            data-winner-id="${row.id}"
                            data-proposal-id="${row.proposal.id}"
                            data-bukti-pengusul="${row.pengusul}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    `;
                }
            },
        ],
        "initComplete": function( settings, json ) {
            htmx.process('#winnerTable');
        },
        rowId: function (row) {
             return row.id;
        },
    });

    document.body.addEventListener("reloadWinner", function(evt){
        dataTable.ajax.reload(function() {
            htmx.process('#winnerTable');
        }, false)
    });
</script>
@include('components.winner-modal.modal-add-winner')
{{--@include ('components.edit-bukti')
@include ('components.modal-delete-bukti')--}}
@endfragment
@endsection