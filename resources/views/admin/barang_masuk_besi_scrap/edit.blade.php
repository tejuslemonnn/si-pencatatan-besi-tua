@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('barang-masuk-besi-scrap.update', $data) }}" method="POST" id="add_form">
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
                <input type="date" name="tanggal" class="form-control" placeholder="tanggal" value="{{ $data->tanggal }}"
                    required>
            </div>
        </div>

        <div class="col-12 my-3">
            <h6 class="font-weight-bold mb-0 ">Timbangan SB</h6>
            <div class="row">
                <div class="from-group col-4">
                    <label for="bruto_sb">Bruto</label>
                    <div class="input-group">
                        <input type="number" name="bruto_sb" class="form-control" placeholder="Bruto"
                            value="{{ $data->bruto_sb }}" id="bruto_sb">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="tara_sb">Tara</label>
                    <div class="input-group">
                        <input type="number" name="tara_sb" class="form-control" placeholder="Tara"
                            value="{{ $data->tara_sb }}" id="tara_sb">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="netto_sb">Netto</label>
                    <div class="input-group">
                        <input type="number" name="netto_sb" class="form-control" placeholder="Netto"
                            value="{{ $data->netto_sb }}" id="netto_sb" readonly>
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
                            value="{{ $data->bruto_pabrik }}" id="bruto_pabrik">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="tara_pabrik">Tara</label>
                    <div class="input-group">
                        <input type="number" name="tara_pabrik" class="form-control" placeholder="Tara"
                            value="{{ $data->tara_pabrik }}" id="tara_pabrik">
                    </div>
                </div>

                <div class="from-group col-4">
                    <label for="netto_pabrik">Netto</label>
                    <div class="input-group">
                        <input type="number" name="netto_pabrik" class="form-control" placeholder="Netto"
                            value="{{ $data->netto_pabrik }}" id="netto_pabrik" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="from-group row col-12">
            <div class="from-group col-6">
                <label for="pot">POT</label>
                <div class="input-group">
                    <input type="number" name="pot" class="form-control" placeholder="Pot" value="{{ $data->pot }}"
                        id="pot">
                </div>
            </div>

            <div class="from-group col-6">
                <label for="netto_bersih">Netto Bersih</label>
                <div class="input-group">
                    <input type="number" name="netto_bersih" class="form-control" placeholder="Netto Bersih"
                        value="{{ $data->netto_bersih }}" id="netto_bersih" readonly>
                </div>
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="pesanan_dari">Pesanan Dari</label>
            <div class="input-group">
                <input type="text" name="pesanan_dari" class="form-control" placeholder="Pesanan Dari"
                    value="{{ $data->pesanan_dari }}">
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

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }
        });
    </script>
@endsection
