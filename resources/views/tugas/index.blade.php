@extends('layouts.header-tugas')
@section('content')
    @fragment('dashboard')
    <div class="container-fluid slide-it" id="app" hx-history="false">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
            <a href="{{ route('inovasi.export') }}" class="btn btn-primary shadow-sm"><i class="fas fa-cloud-arrow-down fa-sm text-white fa-flip"></i> Export to Excel</a>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Inovasi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-dark">
                                    {{$totalProposals}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active User
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-dark"> {{$activeUsers}} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-dark">{{$inactiveUsers}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Messages
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-dark"> {{$messages}} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Donut Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Inovasi berdasarkan bentuk</h6>
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
                        <h6 class="m-0 font-weight-bold text-primary">Inovasi bedasarkan jenis</h6>
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
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Inovasi berdasarkan tematik</h6>
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
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tahun Implementasi Inovasi</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-line pt-3">
                            <canvas id="implementasiYear" style="height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Inovasi berdasarkan Tahapan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-radar pt-3">
                            <canvas id="tahapan" style="height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-lg-12">
                <!-- Project tracker card example-->
                <div class="card card-header-actions mb-4">
                    <div class="card-header text-primary font-weight-bold">
                        Presentase Capaian Inovasi
                    </div>
                    <div class="card-body">
                        <!-- Progress item 1-->
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="fw-bold">Inovasi/SKPD</div>
                            <div>{{$totalProposals}}/{{$totalSkpds}}</div>
                        </div>
                        @if ($totalSkpds != 0)
                        @php 
                        $inovasi = ($totalProposals/$totalSkpds)*100;
                        $inovasi = number_format($inovasi, 2);
                        @endphp

                        <div class="progress mb-3" style="height: 25px;">
                            <div class="progress-bar bg-danger custom-progress-bar" role="progressbar" style="width: {{$inovasi}}%;" aria-valuenow="{{$totalProposals}}" aria-valuemin="0" aria-valuemax="{{$totalSkpds}}">{{$inovasi}}%</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
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
                    scale: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endfragment
@endsection