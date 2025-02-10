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
        <a href="{{ route('material-pdf', ['id' => $data->id]) }}" class="btn btn-danger"><i
                class="fa-regular fa-file-pdf"></i> PDF </a>
    </div> --}}

    <hr>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Kode</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->kode }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Kapal</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->dataKapal->nama_kapal }} </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Kendaraan</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->suratJalan->kendaraan->model }} -
                {{ $data->suratJalan->kendaraan->nomor_plat }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Surat Jalan</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->suratJalan->no_surat }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Tanggal</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->tanggal }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Nama Barang</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->produk->nama }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Bruto</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->bruto }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Tara</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->tara }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Netto</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->netto }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Harga</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->produk->harga }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Jumlah Harga</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->jumlah_harga }}</p>
        </div>
    </div>

    {{-- <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Jumlah</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->jumlah }}</p>
        </div>
    </div> --}}

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Perusahaan</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->perusahaan->nama }}</p>
        </div>
    </div>

@endsection
