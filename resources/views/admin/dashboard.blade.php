@extends('sb-admin/app')
@section('title', 'Dashboard')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">


            <!-- Data Kapal -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('perusahaan.index') }}">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Perusahaan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($perusahaans) }}
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
            <!-- Data Kapal -->


            <!-- Perusahaan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('produk.index') }}">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Produk
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($produks) }} </div>
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
            <!-- Perusahaan -->

            <!-- Data Kapal -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('barang-masuk-besi-tua.index') }}">
                    <div class="card shadow h-100 py-2" style="border-left: 4px solid rgb(119, 158, 203)">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1"
                                        style="color: rgb(119, 158, 203)">Barang Masuk
                                        Barang Masuk Besi Tua</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($barangMasukBesiTuas) }}
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
            <!-- Data Kapal -->


            <!-- Perusahaan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('barang-masuk-besi-scrap.index') }}">
                    <div class="card shadow h-100 py-2" style="border-left: 4px solid rgb(3, 192, 60);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1"
                                        style="color: rgb(3, 192, 60)">
                                        Barang Masuk Besi Scrap</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($barangMasukBesiScraps) }}
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
            <!-- Perusahaan -->

            <!-- ITR -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('barang-keluar-besi-tua.index') }}">
                    <div class="card shadow h-100 py-2" style="border-left: 4px solid rgb(255, 105, 97)">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1"
                                        style="color: rgb(255, 105, 97)">
                                        Barang Keluar Besi Tua</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($barangkeluarBesiTuas) }}
                                    </div>
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
                <a href="{{ route('barang-keluar-besi-scrap.index') }}">
                    <div class="card shadow h-100 py-2" style="border-left: 4px solid rgb(255, 179, 71);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1"
                                        style="color: rgb(255, 179, 71)">
                                        Barang Keluar Besi Scrap</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ count($barangKeluarBesiScraps) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-truck-pickup"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <!-- Content Row -->

            @if (auth()->user()->role != 'admin_pengajuan')
                <div class="row">

                    <!-- Area Chart -->
                    <div <div class="col-xl-6 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->

                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Besi Tua</h6>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="BesiTuasChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div <div class="col-xl-6 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->

                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Besi Scrap</h6>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="BesiScrapChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

        </div>
        @endif

        <table id="example" class="table table-bordered display nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Besi Tua</th>
                    <th>Besi Scrap</th>
                    <th>Perusahaan</th>
                    <th>Netto Bersih</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($histories as $row)
                    <tr>
                        <td>{{ ($histories->currentPage() - 1) * $histories->perPage() + $loop->iteration }}</td>
                        <td>{{ $row->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $row->barang_keluar_besi_tuas != null ? $row->barangKeluarBesiTua->kode : '-' }}</td>
                        <td>{{ $row->barang_keluar_besi_scraps != null ? $row->barangKeluarBesiScrap->kode : '-' }}</td>
                        <td>{{ $row->barang_keluar_besi_scraps != null ? $row->barangKeluarBesiScrap->perusahaan->nama : $row->barangKeluarBesiTua->perusahaan->nama }}
                        </td>
                        <td class="text-primary font-weight-bold">
                            {{ $row->barang_keluar_besi_scraps != null ? $row->barangKeluarBesiScrap->netto_bersih : $row->barangKeluarBesiTua->netto }}
                            KG
                        </td>
                        <td class="text-success font-weight-bold">
                            +
                            Rp.{{ $row->barang_keluar_besi_scraps != null ? $row->barangKeluarBesiScrap->jumlah_harga : $row->barangKeluarBesiTua->jumlah_harga }}
                        </td>
                        <td>
                            <a href="{{ $row->barang_keluar_besi_scraps != null ? route('barang-keluar-besi-scrap.show', $row->barang_keluar_besi_scraps) : route('barang-keluar-besi-tua.show', $row->barang_keluar_besi_tuas) }}"
                                class="btn
                                btn-info"><i class="fas fa-eye"></i>
                                Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
                    <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

        </div>
    </div> --}}

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->




    <script src="{{ asset('js/chart.js') }}"></script>

    <script>
        const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', "August", "September", "October",
            "November", "December"
        ];
        const barangMasukBesiTuasCtx = document.getElementById('BesiTuasChart');

        const barangMasukBesiTuasOutByMonth = Array.from({
            length: 12
        }, () => 0);

        let barangMasukBesiTuasmonthIndex;
        @foreach ($barangMasukBesiTuasByMonth as $month => $counts)
            barangMasukBesiTuasmonthIndex = labels.indexOf('{{ $month }}');
            barangMasukBesiTuasOutByMonth[barangMasukBesiTuasmonthIndex] = {{ $counts->count() }};
        @endforeach

        const barangkeluarBesiTuasByMonth = Array.from({
            length: 12
        }, () => 0);

        let barangkeluarBesiTuasmonthIndex;

        @foreach ($barangkeluarBesiTuasByMonth as $month => $counts)
            barangkeluarBesiTuasmonthIndex = labels.indexOf('{{ $month }}');
            barangkeluarBesiTuasByMonth[barangkeluarBesiTuasmonthIndex] = {{ $counts->count() }};
        @endforeach

        const dataBesiTuasCharts = {
            labels: labels,
            datasets: [{
                    label: 'Barang Masuk',
                    data: barangMasukBesiTuasOutByMonth,
                    borderColor: 'rgb(119, 158, 203)', // Dark Pastel Blue
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Barang Keluar',
                    data: barangkeluarBesiTuasByMonth,
                    borderColor: 'rgb(255, 105, 97)', // Dark Pastel Red
                    tension: 0.1,
                    fill: false
                },
            ]
        };

        new Chart(barangMasukBesiTuasCtx, {
            type: 'line',
            data: dataBesiTuasCharts,
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

        const BesiScrapCtx = document.getElementById('BesiScrapChart');

        const barangMasukBesiScrapOutByMonth = Array.from({
            length: 12
        }, () => 0);

        let barangMasukBesiScrapmonthIndex;
        @foreach ($barangMasukBesiScrapsByMonth as $month => $counts)
            barangMasukBesiScrapmonthIndex = labels.indexOf('{{ $month }}');
            barangMasukBesiScrapOutByMonth[barangMasukBesiScrapmonthIndex] = {{ $counts->count() }};
        @endforeach

        const barangKeluarBesiScrapsByMonth = Array.from({
            length: 12
        }, () => 0);

        let barangkeluarBesiScrapmonthIndex;

        @foreach ($barangKeluarBesiScrapsByMonth as $month => $counts)
            barangkeluarBesiScrapmonthIndex = labels.indexOf('{{ $month }}');
            barangKeluarBesiScrapsByMonth[barangkeluarBesiScrapmonthIndex] = {{ $counts->count() }};
        @endforeach

        const dataBesiScrapCharts = {
            labels: labels,
            datasets: [{
                    label: 'Barang Masuk',
                    data: barangMasukBesiScrapOutByMonth,
                    borderColor: 'rgb(3, 192, 60)', // Dark Pastel Green
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Barang Keluar',
                    data: barangKeluarBesiScrapsByMonth,
                    borderColor: 'rgb(255, 179, 71)', // Dark Pastel Orange
                    tension: 0.1,
                    fill: false
                },
            ]
        };

        new Chart(BesiScrapCtx, {
            type: 'line',
            data: dataBesiScrapCharts,
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
    </script>

@endsection
