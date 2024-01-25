<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proposal-with-note"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th with="5%" scope="col">No</th>
                            <th with="80%" scope="col">Catatan</th>
                            <th with="15%" scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="notes">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var proposalId;

        $(document).on("click", ".note-button", function () {
            proposalId = $(this).data("proposal-id");
            var proposalName = $(this).data("proposal-name");
            $("#proposal-with-note").text(proposalName);

            $.ajax({
                type: "GET",
                url: "/notes/" + proposalId,
                success: function (notes) {
                    updateModalBody(notes);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching notes:", error);
                }
            });
        });

        function updateModalBody(notes) {
            var tbody = $("#notes");
            tbody.empty();
            $.each(notes, function (index, note) {
                var formattedDate = new Date(note.created_at).toLocaleDateString("id-ID");

                var row = "<tr><td scope='row'>" + (index + 1) + "." + "</td><td>" + note.desc + "</td><td>" + formattedDate + "</td></tr>";
                tbody.append(row);
            });
        }
    });
</script>