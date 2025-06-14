@extends('sb-admin/app')
@section('title', 'Create Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('kendaraan.update', $data->id) }}" method="POST" id="add_form">
        @method('PUT')
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

        <!--<div class="from-group col-12 my-2">-->
        <!--    <label for="jenis">Jenis</label>-->
        <!--    <div class="input-group">-->
        <!--        <input type="text" name="jenis" class="form-control" placeholder="Jenis" value="{{ $data->jenis }}">-->
        <!--    </div>-->
        <!--</div>-->

        <div class="from-group col-12 my-2">
            <label for="nomor_plat">No Plat</label>
            <div class="input-group">
                <input type="text" name="nomor_plat" class="form-control" placeholder="No Plat"
                    value="{{ $data->nomor_plat }}">
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="model">Model</label>
            <div class="input-group">
                <input type="text" name="model" class="form-control" placeholder="Model" value="{{ $data->model }}">
            </div>
        </div>
    </form>


@endsection
