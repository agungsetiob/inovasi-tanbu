<section class="page-section bg-inovation portfolio" id="riset-list">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase text-white">Berita Riset dan Inovasi</h4>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-atom fa-spin"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-9 p-1">
                <div class="table-responsive bg-white p-3 rounded shadow" hx-history="false">
                    <table class="table table-borderless table-hover table-striped" id="tabel-riset" width="100%" cellspacing="0">
                        <tbody>
                            <!-- Server-side dataTable gan -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3 p-1">
                <div class="p-3 bg-white rounded shadow">
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Keywords">
                    </div>
                    <div class="mb-3">
                        <label for="yearFilter" class="form-label">Tahun:</label>
                        <select id="yearFilter" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            <!-- Dynamically populated options will go here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="skpdFilter" class="form-label">SKPD:</label>
                        <select id="skpdFilter" class="form-select" data-searchable="true">
                            <option value="">-- Semua SKPD --</option>
                            <!-- Dynamically populated options will go here -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
        {{--charts--}}
        <div class="row">
            <!-- Donut Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Inovasi berdasarkan bentuk</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="bentuk"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Inovasi bedasarkan jenis</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="jenis"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- bar Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Inovasi berdasarkan tematik</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-bar pt-4">
                            <canvas id="tematik" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        <!-- Line Chart -->
            <div class="col-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Tahun Implementasi Inovasi</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-line pt-4">
                            <canvas id="implementasiYear" style="height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Inovasi berdasarkan Tahapan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-radar pt-4">
                            <canvas id="tahapan" style="height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end charts--}}
    </div>
</section>
<script>
    var dataTable = $('#tabel-riset').DataTable({
        ajax: {
            url: 'api/riset',
            dataSrc: 'data',
            processing: true,
            serverSide: true,
        },
        columns: [
            {
                render: function (data, type, row) {
                    return '<img class="overflow-hidden" width="170" src="https://inovasi-tanbu.test/storage/system/T7oio7RZj3LtEPDzj2ECrAnLnNPg835S6LXgb8iV.png" alt="logo serasi" class="d-none d-md-inline-block">';
                } 
            },
            {
                data: 'judul',
                render: function (data, type, row) {
                    var truncatedLatar = row.latar.length > 199 ? row.latar.substring(0, 199) + '...' : row.latar;
                    return '<a class="text-primary" href="' + row.url + '">' + data + '</a>' + '<p>' + truncatedLatar + '</p>' + '<small>' + row.created_at + '</small>';
                }
            },
        ],
        pageLength: 5,
        ordering: false,
        initComplete: function (settings, json) {
            htmx.process('#tabel-riset');
            populateFilters(json.data);
        },
        error: function(xhr, error, thrown) {
            console.error('DataTables error:', error, thrown);
            alert('Error loading data. Please try again later.');
        },
    });

    $('.dt-search').addClass('d-none');
    $('.dt-length').addClass('d-none');

    document.body.addEventListener("reloadTable", function(evt) {
        dataTable.ajax.reload(function() {
            htmx.process('#tabel-riset');
        }, false);
    });

    function populateFilters(data) {
        var years = new Set();
        var skpds = new Set();

        data.forEach(function (item) {
            years.add(item.tahun);
            skpds.add(item.skpd.nama);  // Correctly access 'skpd.nama'
        });

        years.forEach(function (year) {
            $('#yearFilter').append(new Option(year, year));
        });

        skpds.forEach(function (skpd) {
            $('#skpdFilter').append(new Option(skpd, skpd));
        });

        const skpdFilter = new UseBootstrapSelect(document.getElementById('skpdFilter'));
        const yearFilter = new UseBootstrapSelect(document.getElementById('yearFilter'));
    }

    // Event listeners for filters
    $('#yearFilter').on('change', function () {
        dataTable.column(2).search(this.value).draw();
    });

    $('#skpdFilter').on('change', function () {
        dataTable.column(1).search(this.value).draw();
    });

    $('#searchInput').on('keyup', function () {
        dataTable.search(this.value).draw();
    });


    // charts---xxx
    document.addEventListener('DOMContentLoaded', function() {
            // Pie chart for "bentuk"
        var ctxBentuk = document.getElementById("bentuk").getContext('2d');
        var bentukChart = new Chart(ctxBentuk, {
            type: "pie",
            data: {
                labels: <?php echo json_encode($labelBentuk); ?>,
                datasets: [{
                    data: <?php echo json_encode($chartBentuk->values()); ?>,
                    backgroundColor: [
                        "rgba(0, 97, 242, 1)",
                        "rgba(0, 172, 105, 1)",
                        "rgba(88, 0, 232, 1)"
                        ],
                    hoverBackgroundColor: [
                        "rgba(0, 97, 242, 0.9)",
                        "rgba(0, 172, 105, 0.9)",
                        "rgba(88, 0, 232, 0.9)"
                        ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)"
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        fontColor: "black"
                    }
                }
            }
        });

            // Doughnut chart for "skpd"
        var ctxSkpd = document.getElementById("jenis").getContext('2d');
        var skpdChart = new Chart(ctxSkpd, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($labelJenis); ?>,
                datasets: [{
                    data: <?php echo json_encode($chartJenis->values()); ?>,
                    backgroundColor: [
                        "rgba(239, 58, 13, 0.8)",
                        "rgba(184, 191, 8, 0.8)",
                        ],
                    hoverBackgroundColor: [
                        "rgba(191, 45, 8, 0.8)",
                        "rgba(149, 154, 7, 0.8)",
                        ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)"
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        fontColor: "black"
                    }
                },
                cutoutPercentage: 70
            }
        });

            // Bar chart for "tematik"
        var ctxTematik = document.getElementById('tematik').getContext('2d');
        var gradientTematik = ctxTematik.createLinearGradient(0, 0, 0, 400);
        gradientTematik.addColorStop(0, 'rgba(54, 162, 235, 1)');
        gradientTematik.addColorStop(0.5, 'rgba(153, 102, 255, 1)');
        gradientTematik.addColorStop(1, 'rgba(75, 192, 192, 1)');

        var tematikChart = new Chart(ctxTematik, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labelTematik); ?>,
                datasets: [{
                    label: 'Jumlah Inovasi',
                    data: <?php echo json_encode($chartTematik->values()); ?>,
                    backgroundColor: gradientTematik,
                    borderColor: gradientTematik,
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

            // Line chart for "implementasiYear"
        var ctxYear = document.getElementById("implementasiYear").getContext('2d');
        var implementasiYearChart = new Chart(ctxYear, {
            type: "line",
            data: {
                labels: <?php echo json_encode($years); ?>,
                datasets: [{
                    label: 'Jumlah Inovasi',
                    data: <?php echo json_encode($yearlyProposals); ?>,
                    backgroundColor: "rgba(75, 192, 192, 0.5)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 5,
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        fontColor: "black"
                    }
                }
            }
        });

            // Polar area chart for "tahapan"
        var ctxTahapan = document.getElementById('tahapan').getContext('2d');
        var polarChart = new Chart(ctxTahapan, {
            type: 'polarArea',
            data: {
                    labels: <?php echo json_encode($groupedData->pluck('nama_tahapan')); ?>, // Nama tahapan
                    datasets: [{
                        label: 'Jumlah Inovasi',
                        data: <?php echo json_encode($groupedData->pluck('jumlah_proposal')); ?>, // Jumlah proposal
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                            ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                            ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scale: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            });
    });
</script>