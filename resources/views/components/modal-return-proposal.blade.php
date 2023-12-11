<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Inovasi <span id="proposal-name-modal" style="color: #0061f2;"></span> akan dikembalikan kepada pengirim. Tekan tombol kirim apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="return-proposal" class="btn btn-outline-primary" title="kirim"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        var proposal_id;

        $(document).on("click", ".return-proposal", function () {
            proposal_id = $(this).data("proposal-id");
            var proposalName = $(this).data("proposal-name");
            $("#proposal-name-modal").text(proposalName);
        });

        $(document).on("click", "#return-proposal", function () {
            // Show loading spinner
            var $button = $(this);
            $button.html('<i class="fas fa-spinner fa-spin"></i> Mengirim...').prop('disabled', true);

            $.ajax({
                url: "/send/inovasi/" + proposal_id,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text('Berhasil mengembalikan proposal');
                        $('#error-alert').addClass('d-none');

                        var row = databaseTable.row(function (idx, data, node) {
                            return data.proposal.id === proposal_id;
                        });
                        row.remove().draw(false);

                        $('#returnModal').modal('hide');
                        $(".modal-backdrop").remove();
                    }
                },
                error: function (error) {
                    var errorMessage = 'An error occurred while sending the proposal.';
                    if (error.responseJSON && error.responseJSON.message) {
                        errorMessage = error.responseJSON.message;
                    }

                    $('#error-message').text(errorMessage);
                    $('#error-alert').removeClass('d-none').addClass('show');
                },
                complete: function () {
                    // Hide loading spinner and reset button text
                    $button.html('<i class="fa-solid fa-paper-plane"></i> Kirim').prop('disabled', false);
                }
            });
        });
    });
</script>
