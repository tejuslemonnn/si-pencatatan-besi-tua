@extends('sb-admin/app')
@section('title', 'Stock Count Detail')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Stock Count Detail</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('stockcount-pdf', ['id' => $stockcount->id]) }}" class="btn btn-danger"><i class="fa-regular fa-file-pdf"></i> PDF </a>
    <hr>

    <h5 class="mb-4 text-gray-800">Form Stock Count Detail</h5>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">SC No</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $stockcount->sc_no }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Inventory Refrence</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $stockcount->inventory }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Warehouse</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $stockcount->stockWarehouse->name }}</p>
        </div>
    </div>

    <div class="portlet-body">

        <form action="#" method="POST">
            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>QTY</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach ($stockcount->detailstockcount as $index => $detailstockcount)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detailstockcount->productStockCount->name }}</td>
                            <td>{{ $detailstockcount->description }}</td>
                            <td>{{ $detailstockcount->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
        </form>
        <!-- END Datatable -->
    </div>

@endsection

{{-- <div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Locations</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; Stock</p>
    </div>
</div> --}}

{{-- <div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Inventory Product</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; Specific Products</p>
    </div>
</div>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Product</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; Null</p>
    </div>
</div>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Counted Quantities</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; Default to stock hand</p>
    </div>
</div>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Description</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; Null</p>
    </div>  
</div> --}}
