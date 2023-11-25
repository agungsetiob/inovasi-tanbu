<div class="portfolio-modal modal fade" id="showInovasi" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <h6 class="text-secondary text-uppercase mb-0" id="inovasi-name"></h6>
                            Inisiator : <p class="mb-4 text-success" id="skpd"></p>
                            <a id="print" href="" target="_blank" class="btn btn-outline-danger btn-sm" title="cetak"><i class="fas fa-file-alt"></i> Download proposal</a>
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star text-yellow"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <p class="mb-4" id="rancang" style="text-align: justify;"></p>
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

    $('body').on('click', '.show-inovasi', function () {

        let id = $(this).data('id');
        let href = `/print/report/${id}`;
        $('#print').attr('href', href);

        $.ajax({
            url: `/show/inovasi/${id}`,
            type: "GET",
            cache: false,
            success:function(response){
                $('#inovasi-name').text(response.data.nama);
                $('#rancang').text(stripHTML(response.data.rancang_bangun));
                $('#skpd').text(response.skpd);
            }
        });
    });
</script>
