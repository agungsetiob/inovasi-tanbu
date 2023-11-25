@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Tematik Inovasi</h1>
        <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addCategory"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Tambah tematik</a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar tematik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped text-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="51%">name</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-tematik">
                        <!-- load server side dataTable here cuy -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@include ('components.modal-add-tematik')
@include('components.modal-delete-tematik')
<x-alert-modal/>
<x-logout/>
<script type="text/javascript">
    var dataTable = $('#dataTable').DataTable({
        ajax: {
            url: '/api/tematik',
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
            { 
                data: 'nama' 
            },
            { 
                data: 'created_at' 
            },
            { 
                render: function (data, type, row) {
                    return `
                        <button type="button" class="btn btn-outline-danger btn-sm delete-button" title="hapus" 
                            data-toggle="modal" 
                            data-target="#deleteModal" 
                            data-tematik-id="${row.id}"
                            data-tematik-name="${row.nama}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <div class="dropdown mb-4 d-inline">
                            <button class="btn btn-outline-primary dropdown-toggle btn-sm"
                                type="button"
                                id="dropdownMenuButton${row.id}"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-tematik-id="${row.id}"
                                data-tematik-status="${row.status}">
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
        // other DataTable options...
    });
    $(document).ready(function () {
        $(".container-fluid").on("click", ".dropdown-item[data-action='toggle-status']", function() {
            var button = $(this).closest('.dropdown').find('button.dropdown-toggle');
            var tematikId = button.data('tematik-id');
            var currentStatus = button.data('tematik-status');

            // Perform an AJAX request to toggle the status
            $.ajax({
                url: '/toggle-status/tematik/' + tematikId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    currentStatus: currentStatus
                },
                success: function (response) {
                    $('#success-modal').modal('show');
                    $('#success-message').html(response.message + '<p class="text-success">' + response.nama + '</p>');
                    // Update the button text and data attributes
                    var newStatus = response.newStatus;
                    button.text(newStatus);
                    button.data('tematik-status', newStatus);
                    setTimeout(function() {
                        $('#success-modal').modal('hide');
                    }, 3900);
                },
                error: function (error) {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
            });
        });
    });
</script>
@endsection