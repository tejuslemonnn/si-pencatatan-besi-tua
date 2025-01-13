@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('barang-masuk-besi-tua.update', ['barang_masuk_besi_tua' => $data->id]) }}" method="POST"
        id="add_form">
        @csrf
        @method('PUT')
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
            <label for="data_kapal_id">Kapal</label>
            <select name="data_kapal_id" id="data_kapal_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($dataKapals as $kapal)
                    <option value="{{ $kapal->id }}" {{ $data->data_kapal_id == $kapal->id ? 'selected' : '' }}>
                        {{ $kapal->nama_kapal }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-12">
            <label for="tanggal">Tanggal</label>
            <div class="input-group">
                <input type="date" name="tanggal" class="form-control" placeholder="tanggal"
                    value="{{ $data->tanggal ?? old('tanggal') }}">
            </div>
        </div>

        {{-- <div class="from-group col-12 my-2">
            <label for="nopol">Nopol</label>
            <div class="input-group">
                <input type="text" name="nopol" class="form-control" placeholder="nopol"
                    value="{{ $data->nopol ?? old('nopol') }}">
            </div>
        </div> --}}

        <div class="form-group col-12">
            <label for="produk_id">Produk</label>
            <select name="produk_id" id="produk_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $data->produk_id == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="from-group col-12 my-2">
            <label for="bruto">Bruto</label>
            <div class="input-group">
                <input type="number" name="bruto" class="form-control" placeholder="Bruto"
                    value="{{ $data->bruto ?? old('bruto') }}" id="bruto">
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="tara">Tara</label>
            <div class="input-group">
                <input type="number" name="tara" class="form-control" placeholder="Tara"
                    value="{{ $data->tara ?? old('tara') }}" id="tara">
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="netto">Netto</label>
            <div class="input-group">
                <input type="number" name="netto" class="form-control" placeholder="Netto"
                    value="{{ $data->netto ?? old('netto') }}" id="netto" readonly>
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="jumlah">Jumlah</label>
            <div class="input-group">
                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah"
                    value="{{ $data->jumlah ?? old('jumlah') }}" id="jumlah" readonly>
                <div id="loading" style="display: none;" class="input-group-append">
                    <span class="input-group-text">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="keterangan">keterangan</label>
            <div class="input-group">
                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan"
                    value="{{ $data->keterangan ?? old('keterangan') }}">
            </div>
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

            const hitungJumlah = function() {
                let netto = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('barang-masuk-besi-tua.total-jumlah') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: "{{ $data->id }}"
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#jumlah').val(0);
                    },
                    success: function(response) {
                        $('#jumlah').val(response.total_jumlah + parseInt(netto));
                    },
                    complete: function() {
                        $('#loading').hide();
                    }
                });
            };

            hitungJumlah.call($('#netto'));

            $('#netto').on('change', function() {
                $('#loading').show();

                debounce(hitungJumlah, 800).call(this);
            });
        });
    </script>
@endsection
