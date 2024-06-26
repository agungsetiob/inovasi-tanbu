<div class="portfolio-modal modal fade slide-on" id="showNews" tabindex="-1" aria-labelledby="newsModal1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <h6 class="text-secondary text-uppercase mb-0" id="title"></h6>
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-newspaper text-yellow"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <img id="photo_url" class="img-fluid mb-4" src="" alt="Foto Evaluasi" style="max-height: 300px;"/>
                            <p class="mb-4" id="description" style="text-align: justify;"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('body').on('click', '.text-container', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: `https://api.indeks.inovasi.litbang.kemendagri.go.id/v1/news/${id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                if(response.status === 1) {
                    let data = response.data;
                    $('#title').text(data.title);
                    $('#photo_url').attr('src', data.photo_url);
                    $('#description').html(data.description);
                    $('#showNews').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>