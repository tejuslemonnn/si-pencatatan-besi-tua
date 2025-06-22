@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('surat-jalan.store') }}" method="POST" id="add_form">
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

        <div class="form-group col-12">
            <label for="no_surat">No Surat</label>
            <div class="input-group">
                @php
                    use Carbon\Carbon;
                    $currentDate = Carbon::now()->format('Y/m/d');
                @endphp
                <span class="input-group-text" id="basic-addon1">SJ-{{ $currentDate }}-</span>
                <input type="text" name="no_surat" class="form-control" placeholder="No Surat"
                    value="{{ $newKode }}" readonly>
            </div>
        </div>

        <div class="form-group col-12">
            <label for="tanggal_surat">Tanggal Surat</label>
            <div class="input-group">
                <input type="date" name="tanggal_surat" class="form-control" placeholder="tanggal_surat"
                    value="{{ old('tanggal_surat') }}">
            </div>
        </div>

        <div class="form-group col-12">
            <label for="kendaraan_id">Kendaraan</label>
            <select name="kendaraan_id" id="kendaraan" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                        {{ $kendaraan->nomor_plat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12">
            <label for="barang_keluar_type">Tipe Barang Keluar</label>
            <select name="barang_keluar_type" id="barang_keluar_type" class="form-control" required>
                <option value="" selected>Select</option>
                <option value="besi_tua">Besi Tua</option>
                <option value="besi_scrap">Besi Scrap</option>
            </select>
        </div>

        <div class="form-group col-12" id="barang_keluar_besi_tua_container" style="display: none;">
            <label for="barang_keluar_besi_tua_id">Barang Keluar Besi Tua</label>
            <select name="barang_keluar_besi_tua_id" id="barang_keluar_besi_tua_id" class="form-control">
                <option value="" selected>Select</option>
                @foreach ($barangKeluarBesiTuas as $barangKeluarBesiTua)
                    <option value="{{ $barangKeluarBesiTua->id }}"
                        {{ old('barang_keluar_besi_tua_id') == $barangKeluarBesiTua->id ? 'selected' : '' }}>
                        {{ $barangKeluarBesiTua->kode }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12" id="barang_keluar_besi_scrap_container" style="display: none;">
            <label for="barang_keluar_besi_scrap_id">Barang Keluar Besi Scrap</label>
            <select name="barang_keluar_besi_scrap_id" id="barang_keluar_besi_scrap_id" class="form-control">
                <option value="" selected>Select</option>
                @foreach ($barangKeluarBesiScraps as $barangKeluarBesiScrap)
                    <option value="{{ $barangKeluarBesiScrap->id }}"
                        {{ old('barang_keluar_besi_scrap_id') == $barangKeluarBesiScrap->id ? 'selected' : '' }}>
                        {{ $barangKeluarBesiScrap->kode }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="from-group col-12 my-2">
            <label for="perusahaan_id">Perusahaan</label>
            <select name="perusahaan_id" id="perusahaan_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($perusahaans as $perusahaan)
                    <option value="{{ $perusahaan->id }}" {{ old('perusahaan_id') == $perusahaan->id ? 'selected' : '' }}>
                        {{ $perusahaan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="from-group col-12 my-2">
            <label for="deskripsi">Deskripsi</label>
            <div class="input-group">
                <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi"
                    value="{{ old('deskripsi') }}">
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
            $('#perusahaan_id').select2({
                width: '100%',
            });

            $('#barang_keluar_type').on('change', function() {
                const selectedType = $(this).val();
                if (selectedType === 'besi_tua') {
                    $('#barang_keluar_besi_tua_container').show();
                    $('#barang_keluar_besi_scrap_container').hide();
                    $('#barang_keluar_besi_scrap_id').val(null).trigger('change');
                } else if (selectedType === 'besi_scrap') {
                    $('#barang_keluar_besi_scrap_container').show();
                    $('#barang_keluar_besi_tua_container').hide();
                    $('#barang_keluar_besi_tua_id').val(null).trigger('change');
                } else {
                    $('#barang_keluar_besi_tua_container').hide();
                    $('#barang_keluar_besi_scrap_container').hide();
                }
            });
        });
    </script>
@endsection
