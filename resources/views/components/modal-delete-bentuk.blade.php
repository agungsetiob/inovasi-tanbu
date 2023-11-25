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
        <div class="modal-body">Bentuk inovasi <span id="bentuk-name" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-bentuk" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var bentukId;

        $(".container-fluid").on("click", ".delete-button", function() {
            bentukId = $(this).data("bentuk-id");
            var bentukName = $(this).data("bentuk-name");
            $("#bentuk-name").text(bentukName);
        });

        $("#delete-bentuk").click(function() {
            $.ajax({
                url: '/master/bentuk/' + bentukId, // Correct the URL path
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }, // Use headers to send CSRF token
                success: function(response) {
                    if (response.success) {
                        $('#success-modal').modal('show');
                        $('#success-message').text(response.message);
                        $('#index_' + bentukId).remove();
                        $('#deleteModal').modal('hide');
                    }
                },
                error: function(response) {
                    $('#error-message').text('Gagal menghapus bentuk inovasi');
                    $('#error-modal').modal('show');
                }
            });
        });
    });
</script>
