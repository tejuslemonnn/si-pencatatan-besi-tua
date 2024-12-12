@extends('sb-admin/app')
@section('title', 'Delivery Order Transfer Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Delivery Order Transfer Request</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('DO-pdf', ['id' => $data->id]) }}" class="btn btn-danger"><i class="fa-regular fa-file-pdf"></i> PDF </a>
    <hr>
    <h5 class="mb-4 text-gray-800">Form Delivery Order Transfer Request</h5>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">DO No</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $data->do_no }}
            </p>
        </div>
    </div>
    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">DO No</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $data->itr_no }}
            </p>
        </div>
    </div>
    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Source Warehouse</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $data->sourceWarehouse->name }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Destination Warehouse</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp;
                {{ $data->destinationWarehouse->name }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Created Date</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $data->created_date }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Delivery Date</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> : &nbsp; {{ $data->delivery_date }}</p>
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
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach ($data->DetailDO as $index => $detailDo)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detailDo->product_name }}</td>
                            <td>{{ $detailDo->description }}</td>
                            <td>{{ $detailDo->qty }}</td>
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
                        <textarea class="form-control" name="description" id="description"></textarea>
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
