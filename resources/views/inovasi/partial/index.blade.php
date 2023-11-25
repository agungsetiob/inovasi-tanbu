        <div class="container-fluid" id="createForm">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Inovasi</h1>
                <a href="{{ route('inovasi.create') }}" class="btn btn-sm btn-primary shadow-sm {{ (request()->is('data/inovasi')) ? 'd-none' : '' }}"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Add Proposal</a>
            </div>
            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Proposals</h6>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success data-dismiss alert-dismissible">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                        @php
                        Session::forget('error');
                        @endphp
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="38%">Nama Inovasi</th>
                                    <th width="10%">Jenis</th>
                                    <th>Uji Coba</th>
                                    <th>Implementasi</th>
                                    <th>Skor</th>
                                    <th width="8%">Tahapan</th>
                                    <th width="4%">Bukti Dukung</th>
                                    <th width="17%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- server side dataTable gan -->
                            </tbody>
                            <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                                <span id="success-message"></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div id="error-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
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
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<x-logout/>
<script>
    var dataTable;
    $(document).ready(function () {
        // Make an AJAX request to loadProposals
        $.ajax({
            url: '/api/inovasi',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // Initialize DataTable with the fetched data
                dataTable = $('#dataTable').DataTable({
                    data: response.data,
                    columns: [
                        { data: 'proposal.nama' },
                        { 
                            data: 'category',
                            render: function (data, type, row) {
                                var badgeCategory = '';
                                if (data == 'Digital') {
                                    badgeCategory = 'bg-gradient-warning';
                                } else if (data == 'Non Digital') {
                                    badgeCategory = 'bg-gradient-dark';
                                }

                                return '<span class="badge ' + badgeCategory + '">' + data + '</span>';
                            }
                        },
                        { data: 'ujicoba' },
                        { data: 'implementasi' },
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
                                // Create a link for "Bukti Dukung" based on the proposal id
                                return '<a href="{{url("bukti-dukung")}}/' + data + '" class="btn btn-outline-primary btn-sm mt-1"><i class="fas fa-folder-closed"></i></a>';
                            }
                        },
                        { 
                            data: 'proposal.id',
                            render: function (data, type, row) {
                                var buttonsHtml = '<div class="text-center">';
                                buttonsHtml += '<a href="{{url("print/report")}}/' + data + '" target="_blank" class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak"><i class="fas fa-file-alt"></i></a>';
                                if (row.proposal.status === 'draft') {
                                    buttonsHtml += '<button id="hapus-' + data + '" class="delete-button btn btn-outline-danger btn-sm mr-1 mt-1" title="Hapus" data-toggle="modal" data-target="#deleteModal" data-proposal-id="' + data + '" data-proposal-name="' + row.proposal.nama + '"><i class="fas fa-trash"></i></button>';
                                    buttonsHtml += '<a id="edit-' + data + '" href="{{ url("proyek/inovasi") }}/' + data + '/edit" class="btn btn-outline-success btn-sm mr-1 mt-1" title="Edit"><i class="fas fa-pencil-alt" alt="edit"></i></a>';
                                    if (row.skor > 0) {
                                        buttonsHtml += '<button id="send-proposal-' + data + '" data-toggle="modal" data-target="#sendModal" data-proposal-name="' + row.proposal.nama + '" data-proposal-id="' + data + '" class="send-proposal btn btn-outline-dark btn-sm mr-1 mt-1" title="Kirim"><i class="fas fa-paper-plane"></i></button>';
                                    }
                                }

                                buttonsHtml += '</div>';

                                return buttonsHtml;
                            }
                        },
                    ],
                    rowId: function (row) {
                        return 'index_' + row.proposal.id;
                    },
                });
            },
            error: function (error) {
                console.error('Error fetching proposals:', error);
            }
        });
    });
</script>
@include ('components.modal-send-proposal')
@include ('components.modal-delete-proposal')