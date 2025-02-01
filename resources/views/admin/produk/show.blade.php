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
        <a href="{{ route('material-pdf', ['id' => $produk->id]) }}" class="btn btn-danger"><i
                class="fa-regular fa-file-pdf"></i> PDF </a>
    </div> --}}

    <hr>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Nama</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $produk->nama }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Kode</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $produk->kode }}</p>
        </div>
    </div>

    {{-- <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Kategori</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $produk->kategori->nama }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Berat</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $produk->berat }}</p>
        </div>
    </div> --}}

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Qty</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $produk->qty }}</p>
        </div>
    </div>

@endsection
