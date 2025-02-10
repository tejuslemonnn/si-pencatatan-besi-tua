@extends('sb-admin/app')
@section('title', 'Data Kapal')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row my-2">
        <div class="col-md-2 col-12">
            <label for="from_date">Start Date<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="min" name="min">
        </div>

        <div class="col-md-2 col-12 mb-4">
            <label for="to_date">End Date<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="max" name="max">
        </div>

        <div class="overflow-x-auto">

            <table id="barang_masuk_besi_tua_table" class="table table-bordered display nowrap">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $row->kode }}</td>
                            <td>{{ $row->dataKapal->nama_kapal }}</td>
                            <td>{{ $row->suratJalan->kendaraan->model }} - {{ $row->suratJalan->kendaraan->nomor_plat }}
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

                            {{-- @if ($row->status == 0)
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
                                        class="btn btn-warning"><i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form
                                        action="{{ route('barang-keluar-besi-tua.destroy', ['barang_keluar_besi_tua' => $row->id]) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            Delete</button>
                                    </form>
                                @elseif($row->status == 0 && auth()->user()->role == 'kepala_perusahaan')
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

        {{ $data->links() }}

    </div>
@endsection
