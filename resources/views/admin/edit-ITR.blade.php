@extends('sb-admin/app')
@section('title', 'Ubah Interwarehouse Transfer Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Interwarehouse Transfer Request</h1>

    <form action="{{ route('updateItr', ['itrId' => $detailItr->id]) }}" method="POST" id="add_form">

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
        <h5 class="mb-4 text-gray-800">Form Ubah Interwarehouse Transfer Request</h5>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="request">ITR No</label>
                    <input type="text" class="form-control" value="{{ $detailItr->itr_no }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="request">Request By</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    <input type="hidden" name="request" class="form-control" value="{{ auth()->user()->id }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="source">Source Warehiouse</label>
                    <select name="source" id="source" class="form-control" required>
                        @foreach ($warehouses as $warehouse)
                            @if ($warehouse->id == $detailItr->source)
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
                    <label for="destination">Destination Warehouse</label>
                    <select name="destination" id="destination" class="form-control" required>
                        @foreach ($warehouses as $warehouse)
                            @if ($warehouse->id != auth()->user()->id)
                                <option value="{{ $warehouse->id }}"
                                    {{ $warehouse->id == $detailItr->destination ? 'selected' : '' }}>
                                    {{ $warehouse->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group col-lg-4">
            <label for="schedule">Schedule Date</label>
            <input type="date" class="form-control" id="scheduledate" name="schedule" value="{{ $detailItr->schedule }}"
                required>
        </div>

        <div class="form-group col-lg-4">
            <label for="expired">Expiry Date</label>
            <input type="date" class="form-control" id="expired" name="expired" value="{{ $detailItr->expired }}"
                required>
        </div>

        <hr>
        <div class="portlet-body">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary add_item-btn">
                Add Data
            </button>
            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>QTY</th>
                        <th>Current QTY</th>
                        <th>Return QTY</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <tbody id="show_item">
                    {{-- @foreach ($users as $user) --}}
                    @foreach ($detailItr->ITP as $itp)
                        <tr>
                            <td>
                                <select class="form-select productSelect js-example-theme-single"
                                    aria-label="Default select example" name="product[]">
                                    @foreach ($products as $product)
                                        <option value="{{ $product['id'] }}"
                                            {{ $product['id'] == $itp->product ? 'selected' : '' }}>
                                            {{ $product['name'] }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="product_name[]" class="productName" class="form-control"
                                    value="{{ $itp->product_name }}">
                            </td>
                            <td>
                                <textarea class="form-control" name="description[]" id="description" style="resize: none"
                                    value="{{ $itp->description }}">{{ $itp->description }}</textarea>
                            </td>
                            <td>
                                <input type="number" name="qty[]" class="form-control" value="{{ $itp->qty }}" min=1
                                >
                            </td>
                            <td>
                                <input type="number" name="current_qty[]" class="form-control current_qty"
                                    value="{{ $itp->current_qty }}" readonly min=0>
                            </td>
                            <td>
                                <input type="number" name="return_qty[]" class="form-control"
                                    value="{{ $itp->return_qty }}" min=0>
                            </td>
                            <th>
                                <button type="submit" class="btn btn-danger"><i
                                        class="fa-sharp fa-solid fa-trash"></i></button>
                            </th>
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
                var products = {!! json_encode($products) !!};
                var productWarehouse = [];

                $("#destination").on('change', function() {
                    var selectedDestination = $(this).val();
                    productWarehouse = [];
                    $("#show_item").empty();

                    productWarehouse = products.filter(function(product) {
                        return product.user_id == selectedDestination;
                    });
                });
                $(".add_item-btn").click(function(e) {
                    e.preventDefault();
                    var selectedValues = [];

                    $('.productSelect').each(function(index, element) {
                        selectedValues.push($(element).val());
                    });

                    var options = '';

                    productWarehouse.forEach(function(product) {
                        if (!selectedValues.includes(product.name)) {
                            options += `<option value="${product.id}">${product.name}</option>`;
                        }
                    });

                    // Append the values to the table
                    $("#show_item").append(
                        `
                <tr>
                          <td>
                            <select class="form-select productSelect js-example-theme-single" aria-label="Default select example" name="product[]">
                           <option value="" selected>Choose a product</option>
                           ` + options + `
                           <input type="hidden" name="product_name[]" class="productName" class="form-control">
                       </select>
                         </td>
                         <td>
                           <textarea class="form-control" name="description[]" id="description" style="resize: none"></textarea>
                         </td>
                         <td>
                           <input type="number" name="qty[]" class="form-control" min=1>
                         </td>
                         <td>
                           <input type="number" name="current_qty[]" class="form-control current_qty" readonly min=0>
                         </td>
                         <td>
                           <input type="number" name="return_qty[]" class="form-control" min=0>
                         </td>
                         <td>
                            <button class="btn btn-danger remove_item_btn">-</button>
                         </td>
                         </tr>
                `
                    );

                    $('.js-example-theme-single').select2({
                        width: '100%',
                    });
                });

                $(document).on('click', '.remove_item_btn', function(e) {
                    e.preventDefault();
                    let row_item = $(this).parent().parent();
                    $(row_item).remove();
                })

                $("#show_item").on('change', '.productSelect', function() {
                    let row_item = $(this).parent().parent();
                    var products = {!! json_encode($products) !!};
                    var selectedProduct = $(this).val();
                    var findProduct = products.find(function(product) {
                        return product.name == selectedProduct;
                    });

                    if (selectedProduct == findProduct.id) {
                        $(row_item).find('.productName').val(findProduct.name);
                        $(row_item).find('.current_qty').val(findProduct.qty);

                        var findProductWarehouse = productsWarehouse.find(function(product) {
                            return product.name == findProduct.name;
                        });

                        findProductWarehouse == undefined ? $(row_item).find('.return_qty').attr('max', 0) :
                            $(row_item).find('.return_qty').attr('max', findProductWarehouse.qty);

                    } else {
                        $(row_item).find('.current_qty').val('');

                        $(row_item).find('.return_qty').removeAttr('max');
                    }
                });
            });

        </script>
    @endsection
