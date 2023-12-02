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
                <form action="#" method="POST" id="editForm" hx-disable>
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
                    <button id="edit-bukti" type="submit" class="btn btn-primary" hx-headers="hx-disable: true">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#indikator-edit').selectize({
            sortField: 'id'
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
                var table = $('#buktiTable').DataTable();
                table.ajax.reload(null, false);

                $('#updateModal').modal('hide');
                showSuccessModal(response.message);
            },
            error: function (error) {
                handleAjaxError(error);
            }
        });
    });

    // Extracted success modal handling to a separate function
    function showSuccessModal(message) {
        $('#success-modal').modal('show');
        $('#success-message').text(message);
        setTimeout(function () {
            $('#success-modal').modal('hide');
            $('.modal-backdrop').remove();
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
            $('#updateModal').modal('hide');
        }
    }

</script>
