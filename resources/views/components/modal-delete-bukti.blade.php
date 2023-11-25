<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Apakah anda yakin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Bukti inovasi <span id="bukti-name" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-bukti" class="btn btn-outline-danger" title="hapus"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var buktiId;

        $(".container-fluid").on("click", ".delete-button", function() {
            buktiId = $(this).data("bukti-id");
            var buktiName = $(this).data("bukti-name");
            $("#bukti-name").text(buktiName);
        });

        $("#delete-bukti").click(function() {
            $.ajax({
                url: '/master/bukti/' + buktiId,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        $('#success-modal').modal('show');
                        $('#success-message').text(response.message);
                        var row = dataTable.row(function (idx, data, node) {
                            return data.id === buktiId;
                        });
                        row.remove().draw(false);
                        $('#deleteModal').modal('hide');
                        setTimeout(function() {
                            $('#success-modal').modal('hide');
                        }, 3900);
                    }
                },
                error: function(response) {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
            });
        });
    });
</script>
