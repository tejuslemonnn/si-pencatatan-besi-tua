@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('perusahaan.store') }}" method="POST" id="add_form">
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

        {{-- <div class="from-group col-12 my-2">
            <label for="jenis">Jenis</label>
            <div class="input-group">
                <input type="text" name="jenis" class="form-control" placeholder="Jenis" value="{{ old('jenis') }}">
            </div>
        </div> --}}

        <div class="from-group col-12 my-2">
            <label for="nama">Nama</label>
            <div class="input-group">
                <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}">
            </div>
        </div>
    </form>


@endsection
