<!-- Add Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="bentukLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bentukLabel">Tambah bentuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">nama bentuk</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan bentuk inovasi">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
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

            url: `/master/bentuk`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "_token": token
            },
            success:function(response){
                //data bentuk
                $('#success-modal').modal('show');
                $('#success-message').text(response.message);

                let bentuk = `
                <tr id="index_${response.data.id}">
                <td>${response.data.id}</td>
                <td>${response.data.nama}</td>
                <td>${response.data.created_at}</td>
                <td>
                    <button class="btn btn-outline-danger btn-sm delete-button" title="hapus" data-toggle="modal" data-target="#deleteModal"
                        data-bentuk-id="${response.data.id}"
                        data-bentuk-name="${response.data.nama}"><i class="fas fa-trash"></i></button>
                    <div class="dropdown mb-4 d-inline">
                        <button
                            class="btn btn-outline-primary dropdown-toggle btn-sm"
                            type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-bentuk-id="${response.data.id}"
                            data-bentuk-status="${response.data.status}">
                            ${response.data.status}
                        </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" data-action="toggle-status">change status</button>
                    </div>
                    </div>
                </td>
                </tr>
                `;                
                //append to table
                $('#tabel-bentuk').append(bentuk);
                $('#alert-nama').removeClass('show').addClass('d-none');
                
                //clear form
                $('#nama').val('');
                $('#addCategory').modal('hide');
                
            },
            error:function(error){

                if(error.responseJSON && error.responseJSON.nama && error.responseJSON.nama[0]) {

                    //show alert
                    $('#alert-nama').removeClass('d-none');
                    $('#alert-nama').addClass('d-block');

                    //add message to alert
                    $('#alert-nama').html(error.responseJSON.nama[0]);
                } else {
                    $('#error-message').text('An error occurred.');
                    $('#error-modal').modal('show');
                }

            }
        });
    });
</script>