@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('barang-keluar-besi-tua.store') }}" method="POST" id="add_form">
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
                <span class="input-group-text" id="basic-addon1">BK-BT-{{ $currentDate }}-</span>
                <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ old('kode') }}">
            </div>
        </div>

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

        <div class="form-group col-12">
            <label for="produk_id">Produk</label>
            <select name="produk_id" id="produk_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('produk_id') == $product->id ? 'selected' : '' }}
                        data-harga="{{ $product->harga }}">
                        {{ $product->nama }} - Rp. {{ number_format($product->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>

            {{-- <label for="nama_barang">Nama Barang</label>
            <div class="input-group">
                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang"
                    value="{{ old('nama_barang') }}" id="nama_barang">
            </div> --}}
        </div>

        <div class="from-group col-12 my-2">
            <label for="bruto">Bruto</label>
            <div class="input-group">
                <input type="number" name="bruto" class="form-control" placeholder="Bruto" value="{{ old('bruto') }}"
                    id="bruto">
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="tara">Tara</label>
            <div class="input-group">
                <input type="number" name="tara" class="form-control" placeholder="Tara" value="{{ old('tara') }}"
                    id="tara">
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="netto">Netto</label>
            <div class="input-group">
                <input type="number" name="netto" class="form-control" placeholder="Netto" value="{{ old('netto') }}"
                    id="netto" readonly>
            </div>
        </div>

        {{-- <div class="form-group col-12">
            <label for="harga">Harga</label>
            <div class="input-group">
                <input type="number" name="harga" class="form-control" placeholder="Harga" value="old('harga')"
                    id="harga" readonly>
            </div>
        </div> --}}

        <div class="from-group col-12 my-2">
            <label for="jumlah_harga">Jumlah Harga</label>
            <div class="input-group">
                <input type="number" name="jumlah_harga" class="form-control" placeholder="Jumlah Harga"
                    value="{{ old('jumlah_harga') }}" id="jumlah_harga" readonly>
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
            $('#produk_id').select2({
                width: '100%',
            });
            $('#data_kapal_id').select2({
                width: '100%',
            });

            function updateJumlahHarga() {
                let netto = parseFloat($('#netto').val()) || 0;
                let selectedProduct = $('#produk_id').find(':selected');
                let harga = selectedProduct.data('harga') || 0;
                let jumlahHarga = netto != 0 && harga != 0 ? netto * harga : 0;
                // if (jumlahHarga > 0) {
                $('#jumlah_harga').val(jumlahHarga > 0 ? jumlahHarga : 0).trigger('change');
                // }
            }

            function updateNetto() {
                let bruto = parseFloat($('#bruto').val()) || 0;
                let tara = parseFloat($('#tara').val()) || 0;
                let netto = bruto != 0 && tara != 0 ? bruto - tara : 0;
                if (netto > 0) {
                    $('#netto').val(netto > 0 ? netto : 0).trigger('change');
                    updateJumlahHarga();
                }
            }




            $('#bruto').on('input', updateNetto);
            $('#tara').on('input', updateNetto);

            $('#produk_id').on('change', function() {
                let selectedProduct = $(this).find(':selected');

                let harga = selectedProduct.data('harga') || 0;
                updateJumlahHarga();
            });

            $('#netto').on('input', updateJumlahHarga);
        });
    </script>
@endsection
