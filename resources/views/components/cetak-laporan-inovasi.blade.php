<div class="modal fade" id="cetakLap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="font-weight-bold">Mulai tanggal :</label>
                                <input type="date" name="startdate" class="form-control" id="startdate">
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold">Sampai tanggal :</label>
                                <input type="date" name="enddate" class="form-control" id="enddate">
                            </div>
                            <div class="col-md-4" style="padding-top: 2rem;">
                                <a href=""
                                    onclick="this.href='/cetak/laporan/'+ document.getElementById('startdate').value + '/' +document.getElementById('enddate').value"
                                    class=" d-sm-inline-block btn btn-danger shadow-sm w-100" target="_blank"><i
                                        class="fas fa-print text-white"></i> Cetak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>