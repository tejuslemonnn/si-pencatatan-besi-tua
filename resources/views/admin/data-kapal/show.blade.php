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

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Nama Kapal</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $dataKapal->nama_kapal }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Tanggal Datang</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $dataKapal->tanggal_datang }}</p>
        </div>
    </div>


@endsection
