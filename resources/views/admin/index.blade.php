@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('dashboard')
            <div class="container-fluid slide-it" id="app" hx-history="false">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Dashboard</h1>
                </div>
                <!-- Content Row -->
                <div class="row">
                    @if (Auth::user()->role == 'admin')
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Your Proposal | Total All
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-dark">
                                            {{Auth::user()->proposals()->count()}} | {{$totalProposals}}
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

                    @elseif (Auth::user()->role == 'user')
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Your Proposal</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{Auth::user()->proposals()->count()}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-dark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Proposal
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> {{$totalProposals}} </div>
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
                    @endif
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
                                    <canvas id="skpd"></canvas>
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
                                Inovasi
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
                                {{-- Progress item 2
                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">Litbang</div>
                                    <div class="small">50</div>
                                </div>
                                <div class="progress mb-3"><div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>
                                <!-- Progress item 3-->
                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <div class="fw-bold">Riset</div>
                                    <div class="small">75</div>
                                </div>
                                <div class="progress mb-3"><div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- /.container-fluid -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<x-logout/>
<script type="text/javascript">
    (Chart.defaults.global.defaultFontFamily = "Metropolis"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart
    var ctx = document.getElementById("bentuk");
    var myPieChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: <?php echo json_encode($labelBentuk); ?>,
            datasets: [{
                data: <?php echo json_encode($chartBentuk); ?>,
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
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80
        }
    });

    var ctx = document.getElementById("skpd");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: <?php echo json_encode($labelJenis); ?>,
        datasets: [{
          data:  <?php echo json_encode($chartJenis); ?>,
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
      }],
    },
     options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
      },
      legend: {
          display: false
      },
      cutoutPercentage: 80,
     },
    });
</script>
@endfragment
@endsection