<div class="modal fade" id="addWinner" tabindex="-1" aria-labelledby="winnerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiLabel">Input Pemenang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="uploadForm" hx-disable>
                    @csrf
                    <div class="form-group">
                        <label for="pengusul">Pengusul</label>
                        <input type="text" name="pengusul" class="form-control" id="pengusul" placeholder="Masukkan nama pengusul inovasi" autocomplete="off">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-pengusul"></div>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="">Pilih kategori</option>
                            <option value="skpd">SKPD</option>
                            <option value="nonskpd">Non SKPD</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kategori"></div>  
                    </div>
                    <div class="form-group">
                        <label for="proposal">Indikator</label>
                        <select name="proposal" id="proposal" class="form-control">
                            <option value="" disabled selected>Pilih inovasi pemenang</option>
                            @foreach ($proposals as $prop)
                            <option value="{{ $prop->id }}" {{ old('prop') == $prop->id ? 'selected' : ''}}>{{ $prop->nama }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-proposal"></div>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button id="simpan-winner" type="submit" hx-headers="hx-disable: true" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#proposal').selectize({
            sortField: 'id'
        });
    });

    $('#uploadForm').submit(function (e) {
        e.preventDefault();

        $('#simpan-winner').prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin"></i> Saving...');
        
        var formData = new FormData(this);

        $.ajax({
            url: '/winner/store',
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            success: function (response) {
                // Close modal and clear input fields
                $('#addWinner').modal('hide');
                $('.modal-backdrop').remove();
                $('#pengusul').val('');
                $('#kategori').val('');
                var indikatorSelectize = $('#proposal')[0].selectize;
                indikatorSelectize.clear();

                $('#simpan-winner').prop('disabled', false).html('Save');
                $('.alert').removeClass('show').addClass('d-none');
                $('#success-modal').modal('show');
                $('#success-message').text(response.message);
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                    $('.modal-backdrop').remove();
                }, 3900);
                
                var newData = {
                    render: function (data, type, row, meta) {
                        return meta.row + 1 + '.';
                    },
                    id: response.data.id,
                    pengusul: response.data.pengusul,
                    proposal: response.proposal,
                    kategori:response.data.kategori,
                    buttons: `
                        <button type="button" class="btn btn-outline-success btn-sm edit-button" title="edit" 
                            data-toggle="modal" 
                            data-target="#updateModal" 
                            data-winner-id="${response.data.id}"
                            data-proposal-id="${response.data.proposal.id}"
                            data-bukti-name="${response.data.pengusul}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    `,
                    rowId: function (row) {
                         return row.id;
                    },
                };
                //table.ajax.reload(null, false);
                var newRow = $('#winnerTable').DataTable().row.add(newData).draw(false).node();
            },
            error: function (error) {
                if (error.status === 422) {
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field;
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('show');
                    });
                    $('#simpan-winner').prop('disabled', false).html('Save');
                    console.log(error);
                } else {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
            }
        });
    });

</script>
