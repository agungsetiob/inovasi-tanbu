<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah urusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">nama urusan</label>
                        <input type="text" name="nama" class="form-control" id="nama" required placeholder="Masukkan urusan inovasi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>  
                    </div>
                    <div class="form-group">
                    <label for="klasifikasi_id">Klasifikasi</label>
                        <select name="klasifikasi_id" id="klasifikasi_id" class="form-control @error('klasifikasi_id') is-invalid @enderror" required>
                            <option value="">Pilih klasifikasi</option>
                            @foreach ($klasifikasis as $k)
                            <option value="{{ $k->id }}" {{ old('klasifikasi_id') == $k->id ? 'selected' : ''}}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-klasifikasi"></div>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
        let klasifikasi_id = $("#klasifikasi_id").val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({
            url: `/master/urusan`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "klasifikasi_id": klasifikasi_id,
                "_token": token
            },
            success:function(response){
                //dataTable.ajax.reload();
                console.log(response);

                var newData = {
                    render: function (data, type, row, meta, klas) {
                    return meta.row + 1 + '.';
                    },
                    id: response.data.id,
                    nama: response.data.nama,
                    status: response.data.status,
                    klasifikasi: response.klas,
                    buttons: `
                        <button type="button" class="btn btn-outline-danger btn-sm delete-button" 
                            data-urusan-id="${response.data.id}"
                            data-urusan-name="${response.data.nama}" 
                            title="hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                        <div class="dropdown mb-4 d-inline">
                            <button
                                class="btn btn-outline-primary dropdown-toggle btn-sm"
                                type="button"
                                id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-urusan-id="${response.data.id}"
                                data-urusan-status="${response.data.status}">
                                ${response.data.status}
                            </button>
                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" data-action="toggle-status">change status</button>
                            </div>
                        </div>
                    `,
                    
                };

                var newRow = $('#dataTable').DataTable().row.add(newData).draw(false).node();

                //$(newRow).attr('id', 'index_' + response.data.id);

                $('#success-modal').modal('show');
                $('#success-message').html('<p class="text-success">' + response.data.nama + '</p>' + 'berhasil disimpan');
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                }, 3700);
                
                //clear form
                $('#nama').val('');
                $('#klasifikasi_id').val('');
                $('#addCategory').modal('hide');
                $('#alert-nama').addClass('d-none').removeClass('d-block');
                $('#alert-klasifikasi').addClass('d-none').removeClass('d-block');
                
            },

            error:function(error){

                if (error.status == 422){
                    if(error.responseJSON && error.responseJSON.nama && error.responseJSON.nama[0]) {
                        //show alert
                        $('#alert-nama').removeClass('d-none');
                        $('#alert-nama').addClass('d-block');
                        $('#alert-nama').html(error.responseJSON.nama[0]);
                    }
                    if(error.responseJSON && error.responseJSON.klasifikasi_id && error.responseJSON.klasifikasi_id[0]) {
                        $('#alert-klasifikasi').removeClass('d-none');
                        $('#alert-klasifikasi').addClass('d-block');
                        $('#alert-klasifikasi').html('klasifikasi wajib diisi');
                    }
                }else {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }
                
            }
        });
    });
</script>