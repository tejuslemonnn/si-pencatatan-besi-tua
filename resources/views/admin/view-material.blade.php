@extends('sb-admin/app')
@section('title', 'Detail Material Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Material Request</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('material-pdf', ['id' => $material->id]) }}" class="btn btn-danger"><i class="fa-regular fa-file-pdf"></i> PDF </a>
    {{-- <button class="btn btn-danger">PDF</button></a> --}}

    <hr>
    <h5 class="mb-4 text-gray-800">Form Detail Material Requests</h5>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Material No</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $material->material_no }}</p>
        </div>
    </div>
    
    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Request By</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $material->requestMaterial->name }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Destination Refrence</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $material->destinationWarehouse->name }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Schedule Date</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $material->schedule }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Expiry Date</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $material->expired }}</p>
        </div>
    </div>

    {{-- table --}}

    <hr>
    <div class="portlet-body">

        <form action="#" method="POST">
            <!-- Button trigger modal -->
            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Product</th>
                        <th>QTY</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach ($detail_material as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->product }}</td>
                            <td>{{ $row->qty }}</td>
                            <td>{{ $row->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
        </form>
        <!-- END Datatable -->
    </div>

@endsection
