@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('barang-keluar-besi-scrap.store') }}" method="POST" id="add_form">
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
            <label for="kode">Kode</label>
            <div class="input-group">
                @php
                    use Carbon\Carbon;
                    $currentDate = Carbon::now()->format('Y/m/d');
                @endphp
                <span class="input-group-text" id="basic-addon1">BK-BS-{{ $currentDate }}-</span>
                <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ old('kode') }}">
            </div>
        </div>

        {{-- <div class="form-group col-12">
            <label for="kendaraan_id">Kendaraan</label>
            <select name="kendaraan_id" id="kendaraan_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                        {{ $kendaraan->nomor_plat }} - {{ $kendaraan->model }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group col-12">
            <label for="data_kapal_id">Data Kapal</label>
            <select name="data_kapal_id" id="data_kapal_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($dataKapals as $dataKapal)
                    <option value="{{ $dataKapal->id }}" {{ old('data_kapal_id') == $dataKapal->id ? 'selected' : '' }}>
                        {{ $dataKapal->nama_kapal }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12">
            <label for="surat_jalan_id">Surat Jalan</label>
            <select name="surat_jalan_id" id="surat_jalan_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($suratJalans as $suratJalan)
                    <option value="{{ $suratJalan->id }}" {{ old('surat_jalan_id') == $suratJalan->id ? 'selected' : '' }}>
                        {{ $suratJalan->no_surat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12">
            <label for="tanggal">Tanggal</label>
            <div class="input-group">
                <input type="date" name="tanggal" class="form-control" placeholder="tanggal"
                    value="{{ old('tanggal') }}">
            </div>
        </div>

        {{-- <div class="from-group col-12 my-2">
            <label for="nopol">Nopol</label>
            <div class="input-group">
                <input type="text" name="nopol" class="form-control" placeholder="nopol" value="{{ old('nopol') }}">
            </div>
        </div> --}}

        <div class="col-12 my-3">
            <h6 class="font-weight-bold mb-0 ">Timbangan SB</h6>
            <div class="row">
                <div class="from-group col-4">
                    <label for="bruto_sb">Bruto</label>
                    <div class="input-group">
                        <input type="number" name="bruto_sb" class="form-control" placeholder="Bruto"
                            value="{{ old('bruto_sb') }}" id="bruto_sb">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="tara_sb">Tara</label>
                    <div class="input-group">
                        <input type="number" name="tara_sb" class="form-control" placeholder="Tara"
                            value="{{ old('tara_sb') }}" id="tara_sb">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="netto_sb">Netto</label>
                    <div class="input-group">
                        <input type="number" name="netto_sb" class="form-control" placeholder="Netto"
                            value="{{ old('netto_sb') }}" id="netto_sb" readonly>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 my-3">
            <h6 class="font-weight-bold mb-0 ">Timbangan Pabrik</h6>
            <div class="row">
                <div class="from-group col-4">
                    <label for="bruto_pabrik">Bruto</label>
                    <div class="input-group">
                        <input type="number" name="bruto_pabrik" class="form-control" placeholder="Bruto"
                            value="{{ old('bruto_pabrik') }}" id="bruto_pabrik">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="tara_pabrik">Tara</label>
                    <div class="input-group">
                        <input type="number" name="tara_pabrik" class="form-control" placeholder="Tara"
                            value="{{ old('tara_pabrik') }}" id="tara_pabrik">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="netto_pabrik">Netto</label>
                    <div class="input-group">
                        <input type="number" name="netto_pabrik" class="form-control" placeholder="Netto"
                            value="{{ old('netto_pabrik') }}" id="netto_pabrik" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="from-group row col-12 my-3">
            <div class="from-group col-6">
                <label for="pot">POT</label>
                <div class="input-group">
                    <input type="number" name="pot" class="form-control" placeholder="Pot"
                        value="{{ old('pot') }}" id="pot">
                </div>
            </div>

            <div class="from-group col-6">
                <label for="netto_bersih">Netto Bersih</label>
                <div class="input-group">
                    <input type="number" name="netto_bersih" class="form-control" placeholder="Netto Bersih"
                        value="{{ old('netto_bersih') }}" id="netto_bersih" readonly>
                </div>
            </div>
        </div>

        <div class="from-group row col-12">
            <div class="form-group col-6">
                <label for="harga">Harga</label>
                <div class="input-group">
                    <input type="number" name="harga" class="form-control" placeholder="Harga"
                        value="{{ old('harga') }}" id="harga">
                </div>
            </div>

            <div class="from-group col-6">
                <label for="jumlah_harga">Jumlah Harga</label>
                <div class="input-group">
                    <input type="number" name="jumlah_harga" class="form-control" placeholder="Jumlah Harga"
                        value="{{ old('jumlah_harga') }}" id="jumlah_harga" readonly>
                </div>
            </div>
        </div>

        {{-- <div class="from-group col-12 my-2">
            <label for="jumlah">Jumlah</label>
            <div class="input-group">
                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" value="{{ old('jumlah') }}"
                    id="jumlah" readonly>
                <div id="loading" style="display: none;" class="input-group-append">
                    <span class="input-group-text">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </div>
            </div>
        </div> --}}

        <div class="from-group col-12">
            <label for="perusahaan_id">Perusahaan</label>
            <select name="perusahaan_id" id="perusahaan_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($perusahaans as $perusahaan)
                    <option value="{{ $perusahaan->id }}"
                        {{ old('perusahaan_id') == $perusahaan->id ? 'selected' : '' }}>
                        {{ $perusahaan->nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>


@endsection

@section('javascript')
    <script>
        $(function() {
            $('#kendaraan_id').select2({
                width: '100%',
            });
            $('#surat_jalan_id').select2({
                width: '100%',
            });
            $('#perusahaan_id').select2({
                width: '100%',
            });
            $('#data_kapal_id').select2({
                width: '100%',
            });

            function updateNettoSB() {
                let bruto = parseFloat($('#bruto_sb').val()) || 0;
                let tara = parseFloat($('#tara_sb').val()) || 0;
                let netto = bruto != 0 && tara != 0 ? bruto - tara : 0;
                if (netto > 0) {
                    $('#netto_sb').val(netto > 0 ? netto : 0).trigger('change');
                }
            }

            $('#bruto_sb').on('input', updateNettoSB);
            $('#tara_sb').on('input', updateNettoSB);

            function updateNettoPabrik() {
                let bruto = parseFloat($('#bruto_pabrik').val()) || 0;
                let tara = parseFloat($('#tara_pabrik').val()) || 0;
                let netto = bruto != 0 && tara != 0 ? bruto - tara : 0;
                if (netto > 0) {
                    $('#netto_pabrik').val(netto > 0 ? netto : 0).trigger('change');
                }
            }

            $('#bruto_pabrik').on('input', updateNettoPabrik);
            $('#tara_pabrik').on('input', updateNettoPabrik);

            function updateNettoBersih() {
                let nettoPabrik = parseFloat($('#netto_pabrik').val()) || 0;
                let pot = parseFloat($('#pot').val()) || 0;
                let nettoBersih = pot != 0 && nettoPabrik != 0 ? nettoPabrik - pot : 0;
                if (nettoBersih > 0) {
                    $('#netto_bersih').val(nettoBersih > 0 ? nettoBersih : 0).trigger('change');
                }

                console.log('nettoPabrik', nettoPabrik, 'pot', pot, 'nettoBersih', nettoBersih);

            }

            $('#pot').on('input', updateNettoBersih);
            $('#netto_pabrik').on('change', updateNettoBersih);

            function updateJumlahHarga() {
                let harga = parseFloat($('#harga').val()) || 0;
                let nettoBersih = parseFloat($('#netto_bersih').val()) || 0;
                let jumlahHarga = harga != 0 && nettoBersih != 0 ? harga * nettoBersih : 0;
                if (jumlahHarga > 0) {
                    $('#jumlah_harga').val(jumlahHarga > 0 ? jumlahHarga : 0).trigger('change');
                }

                console.log('harga', harga, 'nettoBersih', nettoBersih, 'jumlahHarga', jumlahHarga);
            }

            $('#harga').on('input', updateJumlahHarga);
            $('#netto_bersih').on('change', updateJumlahHarga);
        });
    </script>
@endsection
