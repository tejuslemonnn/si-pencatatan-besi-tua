@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('surat-jalan.update', $data->id) }}" method="POST" id="add_form">
        @method('PUT')
        @csrf
        <button type="submit" class="btn btn-primary d-none" id="submit_button">Submit</button>

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <div class="form-group col-12">
            <label for="no_surat">No Surat</label>
            <div class="input-group">
                @php
                    use Carbon\Carbon;
                    $currentDate = Carbon::now()->format('Y/m/d');
                @endphp
                <span class="input-group-text" id="basic-addon1">SJ-{{ $currentDate }}-</span>
                <input type="text" name="no_surat" class="form-control" placeholder="No Surat"
                    value="{{ $data->no_surat }}">
            </div>
        </div> --}}

        <div class="form-group col-12">
            <label for="no_surat">No Surat</label>
            <div class="input-group">
                @php
                    $no_surat = $data->no_surat; // Misalnya: BM-BT-2025/01-001
                    $no_suratPrefix = '';
                    $no_suratSuffix = '';

                    // Gunakan regex untuk memisahkan prefix dan suffix
                    if (preg_match('/^(.*?)-(\d+)$/', $no_surat, $matches)) {
                        $no_suratPrefix = $matches[1]; // Ambil bagian sebelum '-'
                        $no_suratSuffix = $matches[2]; // Ambil angka setelah '-'
                    }
                @endphp
                <span class="input-group-text" id="basic-addon1">{{ $no_suratPrefix }}</span>
                <input type="text" name="no_surat" class="form-control" placeholder="No Surat"
                    value="{{ $no_suratSuffix ?? old('no_surat') }}" id="kode">
            </div>
        </div>

        <div class="form-group col-12">
            <label for="tanggal_surat">Tanggal Surat</label>
            <div class="input-group">
                <input type="date" name="tanggal_surat" class="form-control" placeholder="tanggal_surat"
                    value="{{ $data->tanggal_surat }}">
            </div>
        </div>

        <div class="form-group col-12">
            <label for="kendaraan_id">Kendaraan</label>
            <select name="kendaraan_id" id="kendaraan" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->id }}" {{ $data->kendaraan_id == $kendaraan->id ? 'selected' : '' }}>
                        {{ $kendaraan->nomor_plat }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group col-12">
            <label for="barang_keluar_besi_tua_id">Barang Keluar Besi Tua</label>
            <select name="barang_keluar_besi_tua_id" id="barang_keluar_besi_tua_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($barangKeluarBesiTuas as $barangKeluarBesiTua)
                    <option value="{{ $barangKeluarBesiTua->id }}"
                        {{ old('barang_keluar_besi_tua_id') == $barangKeluarBesiTua->id ? 'selected' : '' }}>
                        {{ $barangKeluarBesiTua->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12">
            <label for="barang_keluar_besi_scrap_id">Barang Keluar Besi Scrap</label>
            <select name="barang_keluar_besi_scrap_id" id="barang_keluar_besi_scrap_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($barangKeluarBesiScraps as $barangKeluarBesiScrap)
                    <option value="{{ $barangKeluarBesiScrap->id }}"
                        {{ old('barang_keluar_besi_scrap_id') == $barangKeluarBesiScrap->id ? 'selected' : '' }}>
                        {{ $barangKeluarBesiScrap->id }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="from-group col-12 my-2">
            <label for="penerima">Penerima</label>
            <div class="input-group">
                <input type="text" name="penerima" class="form-control" placeholder="Penerima"
                    value="{{ $data->penerima }}">
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="deskripsi">Deskripsi</label>
            <div class="input-group">
                <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi"
                    value="{{ $data->deskripsi }}">
            </div>
        </div>
    </form>


@endsection

@section('javascript')
    <script>
        $(function() {
            $('#barang_keluar_besi_tua_id').select2({
                width: '100%',
            });
            $('#barang_keluar_besi_scrap_id').select2({
                width: '100%',
            });
            $('#kendaraan').select2({
                width: '100%',
            });

        });
    </script>
@endsection
