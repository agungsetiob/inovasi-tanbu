<div class="modal fade" id="createSetting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="form-group">
                        <label for="nama-sistem">Nama sistem</label>
                        <input type="text" class="form-control" name="nama_sistem" id="nama-sistem">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_sistem"></div>
                        <label for="tentang">Tentang sistem</label>
                        <textarea class="form-control" name="tentang" id="tentang"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tentang"></div>
                        <label for="alamat">Alamat kantor</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" >
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                        <label for="logo-sistem">Logo sistem</label>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                    Browse<input accept="image/*" id="logo-sistem" type="file" style="display: none;" name="logo_sistem">
                                </span>
                            </label>
                            <input id="uFile" type="text" class="form-control" readonly placeholder="Choose a file">
                        </div> 
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-logo_sistem"></div>
                        <label for="logo-cover">Logo cover</label>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btny btn-outline-primary">
                                    Browse<input accept="image/*" id="logo-cover" type="file" style="display: none;" name="logo_cover">
                                </span>
                            </label>
                            <input id="upFile" type="text" class="form-control" readonly placeholder="Choose a file">
                        </div> 
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-logo_cover"></div>
                    </div>
                    <button id="store" type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('logo-sistem').onchange = function () {
        document.getElementById('uFile').value = this.value;
    }
    document.getElementById('logo-cover').onchange = function () {
        document.getElementById('upFile').value = this.value;
    }

    $('#uploadForm').submit(function (e) {
        e.preventDefault();
        
        var formData = new FormData(this);

        $.ajax({
            url: '/setting/create',
            type: "POST",
            cache: false,
            contentType: false,
            data: formData,
            processData: false,
            success: function (response) {
                var reloadUrl = '/system/setting/';
                $("#setting").load(reloadUrl + " #setting");
                $("#form-button").load(reloadUrl + " #form-button");

                $('#createSetting').modal('hide');
                $('#success-modal').modal('show');
                $('#success-message').text(response.message);
                setTimeout(function() {
                    $('#success-modal').modal('hide');
                }, 3950);
            },
            error: function (error) {
                if (error.status === 422) { 
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field;
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('d-block');
                    });
                    console.error(error);
                } else{
                    $('#error-message').text('An error occurred.');
                    $('#error-modal').modal('show');
                }
            }
        });
    });
</script>
