@extends('sb-admin/app')
@section('title', 'Detail Data Kapal')

@section('content')
    <!-- Page Heading -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- <div class="d-flex justify-content-lg-end">
        <a href="{{ route('material-pdf', ['id' => $data->id]) }}" class="btn btn-danger"><i
                class="fa-regular fa-file-pdf"></i> PDF </a>
    </div> --}}

    <hr>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Nama</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->nama }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-barang-masuk-besi-tua-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-barang-masuk-besi-tua" type="button" role="tab"
                        aria-controls="pills-barang-masuk-besi-tua" aria-selected="true">Barang Masuk Besi Tua</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-barang-masuk-besi-scrap-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-barang-masuk-besi-scrap" type="button" role="tab"
                        aria-controls="pills-barang-masuk-besi-scrap" aria-selected="false">Barang Masuk Besi Scrap</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-barang-keluar-besi-tua-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-barang-keluar-besi-tua" type="button" role="tab"
                        aria-controls="pills-barang-keluar-besi-tua" aria-selected="false">Barang Keluar Besi Tua</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-barang-keluar-besi-scrap-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-barang-keluar-besi-scrap" type="button" role="tab"
                        aria-controls="pills-barang-keluar-besi-scrap" aria-selected="false">Barang Keluar Besi
                        Scrap</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-barang-masuk-besi-tua" role="tabpanel"
                    aria-labelledby="pills-barang-masuk-besi-tua-tab" tabindex="0">
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
                                    {{-- <th>Jumlah</th> --}}
                                    <th>Nama Barang</th>
                                    {{-- <th>Perusahaan</th> --}}
                                    <th>Perusahaan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($barangMasukBesiTua as $row)
                                    <tr>
                                        <td>{{ ($barangMasukBesiTua->currentPage() - 1) * $barangMasukBesiTua->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $row->kode }}</td>
                                        <td>{{ $row->tanggal }}</td>
                                        {{-- <td>{{ $row->data_kapal_id }}</td> --}}
                                        <td>{{ $row->dataKapal->nama_kapal }}</td>
                                        <td>{{ $row->bruto }}</td>
                                        <td>{{ $row->tara }}</td>
                                        <td>{{ $row->netto }}</td>
                                        {{-- <td>{{ $row->jumlah }}</td> --}}
                                        <td>{{ $row->produk->nama }}</td>
                                        {{-- <td>{{ $row->pesanan_dari }}</td> --}}
                                        <td>{{ $row->perusahaan->nama }}</td>

                                        {{-- @if ($row->status === 0)
                                        <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button>
                                        </td>
                                    @else
                                        <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                                    @endif --}}
                                        <td>
                                            <a href="{{ route('barang-masuk-besi-tua.show', ['barang_masuk_besi_tua' => $row->id]) }}"
                                                class="btn btn-info"><i class="fas fa-eye"></i>
                                                Detail</a>

                                            @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                <a href="{{ route('barang-masuk-besi-tua.edit', ['barang_masuk_besi_tua' => $row->id]) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Ubah
                                                </a>
                                                <form
                                                    action="{{ route('barang-masuk-besi-tua.destroy', ['barang_masuk_besi_tua' => $row->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>
                                            @elseif($row->status === 0 && auth()->user()->role == 'kepala_perusahaan')
                                                {{-- <form action="{{ route('approveITR', ['id' => $row->id]) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form> --}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $barangMasukBesiTua->links() }}
                </div>
                <div class="tab-pane fade" id="pills-barang-masuk-besi-scrap" role="tabpanel"
                    aria-labelledby="pills-barang-masuk-besi-scrap-tab" tabindex="0">
                    <div class="overflow-x-auto">
                        <table id="example" class="table table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">NO</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">KODE</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">TANGGAL</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">KAPAL</th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle;">TIMBANGAN SB</th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle;">TIMBANGAN PABRIK
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">POT</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">NETTO BERSIH
                                    </th>
                                    {{-- <th rowspan="2" class="text-center" style="vertical-align: middle;">HARGA (Rp)</th> --}}
                                    {{-- <th rowspan="2" class="text-center" style="vertical-align: middle;">JUMLAH (Rp)</th> --}}
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">PERUSAHAAN
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Action</th>
                                </tr>
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;">BRUTO</th>
                                    <th class="text-center" style="vertical-align: middle;">TARA</th>
                                    <th class="text-center" style="vertical-align: middle;">NETTO</th>
                                    <th class="text-center" style="vertical-align: middle;">BRUTO</th>
                                    <th class="text-center" style="vertical-align: middle;">TARA</th>
                                    <th class="text-center" style="vertical-align: middle;">NETTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($barangMasukBesiScrap as $row)
                                    <tr>
                                        <td>{{ ($barangMasukBesiScrap->currentPage() - 1) * $barangMasukBesiScrap->perPage() + $loop->iteration }}
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
                                        {{-- <td>{{ $row->produk->harga }}</td> --}}
                                        {{-- <td>{{ $row->pesanan_dari }}</td> --}}
                                        <td>{{ $row->perusahaan->nama }}</td>

                                        {{-- @if ($row->status === 0)
                                <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button>
                                </td>
                                @else
                                <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                                @endif --}}
                                        <td>
                                            <a href="{{ route('barang-masuk-besi-scrap.show', ['barang_masuk_besi_scrap' => $row->id]) }}"
                                                class="btn btn-info"><i class="fas fa-eye"></i>
                                                Detail</a>

                                            @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                <a href="{{ route('barang-masuk-besi-scrap.edit', ['barang_masuk_besi_scrap' => $row->id]) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Ubah
                                                </a>
                                                <form
                                                    action="{{ route('barang-masuk-besi-scrap.destroy', ['barang_masuk_besi_scrap' => $row->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>
                                            @elseif($row->status === 0 && auth()->user()->role == 'kepala_perusahaan')
                                                {{-- <form action="{{ route('approveITR', ['id' => $row->id]) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                    </form> --}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $barangMasukBesiScrap->links() }}
                </div>
                <div class="tab-pane fade" id="pills-barang-keluar-besi-tua" role="tabpanel"
                    aria-labelledby="pills-barang-keluar-besi-tua-tab" tabindex="0">
                    <div class="overflow-x-auto">

                        <table id="barang_masuk_besi_tua_table" class="table table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($barangKeluarBesiTua as $row)
                                    <tr>
                                        <td>{{ ($barangKeluarBesiTua->currentPage() - 1) * $barangKeluarBesiTua->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $row->kode }}</td>
                                        <td>{{ $row->suratJalan->kendaraan->model }} -
                                            {{ $row->suratJalan->kendaraan->nomor_plat }}
                                        </td>
                                        <td>{{ $row->suratJalan->no_surat }}</td>
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ $row->bruto }}</td>
                                        <td>{{ $row->tara }}</td>
                                        <td>{{ $row->netto }}</td>
                                        <td>{{ $row->produk->nama }}</td>
                                        <td>{{ $row->produk->harga }}</td>
                                        <td>{{ $row->jumlah_harga }}</td>
                                        <td>{{ $row->perusahaan->nama }}</td>

                                        {{-- @if ($row->status === 0)
                            <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button>
                            </td>
                        @else
                            <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                        @endif --}}
                                        <td>
                                            <a href="{{ route('barang-keluar-besi-tua.show', ['barang_keluar_besi_tua' => $row->id]) }}"
                                                class="btn btn-info"><i class="fas fa-eye"></i>
                                                Detail</a>

                                            @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                <a href="{{ route('barang-keluar-besi-tua.edit', ['barang_keluar_besi_tua' => $row->id]) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Ubah
                                                </a>
                                                <form
                                                    action="{{ route('barang-keluar-besi-tua.destroy', ['barang_keluar_besi_tua' => $row->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>
                                            @elseif($row->status === 0 && auth()->user()->role == 'kepala_perusahaan')
                                                {{-- <form action="{{ route('approveITR', ['id' => $row->id]) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form> --}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $barangKeluarBesiTua->links() }}
                </div>
                <div class="tab-pane fade" id="pills-barang-keluar-besi-scrap" role="tabpanel"
                    aria-labelledby="pills-barang-keluar-besi-scrap-tab" tabindex="0">
                    <div class="overflow-x-auto">

                        <table id="example" class="table table-bordered display nowrap">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">NO</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">KODE</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">SURAT JALAN
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">KENDARAAN</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">TANGGAL</th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle;">TIMBANGAN SB
                                    </th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle;">TIMBANGAN
                                        PABRIK</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">POT</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">NETTO BERSIH
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">HARGA (Rp)
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">JUMLAH (Rp)
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">PERUSAHAAN
                                    </th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Action</th>
                                </tr>
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;">BRUTO</th>
                                    <th class="text-center" style="vertical-align: middle;">TARA</th>
                                    <th class="text-center" style="vertical-align: middle;">NETTO</th>
                                    <th class="text-center" style="vertical-align: middle;">BRUTO</th>
                                    <th class="text-center" style="vertical-align: middle;">TARA</th>
                                    <th class="text-center" style="vertical-align: middle;">NETTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($barangKeluarBesiScrap as $row)
                                    <tr>
                                        <td>{{ ($barangKeluarBesiScrap->currentPage() - 1) * $barangKeluarBesiScrap->perPage() + $loop->iteration }}
                                        </td>
                                        <td>{{ $row->kode }}</td>
                                        <td>{{ $row->suratJalan->no_surat }}</td>
                                        <td>{{ $row->suratJalan->kendaraan->model }} -
                                            {{ $row->suratJalan->kendaraan->nomor_plat }}
                                        </td>
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ $row->bruto_sb }}</td>
                                        <td>{{ $row->tara_sb }}</td>
                                        <td>{{ $row->netto_sb }}</td>
                                        <td>{{ $row->bruto_pabrik }}</td>
                                        <td>{{ $row->tara_pabrik }}</td>
                                        <td>{{ $row->netto_pabrik }}</td>
                                        <td>{{ $row->pot }}</td>
                                        <td>{{ $row->netto_bersih }}</td>
                                        <td>{{ $row->harga }}</td>
                                        <td>{{ $row->jumlah_harga }}</td>
                                        <td>{{ $row->perusahaan->nama }}</td>

                                        {{-- @if ($row->status === 0)
                                <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button>
                                </td>
                                @else
                                <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                                @endif --}}
                                        <td>
                                            <a href="{{ route('barang-keluar-besi-scrap.show', ['barang_keluar_besi_scrap' => $row->id]) }}"
                                                class="btn btn-info"><i class="fas fa-eye"></i>
                                                Detail</a>

                                            @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                                <a href="{{ route('barang-keluar-besi-scrap.edit', ['barang_keluar_besi_scrap' => $row->id]) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Ubah
                                                </a>
                                                <form
                                                    action="{{ route('barang-keluar-besi-scrap.destroy', ['barang_keluar_besi_scrap' => $row->id]) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>
                                            @elseif($row->status === 0 && auth()->user()->role == 'kepala_perusahaan')
                                                {{-- <form action="{{ route('approveITR', ['id' => $row->id]) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                    </form> --}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $barangKeluarBesiScrap->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection
