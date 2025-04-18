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
            <label for="from_date">Tanggal Mulai<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="min" name="min">
        </div>

        <div class="col-md-2 col-12 mb-4">
            <label for="to_date">Tanggal Selesai<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="max" name="max">
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
                        {{-- <th>Jumlah</th> --}}
                        <th>Nama Barang</th>
                        {{-- <th>Perusahaan</th> --}}
                        <th>Perusahaan</th>
                        <th>Status</th>
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
                            <td
                                class="{{ $row->status === 1 ? 'text-success' : ($row->status === 0 ? 'text-danger' : 'text-warning') }} font-weight-bold">
                                {{ $row->status === 1 ? 'Disetujui' : ($row->status === 0 ? 'Tidak Disetujui' : 'Menunggu Persetujuan') }}
                            </td>

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
                                @elseif(auth()->user()->role == 'kepala_perusahaan')
                                    @if ($row->status === null || $row->status === 0)
                                        <form action="{{ route('approve-barang-masuk-besi-tua', ['id' => $row->id]) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                    @endif
                                    @if ($row->status === null)
                                        <form action="{{ route('reject-barang-masuk-besi-tua', ['id' => $row->id]) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    @endif
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
