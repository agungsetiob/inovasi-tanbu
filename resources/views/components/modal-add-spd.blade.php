<!-- Add Modal -->
<div class="modal fade" id="uploadFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <input type="hidden" class="form-control" name="indikator_id" id="indikator_id">
                    <input type="hidden" class="form-control" id="profile_id" name="profile_id" value="{{$profile->id}}">
                    <label for="indikator">Indikator</label>
                    <div class="form-group">
                        <input type="text" id="indikator" class="form-control" readonly>
                    </div>
                    <label for="informasi">Informasi</label>
                    <div class="form-group">
                        <input type="text" name="informasi" id="informasi" class="form-control">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-informasi"></div>
                    </div>
                    <label for="bukti">Bukti (Parameter)</label>
                    <div class="form-group">
                        <select name="bukti" id="bukti" class="select form-control @error('bukti') is-invalid @enderror">
                            <option value="">Pilih bukti</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-bukti"></div>
                    </div>
                    <label for="bFile">File bukti</label>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                    Browse<input accept=".pdf, .mp4, .avi" id="bFile" type="file" style="display: none;" name="file">
                                </span>
                            </label>
                            <input id="uFile" type="text" class="form-control @error('file') is-invalid @enderror" readonly placeholder="Choose a file">
                        </div> 
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-file"></div> 
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button id="upload" type="submit" class="btn btn-primary">Upload</button>
                    <button id="loading" type="submit" class="btn btn-primary d-none"><i class="fa-solid fa-circle-notch fa-spin"></i></button>
                </form>
            </div> 
        </div>
    </div>
</div>
<script>
    document.getElementById('bFile').onchange = function () {
        document.getElementById('uFile').value = this.value;
    }

    $('body').on('click', '.btn-add', function () {

        var indikator_id = $(this).data('in-id');

        $.ajax({
            url: `/bukti-dukung/add/${indikator_id}`,
            type: "GET",
            cache: false,
            success:function(response){
                    //fill data to form
                $('#indikator_id').val(response.data.id);
                $('#indikator').val(response.data.nama);
                $('#bukti').empty();
                $('#bukti').append('<option value="">Pilih bukti</option>');
                $.each(response.bukti, function (index, bukti) {
                    $('#bukti').append('<option value="' + bukti.id + '">' + bukti.nama + ' (bobot: ' + bukti.bobot + ')</option>');
                });
                $('#uploadFile').modal('show');

            }
        });
    });

    $('#uploadForm').submit(function (e) {
        e.preventDefault();
        $('#upload').addClass('d-none');
        $('#loading').removeClass('d-none');
        
        var formData = new FormData(this);

        $.ajax({
            url: '{{ url("/upload/spd") }}',
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            success: function (response) {
                var id = $('#profile_id').val();
                var reloadUrl = '{{ url("/indikator/spd") }}/' + id;
                
                // Reload the table
                $("#files-table").load(reloadUrl + " #files-table");

                // Close modal and clear input fields
                $('#uploadFile').modal('hide');
                $('#informasi').val('');
                $('#bukti').val('');
                $('#bFile').val('');
                $('#uFile').val('');

                $('#success-modal').modal('show');
                $('#success-message').text(response.message);
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                }, 3900);

                $('#upload').removeClass('d-none');
                $('#loading').addClass('d-none');
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
                    $('#upload').removeClass('d-none');
                    $('#loading').addClass('d-none');
                }
            }
        });
    });

</script>