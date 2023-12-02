@extends('layouts.header')
@section('content')
        <div class="container-fluid slide-it" id="app">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Inovasi</h1>
            </div>
            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Proposals</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive"  hx-history="false">
                        <table class="table table-borderless table-striped" id="databaseInovasi" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="30%">Nama Inovasi</th>
                                    <th>SKPD</th>
                                    <th>Uji Coba</th>
                                    <th>Implementasi</th>
                                    <th>Skor</th>
                                    <th width="7%">Tahapan</th>
                                    <th width="4%">Bukti Dukung</th>
                                    <th width="8%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- server side datatable here -->
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
{{--<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>--}}
<x-logout/>
<script type="text/javascript">
    var databaseTable;
    $(document).ready(function() {
        databaseTable = $('#databaseInovasi').DataTable({
            ajax: {
                url: '/api/database/inovasi',
                dataSrc: 'data',
                processing: true,
                serverSide: true,
            },
            columns: [
                { data: 'proposal.nama' },
                { data: 'skpd' },
                { data: 'ujicoba' },
                { data: 'implementasi', className: 'text-center', },
                { data: 'skor', className: 'text-center', },
                { 
                    data: 'tahapan', className: 'text-center',
                    render: function (data, type, row) {
                        // Apply badge styling based on the value of tahapan
                        var badgeClass = '';
                        if (data == 'ujicoba') {
                            badgeClass = 'bg-indigo fa-fade';
                        } else if (data == 'penerapan') {
                            badgeClass = 'bg-green fa-beat';
                        } else if (data == 'inisiatif') {
                            badgeClass = 'bg-orange fa-shake';
                        }

                        return '<span class="badge ' + badgeClass + '">' + data + '</span>';
                    }
                },
                { 
                    data: 'proposal.id', className: 'text-center',
                    render: function (data, type, row) {
                        return '<a hx-get="{{ url("bukti-dukung")}}/'+ data +'" hx-trigger="click" hx-target="#app" hx-swap="outerHTML" hx-push-url="true" hx-indicator="#loadingIndicator" class="btn btn-outline-primary btn-sm mt-1"><i class="fas fa-folder-closed"></i></a>';
                    }
                },
                { 
                    data: 'proposal.id',
                    render: function (data, type, row) {
                        var buttonsHtml = '<div class="text-center">';
                        buttonsHtml += '<a href="{{url("print/report")}}/' + data + '" target="_blank" class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak"><i class="fas fa-file-alt"></i></a>';
                            buttonsHtml += '<button id="return-proposal-' + row.id + '" data-proposal-id="'+ data +'" data-toggle="modal" data-target="#returnModal" data-proposal-name="' + row.proposal.nama + '" class="return-proposal btn btn-outline-warning btn-sm mt-1" title="kembalikan"><i class="fa-solid fa-ban"></i></button>';

                        buttonsHtml += '</div>';
                        return buttonsHtml;
                    }
                },
                ],
            "initComplete": function( settings, json ) {
                htmx.process('#databaseInovasi');
            },
            // other DataTable options...
        });

        document.body.addEventListener("reloadDatabase", function(evt){
            databaseTable.ajax.reload(function() {
                htmx.process('#databaseInovasi');
            }, false)
        });

    });
</script>
@include ('components.modal-return-proposal')
@endsection