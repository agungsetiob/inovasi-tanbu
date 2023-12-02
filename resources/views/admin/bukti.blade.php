@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('bukti')
            <div class="container-fluid slide-it" id="app">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Jenis Bukti Inovasi</h1>
                    <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addCategory"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Tambah Jenis Bukti</a>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Jenis Bukti Inovasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" hx-history="false">
                            <table class="table table-borderless table-striped text-dark" id="buktiTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="38%">Nama</th>
                                        <th width="5%">Bobot</th>
                                        <th width="37%">Indikator</th>
                                        <th width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-bukti">
                                    <!-- load server side dataTable here cuy -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<!-- /.container-fluid -->
       
{{--<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>--}}
<x-alert-modal/>
<x-logout/>
<script type="text/javascript">
    var dataTable = $('#buktiTable').DataTable({
        ajax: {
            url: '/api/bukti',
            dataSrc: 'data'
        },
        columns: [
            { 
                render: function (data, type, row, meta) {
                    return meta.row + 1 + '.';
                }
            },
            { 
                data: 'nama' 
            },
            { 
                data: 'bobot' 
            },
            { 
                data: 'indikator.nama' 
            },
            { 
                render: function (data, type, row) {
                    return `
                        <button type="button" class="btn btn-outline-success btn-sm edit-button" title="hapus" 
                            data-toggle="modal" 
                            data-target="#updateModal" 
                            data-bukti-id="${row.id}"
                            data-indikator-id="${row.indikator.id}"
                            data-bukti-name="${row.nama}"
                            data-bobot="${row.bobot}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="hapus" 
                            data-toggle="modal" 
                            data-target="#deleteModal" 
                            data-bukti-id="${row.id}"
                            data-bukti-name="${row.nama}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <div class="dropdown mb-4 d-inline">
                            <button class="btn btn-outline-primary dropdown-toggle btn-sm"
                                type="button"
                                id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-bukti-id="${row.id}"
                                data-bukti-status="${row.status}">
                                ${row.status}
                            </button>
                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" data-action="toggle-status">change status</button>
                            </div>
                        </div>
                    `;
                }
            },
        ],
        "initComplete": function( settings, json ) {
            htmx.process('#buktiTable');
        },
        rowId: function (row) {
             return row.id;
        },
    });

    document.body.addEventListener("reloadBukti", function(evt){
        dataTable.ajax.reload(function() {
            htmx.process('#buktiTable');
        }, false)
    });


    $(document).ready(function() {
        $(".container-fluid").on("click", ".dropdown-item[data-action='toggle-status']", function(){
            var button = $(this);
            var buktiId = button.closest('.dropdown').find('.dropdown-toggle').data('bukti-id');
            var currentStatus = button.closest('.dropdown').find('.dropdown-toggle').data('bukti-status');

            $.ajax({
                url: '/bukti/change-status/' + buktiId,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        var newStatus = response.newStatus;
                        button.closest('.dropdown').find('.dropdown-toggle').data('bentuk-status', newStatus);
                        button.closest('.dropdown').find('.dropdown-toggle').text(newStatus);
                        $('#success-modal').modal('show');
                        $('#success-message').text(response.message);
                        setTimeout(function() {
                            $('#success-modal').modal('hide');
                        }, 3900);
                    }
                },
                error: function(error) {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
            });
        });
    });
</script>
@include ('components.modal-add-bukti')
@include ('components.edit-bukti')
@include ('components.modal-delete-bukti')
@endfragment
@endsection