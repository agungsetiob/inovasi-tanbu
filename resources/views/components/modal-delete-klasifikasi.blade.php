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
        <div class="modal-body">Klasifikasi urusan <span id="klasifikasi-name" style="color: #0061f2;"></span> akan dihapus. <br>Tekan tombol hapus apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-klasifikasi" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var klasifikasiId;

        $(".container-fluid").on("click", ".delete-button", function() {
            klasifikasiId = $(this).data("klasifikasi-id");
            var klasifikasiName = $(this).data("klasifikasi-name");
            $("#klasifikasi-name").text(klasifikasiName);
        });

        $("#delete-klasifikasi").click(function() {
            $.ajax({
                url: '/master/klasifikasi/' + klasifikasiId, // Correct the URL path
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }, // Use headers to send CSRF token
                success: function(response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text(response.message);
                        $('#error-alert').addClass('d-none');
                        $('#index_' + klasifikasiId).remove();
                        $('#deleteModal').modal('hide');
                    }
                },
                error: function(response) {
                    $('#error-message').text(response.responseJSON.message);
                    $('#error-alert').removeClass('d-none').addClass('show');
                }
            });
        });
    });
</script>
