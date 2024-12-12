@extends('sb-admin/app')
@section('title', 'Detail Interwarehouse Transfer Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Interwarehouse Transfer Request</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('itr-pdf', ['id' => $detailItr->id]) }}" class="btn btn-danger"><i class="fa-regular fa-file-pdf"></i> PDF </a>
    <hr>
    <h5 class="mb-4 text-gray-800">Form Detail Interwarehouse Transfer Request</h5>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">ITR No</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $detailItr->itr_no }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Request By</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $detailItr->requestItr->name }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Source Warehouse</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $detailItr->sourceWarehouse->name }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Destination Warehouse</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $detailItr->destinationWarehouse->name }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Schedule Date</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $detailItr->schedule }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Expiry Date</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $detailItr->expired }}</p>
        </div>
    </div>

    <hr>


    <div class="portlet-body">

        <form action="#" method="POST">
            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>QTY</th>
                        <th>Current QTY</th>
                        <th>Return QTY</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach ($detailItr->ITP as $index => $itp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @foreach ($products as $product)
                                    @if ($product->id == $itp->product)
                                        {{ $product->name }}
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $itp->description }}</td>
                        <td>{{ $itp->qty }}</td>
                        <td>{{ $itp->current_qty }}</td>
                        <td>{{ $itp->return_qty }}</td>
                    </tr>
                @endforeach
            </tbody>
            </tbody>
        </table>
    </form>
    <!-- END Datatable -->
</div>

{{-- Modal --}}



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data Material Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="Product">Product</label>
                    <input type="text" name="product" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"id="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="QTY">QTY</label>
                    <input type="number" name="QTY" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary">Add Item</button>
            </div>
        </div>
    </div>
</div>
@endsection
