{{-- Add bukti dukung Modal --}}
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
                    <input type="hidden" class="form-control" id="proposal_id" name="proposal_id" value="{{$proposal->id}}">
                    <input type="hidden" class="form-control" id="proposal_user_id" name="proposal_user_id" value="{{$proposal->user_id}}">
                    <label for="indikator">Indikator</label>
                    <div class="form-group">
                        <input type="text" id="indikator" class="form-control" readonly>
                    </div>
                    <label for="informasi">Deskripsi bukti</label>
                    <div class="form-group">
                        <input type="text" name="informasi" id="informasi" class="form-control">
                        <p class="text-danger d-none" id="alert-informasi"></p>
                    </div>
                    <label for="bukti">Informasi</label>
                    <div class="form-group">
                        <select name="bukti" id="bukti" class="select selectized">
                            <option value="">Pilih bukti</option>
                            {{--@foreach ($buktis as $bukti)
                            <option value="{{ $bukti->id }}" {{ old('bukti') == $bukti->id ? 'selected' : ''}}>{{ $bukti->nama }} - bobot {{ $bukti->bobot}}</option>
                            @endforeach--}}
                        </select>
                        <p class="text-danger d-none" id="alert-bukti"></p>
                    </div>
                    <label for="bFile">File bukti</label>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                    Browse<input accept=".png, .jpg, .jpeg, .pdf" id="bFile" type="file" style="display: none;" name="file">
                                </span>
                            </label>
                            <input id="file" type="text" class="form-control" readonly placeholder="Choose a file">
                        </div> 
                        <p class="text-danger d-none" id="alert-file"></p>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button id="upload" type="submit" class="btn btn-primary">Upload</button>
                    <button id="loading" type="submit" class="btn btn-primary d-none" disabled><i class="fa-solid fa-circle-notch fa-spin"></i></button>
                </form>
            </div> 
        </div>
    </div>
</div>
<script>
    document.getElementById('bFile').onchange = function () {
        document.getElementById('file').value = this.value;
    }
    $('body').on('click', '.btn-add', function () {

        let indikator_id = $(this).data('id');
        var selectize = $('#bukti')[0].selectize;
        if (selectize) {
            selectize.destroy();
        }

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
                $('#bukti').selectize({
                    sortField: 'text'
                });
            }
        });
    });

    $('#uploadForm').submit(function (e) {
        e.preventDefault();
        $('#upload').addClass('d-none');
        $('#loading').removeClass('d-none');
        
        var formData = new FormData(this);

        $.ajax({
            //url: '{{ url("/upload/file") }}',
            url: "/upload/file",
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            success: function (response) {
                var id = $('#proposal_id').val();
                var reloadUrl = '{{ url("/bukti-dukung") }}/' + id;
                
                // Reload the table
                $("#files-table").load(reloadUrl + " #files-table");

                // Close modal and clear input fields
                $('#uploadFile').modal('hide');
                $('#informasi').val('');
                $('#bukti').val('');
                $('#bFile').val('');
                $('#file').val('');

                $('#success-modal').modal('show');
                $('#success-message').text(response.message);
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                }, 3900);

                $('#upload').removeClass('d-none');
                $('#loading').addClass('d-none');

                $('.text-danger').addClass('d-none').empty();
                $('.is-invalid').removeClass('is-invalid');
            },
            error: function (error) {
                if (error.status === 422) { 
                    $('#upload').removeClass('d-none');
                    $('#loading').addClass('d-none');
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field;
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('d-block');
                        $('#' + field).html(errors[0]).addClass('is-invalid');
                        if (field === 'bukti') {
                            $('.selectize-control').addClass('is-invalid');
                        }
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