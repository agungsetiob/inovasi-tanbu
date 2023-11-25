<!-- Add Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah tematik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">nama tematik</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan tematik inovasi">
                    <p class="text-danger d-none" role="alert" id="alert-nama"></p>
                </div>
                <button id="store" type="button" class="btn btn-primary">Save</button>
            </div> 
        </div>
    </div>
</div>
<script>
    //action create post
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let nama   = $("#nama").val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/master/tematik`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "_token": token
            },
            success:function(response){
                //data tematik
                $('#success-modal').modal('show');
                $('#success-message').html('<p class="text-success">' + response.data.nama + '</p>' + response.message);

                var newData = {
                    render: function (data, type, row, meta, klas) {
                    return meta.row + 1 + '.';
                    },
                    id: response.data.id,
                    nama: response.data.nama,
                    status: response.data.status,
                    created_at: response.data.created_at,
                    buttons: `
                        <button type="button" class="btn btn-outline-danger btn-sm delete-button" 
                            data-tematik-id="${response.data.id}"
                            data-tematik-name="${response.data.nama}" 
                            title="hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                        <div class="dropdown mb-4 d-inline">
                            <button
                                class="btn btn-outline-primary dropdown-toggle btn-sm"
                                type="button"
                                id="dropdownMenuButton${response.data.id}"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-tematik-id="${response.data.id}"
                                data-tematik-status="${response.data.status}">
                                ${response.data.status}
                            </button>
                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" data-action="toggle-status">change status</button>
                            </div>
                        </div>
                    `,
                    
                };

                var newRow = $('#dataTable').DataTable().row.add(newData).draw().node();

                $('#alert-nama').removeClass('d-block').addClass('d-none');
                $('#nama').removeClass('is-invalid');
                
                //clear form
                $('#nama').val('');
                $('#addCategory').modal('hide');
                $('#empty-tematik').addClass('d-none');
            },
            error:function(error){

                if(error.responseJSON && error.responseJSON.nama && error.responseJSON.nama[0]) {

                    //show alert
                    $('#alert-nama').removeClass('d-none');
                    $('#alert-nama').addClass('d-block');
                    $('#nama').addClass('is-invalid');

                    //add message to alert
                    $('#alert-nama').html(error.responseJSON.nama[0]);
                } else {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }

            }
        });
    });
</script>