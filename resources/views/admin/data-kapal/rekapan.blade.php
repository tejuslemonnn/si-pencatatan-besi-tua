@extends('sb-admin/app')
@section('title', 'Detail Data Kapal')

@section('content')
    <!-- Page Heading -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- <div class="d-flex justify-content-lg-end">
        <a href="{{ route('material-pdf', ['id' => $dataKapal->id]) }}" class="btn btn-danger"><i
                class="fa-regular fa-file-pdf"></i> PDF </a>
    </div> --}}

    <hr>

    <h3 class="text-center font-weight-bold text-black">{{ $dataKapal->nama_kapal }}</h3>

    {{-- <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Tanggal Datang</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $dataKapal->tanggal_datang }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Modal</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $dataKapal->total_modal }}</p>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>KESELURUHAN</th>
                        <td>1,189,100 Kg</td>
                    </tr>
                    <tr>
                        <th>BESTI TUA KE PABRIK</th>
                        <td>1,094,380 Kg</td>
                    </tr>
                    <tr>
                        <th>TERJUAL DI KAMAL</th>
                        <td>12,710 Kg</td>
                    </tr>
                    <tr>
                        <th>MASUK GUDANG SB 102</th>
                        <td>82,010 Kg</td>
                    </tr>
                    <tr>
                        <th>PENJUALAN GUDANG SB 102</th>
                        <td>79,449 Kg</td>
                    </tr>
                    <tr>
                        <th>TEKOR TIMBANGAN</th>
                        <td>2,561 Kg</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered mt-4">
                <tbody>
                    <tr>
                        <th>PENJUALAN KAMAL</th>
                        <td>Rp 172,935,000</td>
                    </tr>
                    <tr>
                        <th>PENJUALAN GUDANG SB 102</th>
                        <td>Rp 986,795,650</td>
                    </tr>
                    <tr>
                        <th>PENJUALAN BESTI TUA PABRIK</th>
                        <td>Rp 7,377,935,500</td>
                    </tr>
                    <tr class="fw-bold">
                        <th>TOTAL PENJUALAN</th>
                        <td>Rp 8,537,666,150</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered mt-4">
                <tbody>
                    <tr>
                        <th>PENGELUARAN</th>
                        <td>Rp 1,062,666,150</td>
                    </tr>
                    <tr>
                        <th>MODAL</th>
                        <td>Rp 7,050,000,000</td>
                    </tr>
                    <tr class="fw-bold">
                        <th>TOTAL</th>
                        <td>Rp 8,112,666,150</td>
                    </tr>
                    <tr class="fw-bold text-success">
                        <th>LABA BERSIH</th>
                        <td>Rp 425,000,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
