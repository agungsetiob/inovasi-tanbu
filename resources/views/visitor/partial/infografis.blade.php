<section class="page-section bg-contact portfolio" id="infografis">
    <div class="container">
        <h4 class="page-section-heading text-center text-uppercase">Infografis Riset dan Inovasi</h4>
        <div class="divider-custom divider-dark">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-chart-line"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        {{--charts--}}
        <div class="row" hx-trigger="load">
            <!-- Donut Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Inovasi berdasarkan bentuk</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-2" id="bentuk-chart">
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
                        <div class="chart-pie pt-2" id="jenis-chart">
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
                        <div class="chart-bar pt-2" id="tematik-chart">
                            <canvas id="tematik" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Line Chart -->
            <div class="col-xl-6 col-lg-6 com-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Tahun Implementasi Inovasi</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-line pt-2" id="implementasiYear-chart">
                            <canvas id="implementasiYear" style="height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 com-md-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Inovasi berdasarkan Tahapan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-radar pt-2" id="tahapan-chart">
                            <canvas id="tahapan" style="height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--end charts--}}
    </div>
</section>
<script type="text/javascript">
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
                    label: 'Jumlah Proposal',
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
</script>