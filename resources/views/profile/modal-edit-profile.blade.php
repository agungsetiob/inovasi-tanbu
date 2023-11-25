<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="form-update">
                    @csrf
                    @method ('PUT')
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id" id="id-profil">
                        <label for="nama-profil">Nama Pemda</label>
                        <input type="text" class="form-control" name="nama" id="nama-profil" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                        <label for="skpd">SKPD Pengampu</label>
                        <input type="text" class="form-control" name="skpd" id="skpd" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-skpd"></div>
                        <label for="alamat">Alamat Pemda</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required:email>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                        <label for="telp">Telpon</label>
                        <input type="text" class="form-control" name="telp" id="telp" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-telp"></div>
                        <label for="admin">Nama Admin</label>
                        <input type="text" class="form-control" name="admin" id="admin" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin"></div>
                    </div>
                    <button id="update-profile" type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>
<script type="text/javascript">
    $('body').on('click', '#edit-profile', function () {
        let profile_id = $('#edit-profile').data('profile-id');

        $.ajax({
            url: `/edit/profile/${profile_id}`,
            type: "GET",
            cache: false,
            success:function(response){
                    //fill data to form
                $('#id-profil').val(response.data.id);
                $('#nama-profil').val(response.data.nama);
                $('#skpd').val(response.data.skpd);
                $('#email').val(response.data.email);
                $('#alamat').val(response.data.alamat);
                $('#telp').val(response.data.telp);
                $('#admin').val(response.data.admin);
            }
        });
    });

    $('#update-profile').click(function(e) {
        e.preventDefault();

        let formData = $('#form-update').serialize();
        let id = $('#id-profil').val();

        $.ajax({
            url: `/profile/update/${id}`,
            type: 'POST',
            data: formData,
            success: function(response) {
                var reloadUrl = '/indikator/spd/' + id;
                $("#profile").load(reloadUrl + " #profile");
                $('#editProfile').modal('hide');
                $('#success-modal').modal('show');
                $('#success-message').text(response.message);
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                }, 3900);
            },
            error: function(error) {
                if (error.status === 422) {
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field;
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('d-block');
                    });
                } else {
                    let errorResponse = JSON.parse(error.responseText);
                    $('#editProfile').modal('hide');
                    $('#error-modal').modal('show');
                    $('#error-message').text(errorResponse.message);
                }
            }
        });
    });

</script>