<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Tahapan inovasi <span id="tahapan-name" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-tahapan" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var tahapanId;

        $(".delete-button").click(function() {
            tahapanId = $(this).data("tahapan-id");
            var tahapanName = $(this).data("tahapan-name");
            $("#tahapan-name").text(tahapanName);
        });

        $("#delete-tahapan").click(function() {
            $.ajax({
                url: '/master/tahapan/' + tahapanId,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text(response.message);
                        $('#error-alert').addClass('d-none');
                        $('#index_' + tahapanId).remove();
                        $('#deleteModal').modal('hide');
                        setTimeout(function() {
                            $('#success-alert').addClass('d-none').removeClass('show');
                        }, 3700);
                    }
                },
                error: function(error) {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-alert').removeClass('d-none').addClass('show');
                }
            });
        });
    });
</script>
