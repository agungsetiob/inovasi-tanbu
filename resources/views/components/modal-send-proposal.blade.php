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
        <div class="modal-body">Inovasi <span id="proposal-name-modal" style="color: #0061f2;"></span> akan dikirmi kepada admin. Tekan tombol kirim apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="send-proposal" class="btn btn-outline-primary" title="kirim"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var proposalId;

        // When any button with the "send-proposal" class is clicked
        $(document).on("click",".send-proposal",function() {
            proposalId = $(this).data("proposal-id");
            var proposalName = $(this).data("proposal-name");
            $("#proposal-name-modal").text(proposalName);
        });

        // When the "Kirim" button in the modal is clicked
        $("#send-proposal").click(function() {
            $.ajax({
                url: "/send/inovasi/" + proposalId,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text('Berhasil mengirim proposal');
                        $('#error-alert').addClass('d-none');
                        $(".send-proposal[data-proposal-id='" + proposalId + "']").remove();
                        $("#edit-" + proposalId).remove();
                        $("#hapus-" + proposalId).remove();
                        $('#sendModal').modal('hide');
                    }
                },
                error: function(error) {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-alert').removeClass('d-none').addClass('show');
                }
            });
        });
    });


    // $(document).ready(function() {
    //     var proposalId;

    //     $("button[id^='send-proposal-']").click(function() {
    //         var buttonId = $(this).attr("id");
    //         proposalId = buttonId.replace("send-proposal-", "");
    //         var proposalName = $(this).data("proposal-name");
    //         $("#proposal-name-modal").text(proposalName);
    //     });

    //     // Ketika tombol "Kirim" di modal diklik
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
    //                     $('#success-message').text('Berhasil mengirim proposal');
    //                     $('#error-alert').addClass('d-none');
    //                     $("#" + "send-proposal-" + proposalId).remove();
    //                     $("#edit-" + proposalId).remove();
    //                     $("#hapus-" + proposalId).remove();
    //                     $('#sendModal').modal('hide');
    //                 }
    //             },
    //             error: function(error) {
    //                 $('#error-message').text(error.status + ' ' + error.responseJSON.message);
    //                 $('#error-alert').removeClass('d-none').addClass('show');
    //             }
    //         });
    //     });
    // });
</script>