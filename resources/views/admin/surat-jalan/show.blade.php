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

    {{-- $table->unsignedBigInteger('kendaraan_id');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->unsignedBigInteger('barang_keluar_besi_tua_id')->nullable();
            $table->foreign('barang_keluar_besi_tua_id')->references('id')->on('barang_keluar_besi_tuas')->onDelete('cascade');
            $table->unsignedBigInteger('barang_keluar_besi_scrap_id')->nullable();
            $table->foreign('barang_keluar_besi_scrap_id')->references('id')->on('barang_keluar_besi_scraps')->onDelete('cascade');
            $table->string('no_surat')->unique();
            $table->date('tanggal_surat');
            $table->string('penerima');
            $table->string('deskripsi')->nullable();
            $table->boolean('status')->default(false); --}}

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">No Surat</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->no_surat }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Tanggal Surat</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->tanggal_surat }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Deskripsi</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px;"> : &nbsp; {{ $data->deskripsi }}</p>
        </div>
    </div>


    <table class="table table-striped-columns table-bordered table-hover col-md-12">
    <tbody>
        <tr>
            <th class="text-start" style="font-weight: bold;">Kendaraan</th>
            <td class="text-start">{{ $data->kendaraan->model }} - {{ $data->kendaraan->nomor_plat }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Barang Keluar</th>
            <td class="text-start">{{ $data->barang_keluar_besi_tua_id ? 'Barang Keluar Besi Tua' : ($data->barang_keluar_besi_scrap_id ? 'Barang Keluar Besi Scrap' : '-') }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Perusahaan</th>
            <td class="text-start">{{ $data->perusahaan->nama }}</td>
        </tr>
        <tr>
            <th class="text-start" style="font-weight: bold;">Status</th>
            <td class="text-start">{{ $data->status ? 'Aktif' : 'Tidak Aktif' }}</td>
        </tr>
        
    </tbody>
</table>


@endsection
