@extends('sb-admin/app')
@section('title', 'Detail Data Kapal')

@section('content')
    <!-- Page Heading -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-lg-end">
        <a href="{{ route('barang-masuk-besi-tua.generatepdf', ['id' => $data->id]) }}" class="btn btn-danger"><i
                class="fa-regular fa-file-pdf"></i> PDF </a>
    </div>

    <hr>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Kode</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->kode }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Tanggal</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->tanggal }}</p>
        </div>
    </div>

    {{-- kapal --}}
    <table class="table table-striped-columns table-bordered table-hover col-md-12">
    <tbody>
        <tr>
            <th class="text-start bg-primary text-white"style="width: 20%; font-weight: bold;">Kapal</th>
            <td class="text-start bg-primary text-white">{{ $data->dataKapal->nama_kapal }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Nama Barang</th>
            <td class="text-start">{{ $data->produk->nama }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Bruto</th>
            <td class="text-start">{{ $data->bruto }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Tara</th>
            <td class="text-start">{{ $data->tara }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Netto</th>
            <td class="text-start">{{ $data->netto }}</td>
        </tr>
        <!-- Uncomment if needed -->
        <!--
        <tr>
            <th style="font-weight: bold;">Jumlah</th>
            <td  class="text-start">{{ $data->jumlah }}</td>
        </tr>
        -->
        <tr>
            <th class="text-start" style="font-weight: bold;">Perusahaan</th>
            <td  class="text-start">{{ $data->perusahaan->nama }}</td>
        </tr>
    </tbody>
</table>

@endsection
