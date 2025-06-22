@extends('sb-admin/app')
@section('title', 'Data Barang Keluar')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Bootstrap Tabs -->
    <ul class="nav nav-tabs" id="barangKeluarTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="besi-tua-tab" data-bs-toggle="tab" data-bs-target="#besi-tua" type="button"
                role="tab" aria-controls="besi-tua" aria-selected="true">
                <i class="fas fa-cube me-2"></i>Data Besi Tua
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="besi-scrap-tab" data-bs-toggle="tab" data-bs-target="#besi-scrap" type="button"
                role="tab" aria-controls="besi-scrap" aria-selected="false">
                <i class="fas fa-recycle me-2"></i>Data Besi Scrap
            </button>
        </li>
    </ul>

    <div class="tab-content" id="barangKeluarTabsContent">
        <!-- Besi Tua Tab -->
        <div class="tab-pane fade show active" id="besi-tua" role="tabpanel" aria-labelledby="besi-tua-tab">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Data Barang Keluar - Besi Tua</h5>
                </div>
                <div class="card-body">
                    <!-- Date Filter for Besi Tua -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="start_date_besi_tua" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date_besi_tua" name="start_date_besi_tua">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date_besi_tua" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date_besi_tua" name="end_date_besi_tua">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-info me-2" id="filter_besi_tua">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <button type="button" class="btn btn-secondary" id="reset_filter_besi_tua">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table id="barang_keluar_besi_tua_table" class="table table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Kapal</th>
                                    <th>Kendaraan</th>
                                    <th>Surat Jalan</th>
                                    <th>Tanggal</th>
                                    <th>Bruto</th>
                                    <th>Tara</th>
                                    <th>Netto</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah Harga</th>
                                    <th>Perusahaan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($besiTuas as $row)
                                    <tr>
                                        <td>{{ ($besiTuas->currentPage() - 1) * $besiTuas->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $row->kode }}</td>
                                        <td>{{ $row->dataKapal->nama_kapal }}</td>
                                        <td>
                                            @if ($row->suratJalan != null)
                                                {{ $row->suratJalan->kendaraan->model }} -
                                                {{ $row->suratJalan->kendaraan->nomor_plat }}
                                            @else
                                                <span class="text-danger">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->suratJalan != null)
                                                {{ $row->suratJalan->no_surat }}
                                            @else
                                                <span class="text-danger">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ number_format($row->bruto, 2) }}</td>
                                        <td>{{ number_format($row->tara, 2) }}</td>
                                        <td>{{ number_format($row->netto, 2) }}</td>
                                        <td>{{ $row->produk->nama }}</td>
                                        <td>Rp. {{ number_format($row->produk->harga, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($row->jumlah_harga, 0, ',', '.') }}</td>
                                        <td>{{ $row->perusahaan->nama }}</td>
                                        <td
                                            class="{{ $row->status == 1 ? 'text-success' : ($row->status == null ? 'text-warning' : 'text-danger') }} font-weight-bold">
                                            {{ $row->status == 1 ? 'Disetujui' : ($row->status == null ? 'Menunggu Persetujuan' : 'Tidak Disetujui') }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('barang-keluar-besi-tua.show', ['barang_keluar_besi_tua' => $row->id]) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>

                                                @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                    <a href="{{ route('barang-keluar-besi-tua.edit', ['barang_keluar_besi_tua' => $row->id]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <form
                                                        action="{{ route('barang-keluar-besi-tua.destroy', ['barang_keluar_besi_tua' => $row->id]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                @elseif(auth()->user()->role == 'kepala_perusahaan')
                                                    @if ($row->status != true)
                                                        <form
                                                            action="{{ route('approve-barang-keluar-besi-tua', ['id' => $row->id]) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Approve</button>
                                                        </form>
                                                    @endif
                                                    @if ($row->status === null)
                                                        <form
                                                            action="{{ route('reject-barang-keluar-besi-tua', ['id' => $row->id]) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $besiTuas->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Besi Scrap Tab -->
        <div class="tab-pane fade" id="besi-scrap" role="tabpanel" aria-labelledby="besi-scrap-tab">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Data Barang Keluar - Besi Scrap</h5>
                </div>
                <div class="card-body">
                    <!-- Date Filter for Besi Scrap -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="start_date_besi_scrap" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date_besi_scrap"
                                name="start_date_besi_scrap">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date_besi_scrap" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="end_date_besi_scrap"
                                name="end_date_besi_scrap">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-info me-2" id="filter_besi_scrap">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <button type="button" class="btn btn-secondary" id="reset_filter_besi_scrap">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table id="barang_keluar_besi_scrap_table" class="table table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center align-middle">NO</th>
                                    <th rowspan="2" class="text-center align-middle">KODE</th>
                                    <th rowspan="2" class="text-center align-middle">KAPAL</th>
                                    <th rowspan="2" class="text-center align-middle">SURAT JALAN</th>
                                    <th rowspan="2" class="text-center align-middle">KENDARAAN</th>
                                    <th rowspan="2" class="text-center align-middle">TANGGAL</th>
                                    <th colspan="3" class="text-center">TIMBANGAN SB</th>
                                    <th colspan="3" class="text-center">TIMBANGAN PABRIK</th>
                                    <th rowspan="2" class="text-center align-middle">POT</th>
                                    <th rowspan="2" class="text-center align-middle">NETTO BERSIH</th>
                                    <th rowspan="2" class="text-center align-middle">HARGA (Rp)</th>
                                    <th rowspan="2" class="text-center align-middle">JUMLAH (Rp)</th>
                                    <th rowspan="2" class="text-center align-middle">PERUSAHAAN</th>
                                    <th rowspan="2" class="text-center align-middle">STATUS</th>
                                    <th rowspan="2" class="text-center align-middle">Action</th>
                                </tr>
                                <tr>
                                    <th class="text-center">BRUTO</th>
                                    <th class="text-center">TARA</th>
                                    <th class="text-center">NETTO</th>
                                    <th class="text-center">BRUTO</th>
                                    <th class="text-center">TARA</th>
                                    <th class="text-center">NETTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($besiScraps as $row)
                                    <tr>
                                        <td>{{ ($besiScraps->currentPage() - 1) * $besiScraps->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $row->kode }}</td>
                                        <td>{{ $row->dataKapal->nama_kapal }}</td>
                                        <td>
                                            @if ($row->suratJalan != null)
                                                {{ $row->suratJalan->no_surat }}
                                            @else
                                                <span class="text-danger">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->suratJalan != null)
                                                {{ $row->suratJalan->kendaraan->model }} -
                                                {{ $row->suratJalan->kendaraan->nomor_plat }}
                                            @else
                                                <span class="text-danger">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ number_format($row->bruto_sb, 2) }}</td>
                                        <td>{{ number_format($row->tara_sb, 2) }}</td>
                                        <td>{{ number_format($row->netto_sb, 2) }}</td>
                                        <td>{{ number_format($row->bruto_pabrik, 2) }}</td>
                                        <td>{{ number_format($row->tara_pabrik, 2) }}</td>
                                        <td>{{ number_format($row->netto_pabrik, 2) }}</td>
                                        <td>{{ number_format($row->pot, 2) }}</td>
                                        <td>{{ number_format($row->netto_bersih, 2) }}</td>
                                        <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($row->jumlah_harga, 0, ',', '.') }}</td>
                                        <td>{{ $row->perusahaan->nama }}</td>
                                        <td
                                            class="{{ $row->status == 1 ? 'text-success' : ($row->status == null ? 'text-warning' : 'text-danger') }} font-weight-bold">
                                            {{ $row->status == 1 ? 'Disetujui' : ($row->status == null ? 'Menunggu Persetujuan' : 'Tidak Disetujui') }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('barang-keluar-besi-scrap.show', ['barang_keluar_besi_scrap' => $row->id]) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>

                                                @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                    <a href="{{ route('barang-keluar-besi-scrap.edit', ['barang_keluar_besi_scrap' => $row->id]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <form
                                                        action="{{ route('barang-keluar-besi-scrap.destroy', ['barang_keluar_besi_scrap' => $row->id]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                @elseif(auth()->user()->role == 'kepala_perusahaan')
                                                    @if ($row->status != true)
                                                        <form
                                                            action="{{ route('approve-barang-keluar-besi-scrap', ['id' => $row->id]) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Approve</button>
                                                        </form>
                                                    @endif
                                                    @if ($row->status === null)
                                                        <form
                                                            action="{{ route('reject-barang-keluar-besi-scrap', ['id' => $row->id]) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $besiScraps->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
