@extends('sb-admin/app')
@section('title', 'Data Barang Masuk')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bootstrap Tabs -->
    <ul class="nav nav-tabs" id="barangMasukTabs" role="tablist">
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

    <div class="tab-content" id="barangMasukTabsContent">
        <!-- Besi Tua Tab -->
        <div class="tab-pane fade show active" id="besi-tua" role="tabpanel" aria-labelledby="besi-tua-tab">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Barang Masuk - Besi Tua</h5>
                </div>
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-2 col-12">
                            <label for="min_besi_tua">Tanggal Mulai<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="min_besi_tua" name="min_besi_tua">
                        </div>
                        <div class="col-md-2 col-12 mb-4">
                            <label for="max_besi_tua">Tanggal Selesai<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="max_besi_tua" name="max_besi_tua">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table id="barang_masuk_besi_tua_table" class="table table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Kapal</th>
                                    <th>Bruto</th>
                                    <th>Tara</th>
                                    <th>Netto</th>
                                    <th>Nama Barang</th>
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
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ $row->dataKapal->nama_kapal }}</td>
                                        <td>{{ $row->bruto }}</td>
                                        <td>{{ $row->tara }}</td>
                                        <td>{{ $row->netto }}</td>
                                        <td>{{ $row->produk->nama }}</td>
                                        <td>{{ $row->perusahaan->nama }}</td>
                                        <td
                                            class="{{ $row->status == 1 ? 'text-success' : ($row->status == null ? 'text-warning' : 'text-danger') }} font-weight-bold">
                                            {{ $row->status == 1 ? 'Disetujui' : ($row->status == null ? 'Menunggu Persetujuan' : 'Tidak Disetujui') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('barang-masuk-besi-tua.show', ['barang_masuk_besi_tua' => $row->id]) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>

                                            @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                <a href="{{ route('barang-masuk-besi-tua.edit', ['barang_masuk_besi_tua' => $row->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Ubah
                                                </a>
                                                <form
                                                    action="{{ route('barang-masuk-besi-tua.destroy', ['barang_masuk_besi_tua' => $row->id]) }}"
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
                                                        action="{{ route('approve-barang-masuk-besi-tua', ['id' => $row->id]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                @endif
                                                @if ($row->status === null)
                                                    <form
                                                        action="{{ route('reject-barang-masuk-besi-tua', ['id' => $row->id]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                    </form>
                                                @endif
                                            @endif
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
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Barang Masuk - Besi Scrap</h5>
                </div>
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-md-2 col-12">
                            <label for="min_besi_scrap">Tanggal Mulai<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="min_besi_scrap" name="min_besi_scrap">
                        </div>
                        <div class="col-md-2 col-12 mb-4">
                            <label for="max_besi_scrap">Tanggal Selesai<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="max_besi_scrap" name="max_besi_scrap">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table id="barang_masuk_besi_scrap_table" class="table table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center align-middle">NO</th>
                                    <th rowspan="2" class="text-center align-middle">KODE</th>
                                    <th rowspan="2" class="text-center align-middle">TANGGAL</th>
                                    <th rowspan="2" class="text-center align-middle">KAPAL</th>
                                    <th colspan="3" class="text-center">TIMBANGAN SB</th>
                                    <th colspan="3" class="text-center">TIMBANGAN PABRIK</th>
                                    <th rowspan="2" class="text-center align-middle">POT</th>
                                    <th rowspan="2" class="text-center align-middle">NETTO BERSIH</th>
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
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ $row->dataKapal->nama_kapal }}</td>
                                        <td>{{ $row->bruto_sb }}</td>
                                        <td>{{ $row->tara_sb }}</td>
                                        <td>{{ $row->netto_sb }}</td>
                                        <td>{{ $row->bruto_pabrik }}</td>
                                        <td>{{ $row->tara_pabrik }}</td>
                                        <td>{{ $row->netto_pabrik }}</td>
                                        <td>{{ $row->pot }}</td>
                                        <td>{{ $row->netto_bersih }}</td>
                                        <td>{{ $row->perusahaan->nama }}</td>
                                        <td
                                            class="{{ $row->status == 1 ? 'text-success' : ($row->status == null ? 'text-warning' : 'text-danger') }} font-weight-bold">
                                            {{ $row->status == 1 ? 'Disetujui' : ($row->status == null ? 'Menunggu Persetujuan' : 'Tidak Disetujui') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('barang-masuk-besi-scrap.show', ['barang_masuk_besi_scrap' => $row->id]) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>

                                            @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                <a href="{{ route('barang-masuk-besi-scrap.edit', ['barang_masuk_besi_scrap' => $row->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Ubah
                                                </a>
                                                <form
                                                    action="{{ route('barang-masuk-besi-scrap.destroy', ['barang_masuk_besi_scrap' => $row->id]) }}"
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
                                                        action="{{ route('approve-barang-masuk-besi-scrap', ['id' => $row->id]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                @endif
                                                @if ($row->status === null)
                                                    <form
                                                        action="{{ route('reject-barang-masuk-besi-scrap', ['id' => $row->id]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm">Reject</button>
                                                    </form>
                                                @endif
                                            @endif
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

@section('javascript')
    <script>
        $(document).ready(function() {
            // Initialize DataTables for both tables

            // Date range filtering for Besi Tua
            $('#min_besi_tua, #max_besi_tua').on('change', function() {
                // Add your date filtering logic here
                console.log('Date filter changed for Besi Tua');
            });

            // Date range filtering for Besi Scrap
            $('#min_besi_scrap, #max_besi_scrap').on('change', function() {
                // Add your date filtering logic here
                console.log('Date filter changed for Besi Scrap');
            });
        });
    </script>
@endsection
