<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" hx-history="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Inovasi <span id="proposal-name-modal" style="color: #0061f2;"></span> akan
                dikembalikan kepada pengirim. Tekan tombol kirim apabila anda sudah yakin.</div>
            <div class="modal-body">
                <label for="desc">Catatan</label>
                <div class="form-group">
                    <input type="text" name="desc" id="desc" class="form-control" hx-history="false">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-desc"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i
                        class="fa-solid fa-ban"></i> Cancel</button>
                <button id="return-proposal" class="btn btn-outline-primary" title="kirim"><i
                        class="fa-solid fa-paper-plane"></i> Kirim</button>
            </div>
        </div>
    </div>
</div>
<script hx-history="false">
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
            var desc = $("#desc").val();

            $.ajax({
                url: "/send/inovasi/" + proposal_id,
                type: 'PUT',
                data: {
                    desc: "desc",
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {

                        if (desc) {
                            $.ajax({
                                url: "{{url('note/create')}}",
                                type: 'POST',
                                data: {
                                    "proposal_id": proposal_id,
                                    "desc": desc,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (notesResponse) {
                                    console.log("Notes successfully posted:", notesResponse);
                                },
                                error: function (notesError) {
                                    console.error("Error posting notes:", notesError);
                                }
                            });
                        }

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
                    console.log(error);
                    $('#error-alert').removeClass('d-none').addClass('show');
                },
                complete: function () {
                    $button.html('<i class="fa-solid fa-paper-plane"></i> Kirim').prop('disabled', false);
                }
            });
        });
    });
</script>