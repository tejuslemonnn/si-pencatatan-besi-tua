@extends('sb-admin/app')
@section('title', 'History Barang Keluar')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row my-2">
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
                @foreach ($data as $row)
                    <tr>
                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
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

        {{ $data->links() }}

    </div>
@endsection
