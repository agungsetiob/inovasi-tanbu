<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Evaluasi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Data <span id="evaluasi-judul" class="text-primary"></span> akan dihapus. <br>Tekan
                tombol hapus apabila anda sudah yakin.
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i
                        class="fa-solid fa-ban"></i> Cancel</button>
                <button id="delete-evaluasi" class="btn btn-outline-danger" title="hapus">
                    <i class="fa-solid fa-trash"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var evaluasiId;

        $(document).on("click", ".delete-evaluasi", function () {
            evaluasiId = $(this).data("evaluasi-id");
            var judul = $(this).data("evaluasi-judul");
            $("#evaluasi-judul").text(judul);
        });

        $("#delete-evaluasi").click(function () {
            var $button = $(this);
            $button.html('<i class="fas fa-spinner fa-spin"></i> Menghapus...').prop('disabled', true);

            $.ajax({
                url: '/list/evaluasi/' + evaluasiId,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                success: function (response) {
                    if (response.success) {
                        $('#success-modal').modal('show');
                        $('#success-message').text(response.message);
                        var row = dataTable.row(function (idx, data, node) {
                            return data.id === evaluasiId;
                        });
                        row.remove().draw(false);
                        $('#deleteModal').modal('hide');
                        setTimeout(function () {
                            $('#success-modal').modal('hide');
                            $('.modal-backdrop').remove();
                        }, 3700);
                    }
                },
                error: function (error) {
                    $('#deleteModal').modal('hide');
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                    $button.prop('disabled', false);
                    $spinner.addClass('d-none');
                    $trash.removeClass('d-none');
                },
                complete: function() {
                    $button.html('<i class="fa-solid fa-trash"></i> Kirim').prop('disabled', false);
                }
            });
        });
    });
</script>