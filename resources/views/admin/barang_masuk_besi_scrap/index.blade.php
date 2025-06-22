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
            <table id="example" class="table table-bordered display nowrap">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">NO</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">KODE</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">TANGGAL</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">KAPAL</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle;">TIMBANGAN SB</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle;">TIMBANGAN PABRIK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">POT</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">NETTO BERSIH</th>
                        {{-- <th rowspan="2" class="text-center" style="vertical-align: middle;">HARGA (Rp)</th> --}}
                        {{-- <th rowspan="2" class="text-center" style="vertical-align: middle;">JUMLAH (Rp)</th> --}}
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">PERUSAHAAN</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">STATUS</th>
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
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
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
                                @elseif(auth()->user()->role == 'kepala_perusahaan')
                                    @if ($row->status != true)
                                        <form action="{{ route('approve-barang-masuk-besi-scrap', ['id' => $row->id]) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                    @endif
                                    @if ($row->status === null)
                                        <form action="{{ route('reject-barang-masuk-besi-scrap', ['id' => $row->id]) }}"
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
