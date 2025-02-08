@extends('sb-admin/app')
@section('title', 'Dashboard')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="container-fluid">

        {{-- <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div> --}}

        <!-- Content Row -->
        <div class="row">

            <!-- Data Kapal -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a>
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Data Kapal</div>
                                    {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($materialReqs) }}</div> --}}
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-code-pull-request"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Data Kapal -->


            <!-- Perusahaan -->
            <div class="col-xl-3 col-md-6 mb-4">
                {{-- <a href=""> --}}
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Perusahaan</div>
                                {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($Perusahaan) }}</div> --}}
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-solid fa-warehouse"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <!-- Perusahaan -->

            <!-- ITR -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Barang Masuk</div>
                                    {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($itrs) }}</div> --}}
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ITR -->

            <!-- DO -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Barang Masuk</div>
                                    {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($DOs) }}</div> --}}
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-truck-pickup"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Content Row -->

        {{-- @if (auth()->user()->role != 'admin_pengajuan')
            <div class="row">

                <!-- Area Chart -->
                <div <div class="col-xl-6 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">ITR Charts</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="ITRCharts"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div <div class="col-xl-6 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Stock Counts Charts</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="stockCountsCharts"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                    </div>
                </div>
            </div>

            <h1 class="h3 mb-4 text-danger">Expired Draft</h1>
            <div class="row">

                <!-- Material Request -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Material Request</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $materialReqsExpired }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-code-pull-request"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Material Request -->


                <!-- StockCounts -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Stock Counts</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stockCountsExpired }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-solid fa-warehouse"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- StockCounts -->

                <!-- ITR -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Barang Masuk</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $itrsExpired }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- ITR -->

                <!-- DO -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            DO</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $DOsExpired }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-truck-pickup"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif --}}

        <!-- Content Row -->
        {{-- <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Server Migration <span
                                class="float-right">20%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Sales Tracking <span
                                class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Customer Database <span
                                class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Payout Details <span
                                class="float-right">80%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Account Setup <span
                                class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div> --}}

    </div>

    <div class="col-lg-6 mb-4">

    </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->




    <script src="{{ asset('js/chart.js') }}"></script>
    {{-- 
    <script>
        const ITRctx = document.getElementById('ITRCharts');
        const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', "August", "September", "October",
            "November", "December"
        ];

        const ITRsOutByMonth = Array.from({
            length: 12
        }, () => 0);

        let ITRSOutmonthIndex;
        @foreach ($ITRsOutByMonth as $month => $counts)
            ITRSOutmonthIndex = labels.indexOf('{{ $month }}');
            ITRsOutByMonth[ITRSOutmonthIndex] = {{ $counts->count() }};
        @endforeach

        const ITRsInByMonth = Array.from({
            length: 12
        }, () => 0);

        let ITRSInmonthIndex;

        @foreach ($ITRsInByMonth as $month => $counts)
            ITRSInmonthIndex{{ route('stockCounts') }}
{{ route('do') }}
{{ route('expiredMaterial') }}
{{ route('expiredStock') }}
{{ route('expiredITR') }}
{{ route('expiredDO') }} = labels.indexOf('{{ $month }}');
            ITRsInByMonth[ITRSInmonthIndex] = {{ $counts->count() }};
        @endforeach

        const dataITRCharts = {
            labels: labels,
            datasets: [{
                    label: 'Out',
                    data: ITRsOutByMonth,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'In',
                    data: ITRsInByMonth,
                    borderColor: 'rgb(255, 255, 0)',
                    tension: 0.1,
                    fill: false
                }
            ]
        };

        new Chart(ITRctx, {
            type: 'line',
            data: dataITRCharts,
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const StockCountsctx = document.getElementById('stockCountsCharts');

        const StockCountsData = Array.from({
            length: 12
        }, () => 0);

        @foreach ($stockCountsByMonth as $month => $counts)
            const monthIndex = labels.indexOf('{{ $month }}');
            StockCountsData[monthIndex] = {{ $counts->count() }};
        @endforeach

        const dataStockCountsCharts = {
            labels: labels,
            datasets: [{
                label: 'Stock Counts',
                data: StockCountsData,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1,
                fill: false
            }, ]
        };

        new Chart(StockCountsctx, {
            type: 'line',
            data: dataStockCountsCharts,
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}

@endsection
