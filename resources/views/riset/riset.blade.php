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
                                        <th width="45%">Judul Kajian</th>
                                        <th width="20%">SKPD</th>
                                        <th width="5%">Tahun</th>
                                        <th width="25%"></th>
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
                            { data: 'tahun', className: 'text-center' },
                            { 
                                data: 'id',
                                render: function (data, type, row) {
                                    var urlButtonColor = row.url ? 'btn-outline-primary' : 'btn-outline-warning';
                                    var statusOptions = ['pending', 'approved', 'rejected'];
                                    var buttonsHtml = '<div class="text-center">';
                                    @if (auth()->user()->role == 'admin')
                                        buttonsHtml += '<button id="url-' + data + '" class="url-button btn ' + urlButtonColor + ' btn-sm mr-1 mt-1" title="url" data-toggle="modal" data-target="#addUrl" data-riset-id="' + data + '" data-riset-judul="' + row.judul + '"><i class="fas fa-link"></i></button>';
                                        buttonsHtml += '<div class="btn-group mr-1 mt-1">';
                                        buttonsHtml += '<button type="button" class="btn btn-sm ' + (row.status === 'pending' ? 'btn-warning' : row.status === 'approved' ? 'btn-success' : 'btn-danger') + ' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                        buttonsHtml += row.status.charAt(0).toUpperCase() + row.status.slice(1);
                                        buttonsHtml += '</button>';
                                        buttonsHtml += '<div class="dropdown-menu">';
                                        statusOptions.forEach(function(status) {
                                            if (status !== row.status) {
                                                buttonsHtml += '<a class="dropdown-item change-status" href="#" data-id="' + data + '" data-status="' + status + '">' + status.charAt(0).toUpperCase() + status.slice(1) + '</a>';
                                            }
                                        });
                                        buttonsHtml += '</div>';
                                        buttonsHtml += '</div>';
                                    @endif
                                    buttonsHtml += '<a href="{{url("print/riset")}}/' + data + '" target="_blank" class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak"><i class="fas fa-file-alt"></i></a>';
                                    if (row.user_id == {{ auth()->user()->id }}) {
                                        buttonsHtml += '<button id="hapus-' + data + '" class="delete-button btn btn-outline-danger btn-sm mr-1 mt-1" title="Hapus" data-toggle="modal" data-target="#deleteModal" data-riset-id="' + data + '" data-riset-judul="' + row.judul + '"><i class="fas fa-trash"></i></button>';
                                        buttonsHtml += '<a id="edit-' + data + '" hx-get="{{ url("riset")}}/'+ data +'/edit" hx-trigger="click" hx-target="#app" hx-swap="outerHTML" hx-push-url="true" hx-indicator="#loadingIndicator" class="btn btn-outline-info btn-sm mr-1 mt-1" title="Edit"><i class="fas fa-pencil-alt" alt="edit"></i></a>';
                                        if (row.user_id != 1) {
                                            buttonsHtml += '<button class="btn ' + (row.status === 'pending' ? 'btn-warning' : row.status === 'approved' ? 'btn-success' : 'btn-danger') + ' btn-sm mr-1 mt-1" title="status">'+ row.status +'</button>';
                                        }
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
            }, false);
        });

        // Event listener for status change
        $(document).on('click', '.change-status', function (e) {
            e.preventDefault();
            var link = $(this);
            var id = link.data('id');
            var status = link.data('status');
            var buttonGroup = link.closest('.btn-group');
            var dropdownButton = buttonGroup.find('.dropdown-toggle');

            // Show loading animation
            dropdownButton.html('<i class="fas fa-spinner fa-spin"></i> Processing...');
            dropdownButton.prop('disabled', true);

            $.ajax({
                url: '/riset/update-status/' + id,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function (response) {
                    // Update button text and class based on new status
                    var newClass = status === 'approved' ? 'btn-success' : status === 'rejected' ? 'btn-danger' : 'btn-warning';
                    dropdownButton.removeClass('btn-warning btn-success btn-danger').addClass(newClass);
                    dropdownButton.text(status.charAt(0).toUpperCase() + status.slice(1));
                },
                error: function (error) {
                    console.error('Error updating status:', error);
                    // Show error message and re-enable button
                    dropdownButton.html('<i class="fas fa-times"></i> Error');
                },
                complete: function () {
                    // Re-enable button after request completes
                    dropdownButton.prop('disabled', false);
                }
            });
        });
    </script>
    @include('components.modal-delete-pengajuan-riset')
    @include('components.modal-url-riset')
    @endfragment
@endsection
