@extends('sb-admin/app')
@section('title', 'Create Stock Count')
    <style>
        .select2-selection__rendered {
            line-height: 41px !important;
        }

        .select2-container .select2-selection--single {
            height: 45px !important;
        }

        .select2-selection__arrow {
            height: 44px !important;
        }

    </style>
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Stock Count</h1>

    <form action="/stockcount-store" method="POST" id="add_form">
        @csrf
        <div class="mt-3">
            <a href="/stockcount" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
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

        <h5 class="mb-4 text-gray-800">Form Create StockCount</h5>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="sc_no">SC No</label>
                    <div class="input-group">
                        <span class="input-group-text">SC-</span>
                        <input type="text" class="form-control" id="sc_no" name="sc_no" value="{{ old('sc_no') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inventory">Inventory Refrence</label>
                    <select name="inventory" id="inventory" class="form-control" required>
                        <option value="Inventory" {{ old('inventory') == 'Inventory' ? 'selected' : '' }}>
                            Inventory
                        </option>
                    </select>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="warehouse">Warehouse</label>
                    <select name="warehouse" id="warehouse" class="form-control" required>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}"
                                {{ old('warehouse') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row form-group col-lg-4">
            <label for="scheduledate">Schedule Date</label>
            <input type="date" class="form-control" id="scheduledate" name="schedule" value="{{ old('schedule') }}"
                required>
        </div>

        <div class="row form-group col-lg-4">
            <label for="expirydate">Expiry Date</label>
            <input type="date" class="form-control" id="expirydate" name="expired" value="{{ old('expired') }}" required>
        </div>
        <hr>

        <hr>

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
                                    <button class="btn btn-danger remove_item_btn">-</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </form>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script>
        $(document).ready(function() {
            $('.js-example-theme-single').select2({
                width: '100%',
            });
            $(".add_item-btn").click(function(e) {
                e.preventDefault();
                var products = {!! json_encode($products) !!};

                var selectedValues = [];

                $('.productSelect').each(function(index, element) {
                    selectedValues.push(parseInt($(element).val()));
                });

                var options = '';

                products.forEach(function(product) {
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
                                                                                       </select>
                                                                                         </td>
                                                                                         <td>
                                                                                           <textarea class="form-control" name="description[]" id="description" style="resize: none"></textarea>
                                                                                         </td>
                                                                                         <td>
                                                                                           <input type="number" name="qty[]" class="form-control" min=1>
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
                    $(row_item).find('#product_id').val(product.id);
                    return product.name == selectedProduct;
                });
            });
        });

    </script>
@endsection

{{-- <fieldset disabled>
    <div class="row">
        <div class="col-lg-4">
            <label for="disabledTextInput" class="form-label">Inventory Refrence</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Inventory" name="inventory">
        </div>
    </div>
</fieldset> --}}

{{-- <fieldset disabled>
    <div class="row">
        <div class="col-lg-4">
            <label for="disabledTextInput" class="form-label">Inventory Refrence</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Inventory" name="inventory">
        </div>
    </div>
</fieldset> --}}

{{-- <div class="row">
    <div class="col-lg-4">
        <form action="#" method="POST">
            <div class="form-group">
                <label for="location">Locations</label>
                <select name="Location" id="Location" class="form-control" required>
                    <option selected>Selected</option>
                    <option value="Stock">Stock</option>
                    <option value="Expired Stock">Expired Stock </option>
                </select>    
            </div>
        </form>
    </div>
</div> --}}
