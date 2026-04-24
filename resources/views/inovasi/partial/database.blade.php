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
            <div class="table-responsive" hx-history="false">
                <table class="table table-borderless table-striped" id="databaseInovasi" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="30%">Nama Inovasi</th>
                            <th>SKPD</th>
                            <th>Dikirim</th>
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
<x-logout />
<script type="text/javascript">
    var databaseTable = $('#databaseInovasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/api/database/inovasi',
            type: 'GET',
            dataSrc: 'data'
        },
        order: [[2, 'desc']],
        columns: [
            { data: 'proposal.nama', name: 'nama' },
            {
                data: 'skpd',
                name: 'skpd_id',
                render: function (data) {
                    return (data === 'Non SKPD-Masyarakat-Sekolah')
                        ? '<p class="text-success mb-0">' + data + '</p>'
                        : data;
                }
            },
            { data: 'dikirim', name: 'updated_at', className: 'text-center' },
            { data: 'ujicoba', name: 'ujicoba', className: 'text-center' },
            { data: 'implementasi', name: 'implementasi', className: 'text-center' },
            { data: 'skor', name: 'total_skor', className: 'text-center' },
            {
                data: 'tahapan',
                name: 'tahapan_id',
                className: 'text-center',
                render: function (data) {
                    var badgeClass = (data === 'ujicoba') ? 'bg-indigo' :
                        (data === 'implementasi') ? 'bg-green' :
                            (data === 'inisiatif') ? 'bg-orange' : 'bg-secondary';
                    return '<span class="badge ' + badgeClass + '">' + (data || '-') + '</span>';
                }
            },
            {
                data: 'proposal.id',
                orderable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return (row.skor > 0)
                        ? '<a hx-get="{{ url("bukti-dukung")}}/' + data + '" hx-trigger="click" hx-target="#app" hx-swap="outerHTML" hx-push-url="true" hx-indicator="#loadingIndicator" class="btn btn-outline-primary btn-sm mt-1"><i class="fas fa-folder-closed"></i></a>'
                        : '';
                }
            },
            {
                data: 'proposal.id',
                orderable: false,
                render: function (data, type, row) {
                    var buttonsHtml = '<div class="text-center">';
                    buttonsHtml += '<a href="{{url("print/report")}}/' + data + '" target="_blank" class="btn btn-outline-secondary btn-sm mr-1 mt-1" title="Cetak"><i class="fas fa-file-alt"></i></a>';
                    buttonsHtml += '<button id="return-proposal-' + row.proposal.id + '" data-proposal-id="' + data + '" data-toggle="modal" data-target="#returnModal" data-proposal-name="' + row.proposal.nama + '" class="return-proposal btn btn-outline-warning btn-sm mt-1" title="Kembalikan"><i class="fa-solid fa-ban"></i></button>';
                    buttonsHtml += '</div>';
                    return buttonsHtml;
                }
            }
        ],
        rowId: function (row) {
            return 'index_' + row.proposal.id;
        },
        initComplete: function () {
            htmx.process('#databaseInovasi');
        },
        drawCallback: function (settings) {
            htmx.process('#databaseInovasi');
        },
        error: function (xhr, error, thrown) {
            console.error('DataTables error:', error, thrown);
            alert('Error loading data. Please try again later.');
        }
    });

    document.body.addEventListener("reloadDatabase", function () {
        databaseTable.ajax.reload(null, false);
    });
</script>
@include ('components.modal-return-proposal')