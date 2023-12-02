<!-- Add Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="buktiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiLabel">Tambah Jenis Bukti inovasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="uploadForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Bukti inovasi (parameter)</label>
                        <input type="text" name="nama" class="form-control" id="name" required placeholder="Masukkan nama bukti inovasi" autocomplete="off">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="skor">Bobot</label>
                        <input type="number" step="any" name="bobot" class="form-control" id="skor" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-bobot"></div>  
                    </div>
                    <div class="form-group">
                        <label for="indikator">Indikator</label>
                        <select name="indikator" id="indikator" class="form-control" required>
                            <option value="">Pilih satuan indikator</option>
                            @foreach($indikators as $indikator)
                            <optgroup label="{{ $indikator->jenis }}">
                                <option value="{{ $indikator->id }}">{{ $indikator->nama }}</option>
                            </optgroup>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-indikator"></div>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button id="simpan-bukti" type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#indikator').selectize({
            sortField: 'id'
        });
    });

    $('#uploadForm').submit(function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);

        $.ajax({
            url: '/master/bukti',
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            success: function (response) {
                // Close modal and clear input fields
                $('#addCategory').modal('hide');
                $('.modal-backdrop').remove();
                $('#name').val('');
                $('#skor').val('');
                var indikatorSelectize = $('#indikator')[0].selectize;
                indikatorSelectize.clear();

                $('#success-modal').modal('show');
                $('#success-message').text(response.message);
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                    $('.modal-backdrop').remove();
                }, 3900);
                
                var dataTable = $('#buktiTable').DataTable();
                dataTable.ajax.reload(null, false);
            },
            error: function (error) {
                if (error.status === 422) {
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field;
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('show');
                    });
                } else {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
            }
        });
    });

</script>
