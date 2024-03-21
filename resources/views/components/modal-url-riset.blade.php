<!-- Add Modal -->
<div class="modal fade" id="addUrl" tabindex="-1" aria-labelledby="urlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="urlLabel"><span id="judul-riset-url" style="color: #0061f2;"></h5>
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
    $(document).on("click",".url-button",function() {
        risetId = $(this).data("riset-id");
        var judulRiset = $(this).data("riset-judul");
        $("#judul-riset-url").html(judulRiset);

    });
    $('#store').click(function(e) {
        e.preventDefault();

        var $button = $(this);
        $button.html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);

        let url   = $("#url").val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        $.ajax({

            url: `/riset/url/${risetId}`,
            type: "PUT",
            cache: false,
            data: {
                "url": url,
                "_token": token,
            },
            success:function(response){
                if (response.success){
                    $('#alert-url').addClass('d-none').removeClass('d-block');
                    $('#success-alert').removeClass('d-none').addClass('show');
                    $('#success-message').text(response.message);
                    $('#error-alert').addClass('d-none');
                    $('#addUrl').modal('hide');
                    $('#url').val('');
                    $('.modal-backdrop').remove();
                    $('.url-button[data-riset-id="' + risetId + '"]').removeClass('btn-outline-warning').addClass('btn-outline-primary');
                    setTimeout(function() {
                        $('#success-alert').addClass('d-none').removeClass('show');
                    }, 3900);
                    
                }     
            },
            error:function(error){

                if(error.status == 422) {
                    $('#alert-url').removeClass('d-none');
                    $('#alert-url').addClass('d-block');
                    $('#alert-url').html(error.responseJSON.errors.url[0]);
                } else {
                    $('#error-message').text(error.status + ' ' + error.responseJSON.message);
                    $('#error-alert').removeClass('d-none').addClass('show');
                    console.log(error);
                }
            },
            complete: function () {
                $button.html('<i class="fa-solid fa-paper-plane"></i> Save').prop('disabled', false);
            }
        });
    });
});
</script>