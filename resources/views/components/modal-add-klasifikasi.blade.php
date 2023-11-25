<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah klasifikasi urusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">nama klasifikasi urusan</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan klasifikasi urusan inovasi">
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

            url: `/master/klasifikasi`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "_token": token
            },
            success:function(response){
                //data klasifikasi
                $('#success-alert').removeClass('d-none').addClass('show');
                $('#success-message').text(response.message);

                // Hide error alert if it was shown
                $('#error-alert').addClass('d-none');
                $('#alert-nama').addClass('d-none').removeClass('d-block');

                let klasifikasi = `
                <tr id="index_${response.data.id}">
                <td></td>
                <td>${response.data.nama}</td>
                <td>${response.data.created_at}</td>
                <td>
                    <button class="btn btn-outline-danger btn-sm delete-button" title="hapus" data-toggle="modal" data-target="#deleteModal" data-klasifikasi-id="${response.data.id}" data-klasifikasi-name="${response.data.nama}"><i class="fas fa-trash"></i></button>
                    <div class="dropdown mb-4 d-inline">
                        <button
                            class="btn btn-outline-primary dropdown-toggle btn-sm"
                            type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-klasifikasi-id="${response.data.id}"
                            data-klasifikasi-status="${response.data.status}">
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
                $('#tabel-klasifikasi').append(klasifikasi);
                
                //clear form
                $('#nama').val('');
                $('#addCategory').modal('hide');
                $('#empty').addClass('d-none');
                
            },
            error:function(error){

                if(error.responseJSON && error.responseJSON.nama && error.responseJSON.nama[0]) {

                    //show alert
                    $('#alert-nama').removeClass('d-none');
                    $('#alert-nama').addClass('d-block');

                    //add message to alert
                    $('#alert-nama').html(error.responseJSON.nama[0]);
                }
                $('#error-message').text('An error occurred.');
                $('#error-alert').removeClass('d-none').addClass('show');

                // Hide success alert if it was shown
                $('#success-alert').addClass('d-none');

            }
        });
    });
</script>