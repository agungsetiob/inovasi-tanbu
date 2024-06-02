<div class="portfolio-modal modal fade" id="showEvaluasi" tabindex="-1" aria-labelledby="evaluasiModal1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <h6 class="text-secondary text-uppercase mb-0" id="evaluasi-judul"></h6>
                            Oleh : <p class="mb-4 text-success" id="skpd"></p>
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star text-yellow"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <img id="foto" class="img-fluid mb-4" src="" alt="Foto Evaluasi" style="max-height: 300px;"/>
                            <p class="mb-4" id="deskripsi" style="text-align: justify;"></p>
                            <a id="link" href="" target="_blank" class="btn btn-outline-danger btn-sm" title="Link Eksternal">
                                <i class="fas fa-link"></i> <span id="link-detail"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function stripHTML(html) {
        var temp = document.createElement('div');
        temp.innerHTML = html;
        return temp.textContent || temp.innerText;
    }

    $('body').on('click', '.show-evaluasi', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: `/list/evaluasi/${id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                $('#evaluasi-judul').text(response.data.judul);
                $('#deskripsi').text(stripHTML(response.data.deskripsi));
                $('#skpd').text(response.skpd);
                $('#link').attr('href', response.data.link);
                $('#link-detail').text(response.data.link);
                var imageUrl = response.data.foto ? "{{ asset('storage/') }}/" + response.data.foto : "{{ asset('img/image.svg') }}";
                $('#foto').attr('src', imageUrl);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
</script>
