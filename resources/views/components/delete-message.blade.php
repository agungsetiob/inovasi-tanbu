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
        <div class="modal-body">Pesan dari <span id="message-name" style="color: #0061f2;"></span> <span id="message-id" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-message" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var messageId;
        var messageName;

        $(document).on("click",".delete-button",function(){
            messageId = $(this).data("message-id");
            messageName = $(this).data("message-name");
            $("#message-name").text(messageName);
        });

        $("#delete-message").click(function() {
            $.ajax({
                url: '/delete/message/' + messageId,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text(response.message);
                        $('#error-alert').addClass('d-none');
                        $('#index_' + messageId).remove();
                        $('#deleteModal').modal('hide');
                    }
                },
                error: function(response) {
                    $('#error-message').text('Gagal menghapus pesan');
                    $('#error-alert').removeClass('d-none').addClass('show');
                }
            });
        });
    });
</script>
