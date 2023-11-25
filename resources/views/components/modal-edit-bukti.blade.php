<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="buktiLabelEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiLabelEdit">Edit Jenis Bukti inovasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="editForm">
                    @csrf
                    @method ('PUT')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="bukti_id" id="bukti-id">
                        <label for="name">Bukti inovasi (parameter)</label>
                        <input type="text" name="nama" class="form-control" id="name-edit" required placeholder="Masukkan nama bukti inovasi" autocomplete="off">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="skor">Bobot</label>
                        <input type="number" step="any" name="bobot" class="form-control" id="skor-edit" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-bobot-edit"></div>  
                    </div>
                    <div class="form-group">
                        <label for="indikator">Indikator</label>
                        <select name="indikator" id="indikator-edit" class="form-control" required>
                            <option value="">Pilih satuan indikator</option>
                            @foreach($indikators as $indikator)
                            <optgroup label="{{ $indikator->jenis }}">
                                <option value="{{ $indikator->id }}">{{ $indikator->nama }}</option>
                            </optgroup>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-indikator-edit"></div>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button id="edit-bukti" type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#indikator-edit').selectize({
            sortField: 'text'
        });
    });


    $('body').on('click', '.edit-button', function () {
        let nama_edit = $(this).data('bukti-name');
        let skor_edit = $(this).data('bobot');
        let indikator_id = $(this).data('indikator-id');
        let bukti_id = $(this).data('bukti-id');

        $('#name-edit').val(nama_edit);
        $('#skor-edit').val(skor_edit);
        $('#indikator-edit').val(indikator_id);
        $('#bukti-id').val(bukti_id);

        var indikatorEditSelect = $('#indikator-edit')[0].selectize;
        indikatorEditSelect.setValue(indikator_id);
    });


    $('#editForm').submit(function (e) {
        e.preventDefault();

        var bukti_id = $('#bukti-id').val();
        var formData = new FormData(this);

        $.ajax({
            url: '/master/bukti/' + bukti_id,
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            success: function (response) {
                var table = $('#dataTable').DataTable();
                var newData = {
                    render: function (data, type, row, meta, klas) {
                        return meta.row + 1 + '.';
                    },
                    id: response.data.id,
                    nama: response.data.nama,
                    bobot: response.data.bobot,
                    status: response.data.status,
                    indikator: response.indikator,
                    buttons: getButtonsHtml(response),
                };

                table.ajax.reload(null, false);

                $('#updateModal').modal('hide');
                showSuccessModal(response.message);
            },
            error: function (error) {
                handleAjaxError(error);
            }
        });
    });

    // Extracted the button creation logic to a separate function
    function getButtonsHtml(response) {
        return `
        <button type="button" class="btn btn-outline-success btn-sm edit-button" title="hapus" 
        data-toggle="modal" 
        data-target="#updateModal" 
        data-bukti-id="${response.data.id}"
        data-indikator-id="${response.indikator.id}"
        data-bukti-name="${response.data.nama}"
        data-bobot="${response.data.bobot}">
        <i class="fas fa-pencil-alt"></i>
        </button>
        <button type="button" class="btn btn-outline-danger btn-sm delete-button" 
        data-bukti-id="${response.data.id}"
        data-bukti-name="${response.data.nama}" 
        title="hapus">
        <i class="fas fa-trash"></i>
        </button>
        <div class="dropdown mb-4 d-inline">
        <button
        class="btn btn-outline-primary dropdown-toggle btn-sm"
        type="button"
        id="dropdownMenuButton"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        data-bukti-id="${response.data.id}"
        data-bukti-status="${response.data.status}">
        ${response.data.status}
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <button class="dropdown-item" data-action="toggle-status">change status</button>
        </div>
        </div>
        `;
    }

    // Extracted success modal handling to a separate function
    function showSuccessModal(message) {
        $('#success-modal').modal('show');
        $('#success-message').text(message);
        setTimeout(function () {
            $('#success-modal').modal('hide');
        }, 3900);
    }

    // Extracted error handling to a separate function
    function handleAjaxError(error) {
        if (error.status === 422) {
            $.each(error.responseJSON.errors, function (field, errors) {
                let alertId = 'alert-' + field + '-edit';
                $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('show');
            });
        } else {
            $('#error-message').text(error.status + ' ' + error.responseJSON.message);
            $('#error-modal').modal('show');
        }
    }

</script>
