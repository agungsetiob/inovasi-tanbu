<!-- Add Modal -->
<div class="modal fade" id="addUrl" tabindex="-1" aria-labelledby="urlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="urlLabel"><span id="judul-riset-url" style="color: #0061f2;"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="editForm" hx-disable>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="text" class="form-control" name="url" id="url" placeholder="url publikasi">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-url"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="universitas" id="universitas" placeholder="Masukkan nama universitas">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-universitas"></div>
                    </div>
                    <textarea id="peneliti" class="editor form-control" name="peneliti"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-peneliti"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="store" type="button" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Save</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var risetId;
    // Function to initialize CKEditor
    function initializeCKEditor() {
        if (CKEDITOR.instances.peneliti) {
            CKEDITOR.instances.peneliti.destroy(true);
        }
        CKEDITOR.replace('peneliti');
    }

    // Function to destroy CKEditor
    function destroyCKEditor() {
        if (CKEDITOR.instances.peneliti) {
            CKEDITOR.instances.peneliti.destroy(true);
        }
    }

    $(document).on("click", ".url-button", function() {
        risetId = $(this).data("riset-id");
        $.ajax({
            url: `/riset/${risetId}`,
            type: "GET",
            cache: false,
            success: function(response) {
                $("#judul-riset-url").html(response.data.judul);
                $('#url').val(response.data.url);
                $('#universitas').val(response.data.universitas);
                $('#peneliti').val(response.data.peneliti);
                initializeCKEditor();
            }
        });
    });

    $('#addUrl').on('hidden.bs.modal', function () {
        destroyCKEditor();
    });

    $('#store').click(function(e) {
        e.preventDefault();

        var $button = $(this);
        $button.html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);

        let url = $("#url").val();
        let universitas = $("#universitas").val();
        let peneliti = CKEDITOR.instances.peneliti.getData();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/riset/url/${risetId}`,
            type: "PUT",
            cache: false,
            data: {
                "url": url,
                "universitas": universitas,
                "peneliti": peneliti,
                "_token": token,
            },
            success: function(response) {
                if (response.success) {
                    $('#alert-url').addClass('d-none').removeClass('d-block');
                    $('#alert-universitas').addClass('d-none').removeClass('d-block');
                    $('#alert-peneliti').addClass('d-none').removeClass('d-block');
                    $('#success-alert').removeClass('d-none').addClass('show');
                    $('#success-message').text(response.message);
                    $('#error-alert').addClass('d-none');
                    $('#addUrl').modal('hide');
                    $('#url').val('');
                    $('#universitas').val('');
                    CKEDITOR.instances.peneliti.setData('');
                    destroyCKEditor();
                    $('.modal-backdrop').remove();
                    $('.url-button[data-riset-id="' + risetId + '"]').removeClass('btn-outline-warning').addClass('btn-outline-primary');
                    setTimeout(function() {
                        $('#success-alert').addClass('d-none').removeClass('show');
                    }, 3900);
                }     
            },
            error: function(error) {
                if (error.status == 422) {
                    $.each(error.responseJSON.errors, function (field, errors) {
                        let alertId = 'alert-' + field;
                        $('#' + alertId).html(errors[0]).removeClass('d-none').addClass('d-block');
                        $('#' + field).addClass('is-invalid');
                    });
                } else {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-alert').removeClass('d-none').addClass('show');
                    console.log(error);
                }
            },
            complete: function() {
                $button.html('<i class="fa-solid fa-paper-plane"></i> Save').prop('disabled', false);
            }
        });
    });
});
</script>
