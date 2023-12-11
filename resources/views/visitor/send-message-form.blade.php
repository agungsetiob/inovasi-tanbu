<section class="page-section bg-white" id="contact">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Kirim Pesan</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-envelope fa-flip"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <form  id="contactForm" method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="name" id="name" type="text" placeholder="Masukkan nama anda" data-sb-validations="required" autocomplete="on"/>
                        <label for="name">Nama Lengkap</label>
                        <div class="text-danger mt-2 d-none" role="alert" id="alert-name"></div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" autocomplete="on"/>
                        <label for="email">Email</label>
                        <div class="text-danger mt-2 d-none" role="alert" id="alert-email"></div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="message" id="message" type="text" placeholder="Masukkan pesan anda" style="height: 10rem" data-sb-validations="required"></textarea>
                        <label for="message">Pesan</label>
                        <div class="text-danger mt-2 d-none" role="alert" id="alert-message"></div>
                    </div>
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                        <span id="success-message"></span>
                    </div>
                    <div id="error-alert" class="alert alert-danger d-none">
                        <span id="error-message"></span>
                    </div>
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $('#submitButton').click(function(e) {
        e.preventDefault();
        var $button = $(this);
        $button.html('<i class="fas fa-spinner fa-spin"></i> Mengirim...').prop('disabled', true);

        let name   = $("#name").val();
        let email   = $("#email").val();
        let message   = $("#message").val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        $.ajax({
            url: "{{route('message.store')}}",
            type: "POST",
            cache: false,
            data: {
                "name": name,
                "email": email,
                "message": message,
                "_token": token,
            },
            success:function(response){
                console.log(response);
                $('#success-message').text(response.message);
                $('#success-alert').removeClass('d-none').addClass('show');

                $('#alert-name').addClass('d-none');
                $('#alert-email').addClass('d-none');
                $('#alert-message').addClass('d-none');
                
                $('#name').val('');
                $('#email').val('');
                $('#message').val('');               
            },
            error:function(error){

                if(error.responseJSON && error.responseJSON.name && error.responseJSON.name[0]) {
                    //show alert
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');

                    //add message to alert
                    $('#alert-name').text('nama wajib diisi');
                }
                if(error.responseJSON && error.responseJSON.email && error.responseJSON.email[0]) {
                    //show alert
                    $('#alert-email').removeClass('d-none');
                    $('#alert-email').addClass('d-block');

                    //add message to alert
                    $('#alert-email').text(error.responseJSON.email[0]);
                }
                if(error.responseJSON && error.responseJSON.message && error.responseJSON.message[0]) {
                    //show alert
                    $('#alert-message').removeClass('d-none');
                    $('#alert-message').addClass('d-block');

                    //add message to alert
                    $('#alert-message').text(error.responseJSON.message[0]);
                } else {
                    $('#error-message').text('An error occurred.');
                    $('#error-alert').removeClass('d-none').addClass('show');
                }

                // Hide success alert if it was shown
                $('#success-alert').addClass('d-none');

            },
            complete: function () {
                // Hide loading spinner and reset button text
                $button.html('Kirim').prop('disabled', false);
            }
        });
    });

</script>