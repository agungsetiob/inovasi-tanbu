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
        <div class="modal-body">SKPD <span id="skpd-name" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-skpd" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var skpdId;

        $(document).on("click",".delete-button",function() {
            skpdId = $(this).data("skpd-id");
            var skpdName = $(this).data("skpd-name");
            $("#skpd-name").text(skpdName);
        });

        $("#delete-skpd").click(function() {
            $.ajax({
                url: '/master/skpd/' + skpdId,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        $('#success-modal').modal('show');
                        $('#success-message').text(response.message);
                        var row = dataTable.row(function (idx, data, node) {
                            return data.id === skpdId;
                        });
                        row.remove().draw(false);
                        $('#deleteModal').modal('hide');
                        setTimeout(function() {
                            $('#success-modal').modal('hide');
                        }, 3700);
                    }
                },
                error: function(error) {
                    $('#deleteModal').modal('hide');
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
            });
        });
    });
</script>
