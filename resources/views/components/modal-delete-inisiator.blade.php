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
        <div class="modal-body">Inisiator inovasi <span id="inisiator-name" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-inisiator" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var inisiatorId;

        $(".delete-button").click(function() {
            inisiatorId = $(this).data("inisiator-id");
            var inisiatorName = $(this).data("inisiator-name");
            $("#inisiator-name").text(inisiatorName);
        });

        $("#delete-inisiator").click(function() {
            $.ajax({
                url: '/master/inisiator/' + inisiatorId,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text(response.message);
                        $('#error-alert').addClass('d-none');
                        $('#index_' + inisiatorId).remove();
                        $('#deleteModal').modal('hide');
                    }
                },
                error: function(response) {
                    $('#error-message').text(response.message);
                    $('#error-alert').removeClass('d-none').addClass('show');
                }
            });
        });
    });
</script>
