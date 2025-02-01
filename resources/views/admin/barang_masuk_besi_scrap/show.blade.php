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
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Kode</label>
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

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Kapal</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->dataKapal->nama_kapal }}</p>
        </div>
    </div>


    <h6 class="font-weight-bold">Timbangan SB</h6>
    <div class="ml-5">
        <div class="form-group row col-md-10">
            <label class="col-sm-2 col-form-label" style="font-weight: bold;">Bruto</label>
            <div class="col-sm-4">
                <p style="margin-top: 6px;"> : &nbsp; {{ $data->bruto_sb }}</p>
            </div>
        </div>

        <div class="form-group row col-md-10">
            <label class="col-sm-2 col-form-label" style="font-weight: bold;">Tara</label>
            <div class="col-sm-4">
                <p style="margin-top: 6px;"> : &nbsp; {{ $data->tara_sb }}</p>
            </div>
        </div>

        <div class="form-group row col-md-10">
            <label class="col-sm-2 col-form-label" style="font-weight: bold;">Netto</label>
            <div class="col-sm-4">
                <p style="margin-top: 6px;"> : &nbsp; {{ $data->netto_sb }}</p>
            </div>
        </div>
    </div>

    <h6 class="font-weight-bold">Timbangan Pabrik</h6>
    <div class="ml-5">
        <div class="form-group row col-md-10">
            <label class="col-sm-2 col-form-label" style="font-weight: bold;">Bruto</label>
            <div class="col-sm-4">
                <p style="margin-top: 6px;"> : &nbsp; {{ $data->bruto_pabrik }}</p>
            </div>
        </div>

        <div class="form-group row col-md-10">
            <label class="col-sm-2 col-form-label" style="font-weight: bold;">Tara</label>
            <div class="col-sm-4">
                <p style="margin-top: 6px;"> : &nbsp; {{ $data->tara_pabrik }}</p>
            </div>
        </div>

        <div class="form-group row col-md-10">
            <label class="col-sm-2 col-form-label" style="font-weight: bold;">Netto</label>
            <div class="col-sm-4">
                <p style="margin-top: 6px;"> : &nbsp; {{ $data->netto_pabrik }}</p>
            </div>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Pot</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->pot }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Netto Bersih</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->netto_bersih }}</p>
        </div>
    </div>


    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style="font-weight: bold;">Pesanan Dari</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->pesanan_dari }}</p>
        </div>
    </div>

@endsection
