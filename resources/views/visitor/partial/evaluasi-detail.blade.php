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
                            <a id="slug" href="javascript:void(0)" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard">
                                <i class="fas fa-copy"></i> <span id="slug-detail"></span>
                            </a>
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

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            var tooltipTrigger = document.getElementById('slug');
            var tooltip = bootstrap.Tooltip.getInstance(tooltipTrigger);
            tooltip.setContent({ '.tooltip-inner': 'Copied!' });
            setTimeout(() => tooltip.setContent({ '.tooltip-inner': 'Copy to clipboard' }), 2000);
        }, function(err) {
            console.error('Async: Could not copy text: ', err);
        });
    }

    function copyUrl() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        document.getElementById('slug').addEventListener('click', function () {
            copyToClipboard(document.getElementById('slug-detail').textContent);
        });
    }

    $('body').on('click', '.show-evaluasi', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: `/api/evaluasi/${id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                $('#evaluasi-judul').text(response.data.judul);
                $('#deskripsi').text(stripHTML(response.data.deskripsi));
                $('#skpd').text(response.skpd);
                $('#link').attr('href', response.data.link);
                $('#link-detail').text(response.data.link);
                $('#slug-detail').text(response.slugUrl);
                var imageUrl = response.data.foto ? "{{ asset('storage/') }}/" + response.data.foto : "{{ asset('img/image.svg') }}";
                $('#foto').attr('src', imageUrl);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
        copyUrl();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>