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
        <div class="modal-body">Urusan <span id="urusan-name" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-urusan" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var urusanId;

        $(".container-fluid").on("click", ".delete-button", function() {
            urusanId = $(this).data("urusan-id");
            var urusanName = $(this).data("urusan-name");
            $("#urusan-name").text(urusanName);
        });

        $("#delete-urusan").click(function() {
            $.ajax({
                url: '/master/urusan/' + urusanId, // Correct the URL path
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }, // Use headers to send CSRF token
                success: function(response) {
                    if (response.success) {
                        $('#success-modal').modal('show');
                        $('#success-message').text(response.message);
                        $('#error-alert').addClass('d-none');
                        var row = dataTable.row(function (idx, data, node) {
                            return data.id === urusanId;
                        });
                        row.remove().draw();
                        $('#deleteModal').modal('hide');
                    }
                },
                error: function(error) {
                    $('#error-message').text(error.status+'-'+error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
            });
        });
    });
</script>
