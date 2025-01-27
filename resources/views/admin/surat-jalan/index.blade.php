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

        <div class="col-md-2 col-12 mb-4">
            <label for="jenis_besi">Jenis Besi<span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_besi" name="jenis_besi">
                <option value="" {{ request('jenis_besi') == 'all' ? 'selected' : '' }}>Semua</option>
                <option value="besi_tua" {{ request('jenis_besi') == 'besi_tua' ? 'selected' : '' }}>Besi Tua</option>
                <option value="besi_scrap" {{ request('jenis_besi') == 'besi_scrap' ? 'selected' : '' }}>Besi Scrap</option>
            </select>
        </div>


        <div class="overflow-x-auto">
            <table id="example" class="table table-bordered display nowrap">
                <thead>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">NO</th>
                        <th class="text-center" style="vertical-align: middle;">TANGGAL SURAT</th>
                        <th class="text-center" style="vertical-align: middle;">NO SURAT</th>
                        <th class="text-center" style="vertical-align: middle;">KENDARAAN</th>
                        @if ($jenisBesi == 'besi_tua')
                            <th class="text-center" style="vertical-align: middle;">BARANG KELUAR BESI TUA</th>
                        @elseif ($jenisBesi == 'besi_scrap')
                            <th class="text-center" style="vertical-align: middle;">BARANG KELUAR BESI SCRAP</th>
                        @else
                            <th class="text-center" style="vertical-align: middle;">BARANG KELUAR BESI TUA</th>
                            <th class="text-center" style="vertical-align: middle;">BARANG KELUAR BESI SCRAP</th>
                        @endif
                        <th class="text-center" style="vertical-align: middle;">PENERIMA</th>
                        <th class="text-center" style="vertical-align: middle;">DESKRIPSI</th>
                        <th class="text-center" style="vertical-align: middle;">STATUS</th>
                        <th class="text-center" style="vertical-align: middle;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $row->tanggal_surat }}</td>
                            <td>{{ $row->no_surat }}</td>
                            <td>{{ $row->kendaraan->model }} - {{ $row->kendaraan->nomor_plat }}
                            </td>
                            @if ($jenisBesi == 'besi_tua')
                                <td>{{ $row->barang_keluar_besi_tua_id != null ? $row->barangKeluarBesiTua->kode : '-' }}
                                </td>
                            @elseif ($jenisBesi == 'besi_scrap')
                                <td>{{ $row->barang_keluar_besi_scrap_id != null ? $row->barangKeluarBesiScrap->kode : '-' }}
                                @else
                                <td>{{ $row->barang_keluar_besi_tua_id != null ? $row->barangKeluarBesiTua->kode : '-' }}
                                <td>{{ $row->barang_keluar_besi_scrap_id != null ? $row->barangKeluarBesiScrap->kode : '-' }}
                            @endif
                            <td>{{ $row->penerima }}</td>
                            <td>{{ $row->deskripsi }}</td>
                            {{-- <td class=" color by status --}}
                            <td
                                class="{{ $row->status === 1 ? 'text-success' : ($row->status === 0 ? 'text-warning' : 'text-danger') }} font-weight-bold">
                                {{ $row->status !== null ? ($row->status ? 'Disetujui' : 'Menunggu Persetujuan') : 'Tidak Disetujui' }}
                            </td>

                            {{-- @if ($row->status == 0)
                    <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button>
                    </td>
                    @else
                    <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                    @endif --}}
                            <td>
                                <a href="{{ route('surat-jalan.show', ['surat_jalan' => $row->id]) }}"
                                    class="btn btn-info"><i class="fas fa-eye"></i>
                                    Detail</a>

                                @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                    <a href="{{ route('surat-jalan.edit', ['surat_jalan' => $row->id]) }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('surat-jalan.destroy', ['surat_jalan' => $row->id]) }}"
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

@section('javascript')
    <script>
        $(document).ready(function() {

            // $('#min').datepicker({
            //     onSelect: function(date) {
            //         $('#max').datepicker('option', 'minDate', date);
            //     }
            // });

            // $('#max').datepicker({
            //     onSelect: function(date) {
            //         $('#min').datepicker('option', 'maxDate', date);
            //     }
            // });

            $('#jenis_besi').change(function() {
                var jenis_besi = $(this).val();
                var url = '{{ route('surat-jalan.index') }}?jenis_besi=' + jenis_besi;
                window.location.href = url;
            });
        });
    </script>
@endsection
