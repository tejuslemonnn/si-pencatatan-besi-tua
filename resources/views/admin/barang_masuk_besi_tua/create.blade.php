@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('barang-masuk-besi-tua.store') }}" method="POST" id="add_form">
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
                <span class="input-group-text" id="basic-addon1">BM-BT-{{ $currentDate }}-</span>
                <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ old('kode') }}">
            </div>
        </div>

        <div class="form-group col-12">
            <label for="data_kapal_id">Kapal</label>
            <select name="data_kapal_id" id="data_kapal_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($dataKapals as $kapal)
                    <option value="{{ $kapal->id }}" {{ old('data_kapal_id') == $kapal->id ? 'selected' : '' }}>
                        {{ $kapal->nama_kapal }}
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
                    <option value="{{ $product->id }}" {{ old('produk_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }}
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
            {{-- <label for="pesanan_dari">Perusahaan</label>
            <div class="input-group">
                <input type="text" name="pesanan_dari" class="form-control" placeholder="Perusahaan"
                    value="{{ old('pesanan_dari') }}">
            </div> --}}

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
            $('#data_kapal_id').select2({
                width: '100%',
            });
            $('#produk_id').select2({
                width: '100%',
            });
            $('#perusahaan_id').select2({
                width: '100%',
            });

            function updateNetto() {
                let bruto = parseFloat($('#bruto').val()) || 0;
                let tara = parseFloat($('#tara').val()) || 0;
                let netto = bruto != 0 && tara != 0 ? bruto - tara : 0;
                if (netto > 0) {
                    $('#netto').val(netto > 0 ? netto : 0).trigger('change');
                }
            }

            $('#bruto').on('input', updateNetto);
            $('#tara').on('input', updateNetto);

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            // const hitungJumlah = debounce(function() {
            //     let netto = $(this).val();
            //     $.ajax({
            //         type: "GET",
            //         url: "{{ route('barang-masuk-besi-tua.total-jumlah') }}",
            //         data: {
            //             _token: "{{ csrf_token() }}"
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             console.log(response);

            //             $('#jumlah').val(response.total_jumlah + parseInt(netto));
            //         },
            //         complete: function() {
            //             $('#loading').hide();
            //         }
            //     });
            // }, 2000);

            // $('#netto').on('change', function() {
            //     $('#loading').show();

            //     hitungJumlah.call(this);
            // });
        });
    </script>
@endsection
