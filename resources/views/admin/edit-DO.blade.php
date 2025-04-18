@extends('sb-admin/app')
@section('title', 'Ubah Delivery Order Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Delivery Order Request</h1>

    <form action="{{ route('updateDO', ['id' => $data->id]) }}" method="POST" id="add_form">

        @csrf
        @method('PUT')

        <div class="mt-3">
            <a href="/ITR" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
            <button type="submit" class="btn btn-secondary"> <i class="fas fa-check mr-1"> </i>Save</button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <hr>
        <h5 class="mb-4 text-gray-800">Form Ubah Delivery Order Request</h5>
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="do_no">DO No.</label>
                <input type="text" name="do_no" class="form-control" placeholder="DO No." value="{{ $data->do_no }}"
                    readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="source">Source Warehiouse</label>
                    <select name="source" id="source" class="form-control" required>
                        @foreach ($warehouses as $warehouse)
                            @if ($warehouse->id == $data->source)
                                <option value="{{ $warehouse->id }}" selected>
                                    {{ $warehouse->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="itr_no">ITR</label>
                    <select class="form-select itrSelect js-example-theme-single" aria-label="Default select example"
                        name="itr_no">
                        <option value="" selected>Choose a product</option>
                        @foreach ($itr as $ITRitem)
                            <option value="{{ $ITRitem->itr_no }}"
                                {{ $data->itr_no == $ITRitem->itr_no ? 'selected' : '' }}>
                                {{ $ITRitem->itr_no }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="destination">Destination Warehouse</label>
                    <select name="destination" id="destination" class="form-control" required>
                        @foreach ($warehouses as $warehouse)
                            @if ($warehouse->id != auth()->user()->id)
                                <option value="{{ $warehouse->id }}"
                                    {{ $warehouse->id == $data->destination ? 'selected' : '' }}>{{ $warehouse->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group col-lg-4">
            <label for="created_date">Created Date</label>
            <input type="date" class="form-control" id="created_date" name="created_date"
                value="{{ $data->created_date }}" required>
        </div>

        <div class="form-group col-lg-4">
            <label for="delivery_date">Delivery Date</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                value="{{ $data->delivery_date }}" required>
        </div>

        <hr>
        <div class="portlet-body">

            <!-- Button trigger modal -->
            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody>
                <tbody id="show_item">
                    {{-- @foreach ($users as $user) --}}
                    @foreach ($data->DetailDO as $detailDO)
                        <tr>
                            <td>
                                <input type="text" name="product_name[]" class="form-control"
                                    value="{{ $detailDO->product_name }}" readOnly>
                                <input type="hidden" name="product[]" class="form-control"
                                    value="{{ $detailDO->product }}" readOnly>
                            </td>
                            <td>
                                <textarea class="form-control" name="description[]" id="description" style="resize: none"
                                    value="{{ $detailDO->description }}"
                                    readonly>{{ $detailDO->description }}</textarea>
                            </td>
                            <td>
                                <input type="number" name="qty[]" class="form-control" value="{{ $detailDO->qty }}"
                                    readonly>
                            </td>
                        </tr>
                    @endforeach
                    {{-- @endforeach --}}
                </tbody>
                </tbody>
            </table>
            <!-- END Datatable -->
        </div>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script>
            $(document).ready(function() {
                $('.js-example-theme-single').select2({
                    width: '100%',
                });

                $(".itrSelect").change(function() {
                    $("#show_item").empty();

                    var itr = {!! json_encode($itr) !!};

                    var itrSelected = itr.find((item) => item.itr_no == $('.itrSelect').val());

                    itrSelected.itp.forEach(item => {
                        // Create a new table row
                        var newRow = `
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <input type="text" name="product_name[]" class="form-control" value="${item.product_name}" readOnly>
                                                                                                        <input type="hidden" name="product[]" class="form-control" value="${item.product}" readOnly>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <textarea class="form-control" name="description[]" id="description" style="resize: none" readOnly>${item.description == null ? "" : item.description}</textarea>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <input type="number" name="qty[]" class="form-control" min="1" value="${item.qty}" readOnly>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            `;

                        // Append the new row to the table
                        $("#show_item").append(newRow);
                    });

                });
            });

        </script>
    @endsection
