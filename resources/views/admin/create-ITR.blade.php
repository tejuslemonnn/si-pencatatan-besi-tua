@extends('sb-admin/app')
@section('title', 'Create Interwarehouse Transfer Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Interwarehouse Transfer Request</h1>

    <form action="/ITR-store" method="POST" id="add_form">
        @csrf

        <div class="mt-3">
            <a href="/ITR" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
            <button type="submit" class="btn btn-secondary"> <i class="fas fa-check"></i> Save</button>
        </div>

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

        <hr>
        <h5 class="mb-4 text-gray-800">Form Create Interwarehouse Transfer Request</h5>

        <div class="form-group col-lg-4">
            <label for="itr_no">ITR No.</label>
            <div class="input-group">
                <span class="input-group-text">ITR-</span>
                <input type="text" name="itr_no" class="form-control" placeholder="ITR No." value="{{ old('itr_no') }}">
            </div>
        </div>

        <div class="form-group col-lg-4">
            <label for="request">Request By</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
            <input type="hidden" name="request" class="form-control" value="{{ auth()->user()->id }}" readonly>
        </div>

        <div class="form-group col-lg-4">
            <label for="source">Source Refrence</label>
            <select name="source" id="source" class="form-control" required>
                <option value="{{ $source->id }}" selected>{{ $source->name }}</option>
            </select>
        </div>

        <div class="form-group col-lg-4">
            <label for="destination">Destination Refrence</label>
            <select name="destination" id="destination" class="form-control destination-select" required>
                <option selected>Selected</option>
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ old('destination') == $warehouse->id ? 'selected' : '' }}>
                        {{ $warehouse->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-4">
            <label for="scheduledate">Schedule Date</label>
            <input type="date" class="form-control" id="scheduledate" name="schedule" value="{{ old('schedule') }}"
                required>
        </div>

        <div class="form-group col-lg-4">
            <label for="expirydate">Expiry Date</label>
            <input type="date" class="form-control" id="expirydate" name="expired" value="{{ old('expired') }}" required>
        </div>
        <hr>
        <div class="portlet-body">


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary add_item-btn"><i class="fas fa-plus"></i>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="show_item">
                    @if (old('product'))
                        @foreach (old('product') as $index => $productId)
                            @php
                                $selectedProduct = $products->where('id', $productId)->first();
                            @endphp
                            <tr>
                                <td>
                                    <select class="form-select productSelect js-example-theme-single"
                                        aria-label="Default select example" name="product[]">
                                        <option value="" selected>Choose a product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $product->id == $productId ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="product_name[]" class="productName" class="form-control"
                                        value="{{ old('product_name.' . $index) }}">
                                </td>
                                <td>
                                    <textarea class="form-control" name="description[]" id="description"
                                        style="resize: none">{{ old('description.' . $index) }}</textarea>
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control"
                                        value="{{ old('qty.' . $index) }}" min=1>
                                </td>
                                <td>
                                    <input type="number" name="current_qty[]" class="form-control current_qty" readonly
                                        value="{{ old('current_qty.' . $index) }}" min=0>
                                </td>
                                <td>
                                    <input type="number" name="return_qty[]" class="form-control return_qty" min=0
                                        value="{{ old('return_qty.' . $index) }}">
                                </td>
                                <td>
                                    <button class="btn btn-danger remove_item_btn">-</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <!-- END Datatable -->
        </div>
    </form>

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
                    selectedValues.push(parseInt($(element).val()));
                });

                var options = '';

                productWarehouse.forEach(function(product) {
                    if (!selectedValues.includes(product.id)) {
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
                                                                                                           <input type="number" name="qty[]" class="form-control qty" min=0>
                                                                                                         </td>
                                                                                                         <td>
                                                                                                           <input type="number" name="current_qty[]" class="form-control current_qty" readonly min=0>
                                                                                                         </td>
                                                                                                         <td>
                                                                                                           <input type="number" name="return_qty[]" class="form-control return_qty" min=0>
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
                var productsWarehouse = {!! json_encode($productsWarehouse) !!};

                var selectedProduct = $(this).val();

                var findProduct = products.find(function(product) {
                    return product.id == selectedProduct;
                });

                if (selectedProduct == findProduct.id) {
                    $(row_item).find('.productName').val(findProduct.name);
                    $(row_item).find('.current_qty').val(findProduct.qty);

                    var findProductWarehouse = productsWarehouse.find(function(product) {
                        return product.name == findProduct.name;
                    });


                    findProduct == undefined ? $(row_item).find('.qty').attr('max', 0) : $(
                        row_item).find('.qty').attr('max', findProduct.qty);

                    $(row_item).find('.qty').on('input', function() {
                        const enteredValue = parseInt($(this).val());
                        const maxValue = parseInt($(this).attr('max'));

                        if (enteredValue > maxValue) {
                            $(this).val(maxValue);
                        }
                    });

                    findProductWarehouse == undefined ? $(row_item).find('.return_qty').attr('max', 0) : $(
                        row_item).find('.return_qty').attr('max', findProductWarehouse.qty);

                    $(row_item).find('.return_qty').on('input', function() {
                        const enteredValue = parseInt($(this).val());
                        const maxValue = parseInt($(this).attr('max'));

                        if (enteredValue > maxValue) {
                            $(this).val(maxValue);
                        }
                    });


                } else {
                    $(row_item).find('.current_qty').val('');

                    $(row_item).find('.return_qty').removeAttr('max');
                }
            });

        });

    </script>
@endsection
