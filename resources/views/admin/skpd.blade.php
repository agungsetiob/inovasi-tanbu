<!-- UI for skpd inovasi -->
@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('skpd')
            <div class="container-fluid slide-it" id="app">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">SKPD/UPTD</h1>
                    <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addCategory"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Tambah SKPD</a>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar SKPD</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" hx-history="false">
                            <table class="table table-borderless table-striped text-dark" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th width="51%">Nama</th>
                                        <th>Dibuat pada</th>
                                        <th>Jumlah</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-skpd">
                                    <!-- load server side dataTable here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<!-- /.container-fluid -->
@include ('components.modal-add-skpd')
@include ('components.modal-delete-skpd')
<x-alert-modal/>
<x-logout/>
<script type="text/javascript">
    var dataTable = $('#dataTable').DataTable({
        ajax: {
            url: '/api/skpd',
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
                data: 'nama',
                render: function (data, type, row) {
                    var hasProposals = row.proposal_count > 0;
                    var proposalText = hasProposals ? `<span class="badge badge-success">${row.proposal_count} inovasi</span>` : '<span class="badge badge-danger">kosong</span>';
                    return data + ' ' + proposalText;
                }
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
                            data-skpd-id="${row.id}"
                            data-skpd-name="${row.nama}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <div class="dropdown mb-4 d-inline">
                            <button class="btn btn-outline-primary dropdown-toggle btn-sm"
                                type="button"
                                id="dropdownMenuButton${row.id}"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-skpd-id="${row.id}"
                                data-skpd-status="${row.status}">
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

    $(document).ready(function() {
        $(document).on("click",".dropdown-item[data-action='toggle-status']",function(){
            var button = $(this);
            var skpdId = button.closest('.dropdown').find('.dropdown-toggle').data('skpd-id');
            var currentStatus = button.closest('.dropdown').find('.dropdown-toggle').data('skpd-status');

            $.ajax({
                url: '/skpd/change-status/' + skpdId,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        var newStatus = response.newStatus;
                        button.closest('.dropdown').find('.dropdown-toggle').data('skpd-status', newStatus);
                        button.closest('.dropdown').find('.dropdown-toggle').text(newStatus);
                        $('#success-modal').modal('show');
                        $('#success-message').html(response.message + '<p class="text-success">' + response.nama + '</p>');
                        setTimeout(function() {
                            $('#success-modal').modal('hide');
                            $(".modal-backdrop").remove();
                        }, 3700);
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
@endfragment
@endsection