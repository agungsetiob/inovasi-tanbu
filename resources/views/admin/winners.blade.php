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
                                        <th width="35%">Pengusul</th>
                                        <th width="40%">Inovasi</th>
                                        <th width="10%">Kategori</th>
                                        <th width="5%">Tahun</th>
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
            url: '/api/winners',
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
                data: 'tahun' 
            },
            { 
                render: function (data, type, row) {
                    return `
                        <form method="POST" action="/winners/${row.id}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm delete-button" title="delete" 
                                data-winner-id="${row.id}"
                                data-proposal-id="${row.proposal.id}"
                                data-bukti-pengusul="${row.pengusul}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    `;
                }
            },
        ],
        "initComplete": function(settings, json) {
            htmx.process('#winnerTable');
        },
        rowId: function(row) {
            return row.id;
        },
    });

    document.body.addEventListener("reloadWinner", function(evt){
        dataTable.ajax.reload(function() {
            htmx.process('#winnerTable');
        }, false);
    });

    // Attach the event listener using event delegation
    document.addEventListener('submit', function(event) {
        if (event.target.matches('.delete-form')) {
            event.preventDefault();

            const form = event.target;
            const button = form.querySelector('button');
            button.disabled = true;
            button.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`;

            const formData = new FormData(form);
            const action = form.getAttribute('action');
            const method = form.getAttribute('method');

            fetch(action, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const rowId = `#${form.closest('tr').id}`;
                    dataTable.row(rowId).remove().draw(false); // Remove row from DataTable
                } else {
                    alert('Failed to delete the winner');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the winner');
            });
        }
    });
</script>

@include('components.winner-modal.modal-add-winner')
@endfragment
@endsection