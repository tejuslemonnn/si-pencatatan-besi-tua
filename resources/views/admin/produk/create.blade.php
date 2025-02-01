@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('produk.store') }}" method="POST" id="add_form">
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
            <label for="kode">Kode</label>
            <div class="input-group">
                <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ old('kode') }}">
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="nama">Nama</label>
            <div class="input-group">
                <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}">
            </div>
        </div>

        {{-- <div class="form-group col-12">
            <label for="kategori_id">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group col-12">
            <label for="data_kapal_id">Kapal</label>
            <select name="data_kapal_id" id="data_kapal_id" class="form-control" required>
                <option value="" selected>Select</option>
                @foreach ($dataKapals as $kapal)
                    <option value="{{ $kapal->id }}" {{ old('data_kapal_id') == $kapal->id ? 'selected' : '' }}>
                        {{ $kapal->nama_kapal }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- <div class="from-group col-12 my-2">
            <label for="berat">Berat</label>
            <div class="input-group">
                <input type="number" name="berat" class="form-control" placeholder="Nama" value="{{ old('berat') }}">
            </div>
        </div> --}}

        <div class="from-group col-12 my-2">
            <label for="qty">Jumlah</label>
            <div class="input-group">
                <input type="number" name="qty" class="form-control" placeholder="Nama" value="{{ old('qty') }}">
            </div>
        </div>


    </form>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#data_kapal_id').select2({
                width: '100%',
            });
            $('#kategori_id').select2({
                width: '100%',
            });

        })
    </script>
@endsection
