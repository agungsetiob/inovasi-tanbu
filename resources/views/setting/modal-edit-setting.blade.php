<div class="modal fade" id="editSetting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method ('PUT')
                    <div class="form-group">
                        <label for="nama-sistem-edit">Nama sistem</label>
                        <input type="text" class="form-control" name="nama_sistem" id="nama-sistem-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_sistem-edit"></div>
                        <label for="tentang-edit">Tentang sistem</label>
                        <textarea rows="6" class="form-control" name="tentang" id="tentang-edit"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tentang-edit"></div>
                        <label for="alamat-edit">Alamat kantor</label>
                        <input type="text" class="form-control" name="alamat" id="alamat-edit" >
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat-edit"></div>
                        <label for="logo-sistem-edit">Logo sistem</label>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                    Browse<input accept="image/*" id="logo-sistem-edit" type="file" style="display: none;" name="logo_sistem">
                                </span>
                            </label>
                            <input id="uFile-edit" type="text" class="form-control" readonly placeholder="Choose a file">
                        </div> 
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-logo_sistem"></div>
                        <label for="logo-cover-edit">Logo cover</label>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                    Browse<input accept="image/*" id="logo-cover-edit" type="file" style="display: none;" name="logo_cover">
                                </span>
                            </label>
                            <input id="upFile-edit" type="text" class="form-control" readonly placeholder="Choose a file">
                        </div> 
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-logo_cover"></div>
                    </div>
                    <button id="update" type="submit" class="btn btn-primary">Update</button>
                    <button id="loading" type="submit" class="btn btn-primary d-none" disabled><i class="fa-solid fa-circle-notch fa-spin"></i></button>
                </form>
            </div> 
        </div>
    </div>
</div>
<style>
    .loading-spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 4px solid #3498db;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        margin-right: 10px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<script type="text/javascript">
    document.getElementById('logo-sistem-edit').onchange = function () {
        document.getElementById('uFile-edit').value = this.value;
    }
    document.getElementById('logo-cover-edit').onchange = function () {
        document.getElementById('upFile-edit').value = this.value;
    }

    var id

    $('body').on('click', '#edit-setting', function () {

        id = $(this).data('id');

        $.ajax({
            url: `/setting/show/${id}`,
            type: "GET",
            cache: false,
            success:function(response){
                $('#nama-sistem-edit').val(response.data.nama_sistem);
                $('#tentang-edit').val(response.data.tentang);
                $('#alamat-edit').val(response.data.alamat);
            }
        });
    });

    $('#editForm').submit(function (e) {
        e.preventDefault();
        $('#update').addClass('d-none');
        $('#loading').removeClass('d-none');
        
        var formData = new FormData(this);

        $.ajax({
            url: '/setting/update/' + id,
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            success: function (response) {
                var reloadUrl = '/system/setting/';
                $("#setting").load(reloadUrl + " #setting");

                $('#editSetting').modal('hide');
                $('#success-modal').modal('show');
                $('#success-message').text(response.message);
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                    $(".modal-backdrop").remove();
                }, 3950);
                $('#update').removeClass('d-none');
                $('#loading').addClass('d-none');
            },
            error: function (error) {
                if (error.status === 422) { 
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field + '-edit';
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('d-block');
                    });
                    $('#update').removeClass('d-none');
                    $('#loading').addClass('d-none');
                } else{
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-modal').modal('show');
                    $('#update').removeClass('d-none');
                    $('#loading').addClass('d-none');
                }
            }
        });
    });
</script>
