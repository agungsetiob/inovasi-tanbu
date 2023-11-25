<!-- Add Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah SKPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">nama skpd</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama skpd">
                    <p class="text-danger" id="alert-nama"></p>
                </div>
                <button id="store" type="button" class="btn btn-primary">Save</button>
            </div> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let nama   = $("#nama").val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({
            url: `/master/skpd`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "_token": token
            },
            success:function(response){
                //data skpd
                $('#success-modal').modal('show');
                $('#success-message').html(response.message + '<p class="text-success">' + response.data.nama + '</p>');
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
                            data-skpd-id="${response.data.id}"
                            data-skpd-name="${response.data.nama}" 
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
                                data-skpd-id="${response.data.id}"
                                data-skpd-status="${response.data.status}">
                                ${response.data.status}
                            </button>
                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" data-action="toggle-status">change status</button>
                            </div>
                        </div>
                    `,
                    
                };

                var newRow = $('#dataTable').DataTable().row.add(newData).draw(false).node();

                // let skpd = `
                // <tr id="index_${response.data.id}">
                // <td>${response.data.id}.</td>
                // <td width="50%">${response.data.nama}</td>
                // <td>${response.data.created_at}</td>
                // <td>
                //     <button class="btn btn-outline-danger btn-sm delete-button" title="hapus" data-toggle="modal" data-target="#deleteModal"
                //         data-skpd-id="${response.data.id}"
                //         data-skpd-name="${response.data.nama}"><i class="fas fa-trash"></i></button>
                //     <div class="dropdown mb-4 d-inline">
                //         <button
                //             class="btn btn-outline-primary dropdown-toggle btn-sm"
                //             type="button"
                //             id="dropdownMenuButton"
                //             data-toggle="dropdown"
                //             aria-haspopup="true"
                //             aria-expanded="false"
                //             data-skpd-id="${response.data.id}"
                //             data-skpd-status="${response.data.status}">
                //             ${response.data.status}
                //         </button>
                //     <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                //         <button class="dropdown-item" data-action="toggle-status">change status</button>
                //     </div>
                //     </div>
                // </td>
                // </tr>
                // `;                
                // //append to table
                // $('#tabel-skpd').prepend(skpd);
                
                //clear form
                $('#nama').val('');
                $('#addCategory').modal('hide');
                $('#alert-nama').removeClass('d-block').addClass('d-none');
                $('#nama').removeClass('is-invalid');
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                }, 3700);
                
            },
            error:function(error){

                if (error.status === 422) {
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field;
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('d-block');
                        $('#' + field).addClass('is-invalid');
                    });
                } else {
                    $('#addCategory').modal('hide');
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                }

            }
        });
    });
</script>