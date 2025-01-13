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

        <div style="overflow-x:auto;">
            <table id="example" class="table table-bordered display nowrap">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">NO</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">TANGGAL</th>
                        <th colspan="4" class="text-center" style="vertical-align: middle;">TIMBANGAN SUB</th>
                        <th colspan="4" class="text-center" style="vertical-align: middle;">TIMBANGAN PABRIK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">POT</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">NETTO BERSIH</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">HARGA (Rp)</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">JUMLAH (Rp)</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">KETERANGAN</th>
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
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->bruto_sp }}</td>
                            <td>{{ $row->tara_sp }}</td>
                            <td>{{ $row->netto_sp }}</td>
                            <td>{{ $row->bruto_pabrik }}</td>
                            <td>{{ $row->tara_pabrik }}</td>
                            <td>{{ $row->netto_pabrik }}</td>
                            <td>{{ $row->pot }}</td>
                            <td>{{ $row->netto_bersih }}</td>
                            <td>{{ $row->produk->harga }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->produk->nama }}</td>
                            <td>{{ $row->keterangan }}</td>

                            {{-- @if ($row->status == 0)
                    <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button>
                    </td>
                    @else
                    <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                    @endif --}}
                            <td>
                                <a href="{{ route('barang-masuk-besi-tua.show', ['barang_masuk_besi_tua' => $row->id]) }}"
                                    class="btn btn-info"><i class="fas fa-eye"></i>
                                    Detail</a>

                                @if (auth()->user()->role == 'admin' && $row->status != 1)
                                    <a href="{{ route('barang-masuk-besi-tua.edit', ['barang_masuk_besi_tua' => $row->id]) }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form
                                        action="{{ route('barang-masuk-besi-tua.destroy', ['barang_masuk_besi_tua' => $row->id]) }}"
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
