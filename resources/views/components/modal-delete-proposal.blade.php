<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Proposal <span id="proposal-name" style="color: #0061f2;"></span> akan dihapus. Tekan tombol hapus apabila anda sudah yakin.</div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-proposal" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var proposalId;

        $(document).on("click",".delete-button",function() {
            proposalId = $(this).data("proposal-id");
            var proposalName = $(this).data("proposal-name");
            $("#proposal-name").text(proposalName);

        });

        // Ketika tombol "Kirim" di modal diklik
        $("#delete-proposal").click(function() {
            $.ajax({
                url: `/proyek/inovasi/` + proposalId,
                type: 'DELETE',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text('Berhasil menghapus proposal');
                        $('#error-alert').addClass('d-none');
                        var row = dataTable.row(function (idx, data, node) {
                            return data.proposal.id === proposalId;
                        });
                        row.remove().draw(false);
                        $('#deleteModal').modal('hide');
                        setTimeout(function() {
                            $('#success-alert').addClass('d-none').removeClass('show');
                        }, 4700);
                    }
                },
                error: function(error) {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-alert').removeClass('d-none').addClass('show');
                }
            });
        });
    });
</script>