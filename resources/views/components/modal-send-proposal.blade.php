<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Inovasi <span id="proposal-name-modal" style="color: #0061f2;"></span> akan dikirim kepada admin. Tekan tombol kirim apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="send-proposal" class="btn btn-outline-primary" title="kirim"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
        </div>
    </div>
</div>
</div>
<script>
    // $(document).ready(function() {
    //     var proposalId;

    //     // When any button with the "send-proposal" class is clicked
    //     $(document).on("click",".send-proposal",function() {
    //         proposalId = $(this).data("proposal-id");
    //         var proposalName = $(this).data("proposal-name");
    //         $("#proposal-name-modal").text(proposalName);
    //     });

    //     // When the "Kirim" button in the modal is clicked
    //     $("#send-proposal").click(function() {
    //         $.ajax({
    //             url: "/send/inovasi/" + proposalId,
    //             type: 'PUT',
    //             data: {
    //                 _token: "{{ csrf_token() }}"
    //             },
    //             success: function(response) {
    //                 if (response.success) {
    //                     $('#success-alert').removeClass('d-none').addClass('show');
    //                     $('#success-message').text(response.success);
    //                     $('#error-alert').addClass('d-none');
    //                     $(".send-proposal[data-proposal-id='" + proposalId + "']").remove();
    //                     $("#edit-" + proposalId).remove();
    //                     $("#hapus-" + proposalId).remove();
    //                     $('#sendModal').modal('hide');
    //                     $(".modal-backdrop").remove();
    //                 }
    //             },
    //             error: function(error) {
    //                 $('#error-message').text(error.status + ' ' + error.responseJSON.message);
    //                 $('#error-alert').removeClass('d-none').addClass('show');
    //             }
    //         });
    //     });
    // });

    $(document).ready(function () {
        var proposalId;

        // When any button with the "send-proposal" class is clicked
        $(document).on("click", ".send-proposal", function () {
            proposalId = $(this).data("proposal-id");
            var proposalName = $(this).data("proposal-name");
            $("#proposal-name-modal").text(proposalName);

            // Hide any previous error messages
            $('#error-alert').addClass('d-none').removeClass('show');
        });

        // When the "Kirim" button in the modal is clicked
        $("#send-proposal").click(function () {
            var $button = $(this);

            // Show loading spinner
            $button.html('<i class="fas fa-spinner fa-spin"></i> Mengirim...').prop('disabled', true);

            $.ajax({
                url: "/send/inovasi/" + proposalId,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text(response.success);
                        $('#error-alert').addClass('d-none');
                        $(".send-proposal[data-proposal-id='" + proposalId + "']").remove();
                        $("#edit-" + proposalId).remove();
                        $("#hapus-" + proposalId).remove();
                        $('#sendModal').modal('hide');
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