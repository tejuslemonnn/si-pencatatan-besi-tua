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
        <a href="{{ route('barang-keluar-besi-tua.generatepdf', ['id' => $data->id]) }}" class="btn btn-danger"><i
                class="fa-regular fa-file-pdf"></i> PDF </a>
    </div>

    <hr>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Kode</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->kode }}</p>
        </div>
    </div>
    
    <table class="table table-striped-columns table-bordered table-hover col-md-12">
    <tbody>
        <tr>
            <th class="text-start bg-primary text-white"style="width: 20%; font-weight: bold;">Kapal</th>
            <td class="text-start bg-primary text-white">{{ $data->dataKapal->nama_kapal }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Kendaraan</th>
            <td class="text-start">{{ $data->suratJalan->kendaraan->model }} - {{ $data->suratJalan->kendaraan->nomor_plat }}
        </td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Surat Jalan</th>
            <td class="text-start">{{ $data->suratJalan->no_surat }}</td>
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
        <tr>
        <th class="text-start" style="font-weight: bold;">Status</th>
        <td
                                class="text-start {{ $data->status === 1 ? 'text-success' : ($data->status === 0 ? 'text-danger' : 'text-warning') }} font-weight-bold">
                                {{ $data->status === 1 ? 'Disetujui' : ($data->status === 0 ? 'Tidak Disetujui' : 'Menunggu Persetujuan') }}
                            </td>
        </tr>
    </tbody>
</table>
            @endsection
