@extends('sb-admin/app') @section('title', 'Edit Stock Count')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Stock Count</h1>

    <form action="{{ route('updateStock', ['stockcountId' => $stockcount->id]) }}" method="POST" id="add_form">
        <div class="mt-3">

            @csrf
            @method('PUT')

            <div class="mt-3">
                <a href="/stockcount" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
                <button type="submit" class="btn btn-secondary"> <i class="fas fa-check mr-1"> </i>Save</button>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        <hr />

        <h5 class="mb-4 text-gray-800">Form Edit Material Requests</h5>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="sc_no">SC No</label>
                    <input type="text" class="form-control" id="sc_no" name="sc_no"
                        value="{{ $stockcount->sc_no }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inventory">Inventory Refrence</label>
                    <select name="inventory" id="inventory" class="form-control" required>
                        {{--
                    <option selected>Selected</option>
                    --}}
                        <option value="Inventory">Inventory</option>
                        {{--
                    <option value="Sub Storage1">Admin MM2</option>
                    --}}
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="warehouse">Warehouse</label>
                    <select name="warehouse" id="warehouse" class="form-control" required>
                        <option value="{{ $stockcount->warehouse }}">
                            {{ $stockcount->stockWarehouse->name }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group col-lg-4">
            <label for="scheduledate">Schedule Date</label>
            <input type="date" class="form-control" id="scheduledate" name="schedule"
                value="{{ $stockcount->schedule }}"required>
        </div>

        <div class="form-group col-lg-4">
            <label for="expirydate">Expiry Date</label>
            <input type="date" class="form-control" id="expirydate" name="expired" value="{{ $stockcount->expired }}"
                required>
        </div>
        <hr>

        <h5 class="mb-4 text-gray-800">Stock Count Detail</h5>

        <hr>

        <div class="portlet-body">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary add_item-btn">
                Add Data
            </button>
            {{-- <form action="/ITR-store" method="POST">
        @csrf --}}
            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>QTY</th>
                        {{-- <th>Current QTY</th>
                    <th>Return QTY</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tbody id="show_item">
                    @foreach ($stockcount->detailstockcount as $detailstockcount)
                        <tr>
                            <td>
                                <input type="hidden" name="productId[]" id="product_id">

                                <select class="form-select productSelect" aria-label="Default select example"
                                    name="product[]">
                                    @foreach ($products as $product)
                                        <option value="{{ $product['id'] }}"
                                            {{ $product['id'] == $detailstockcount->product ? 'selected' : '' }}>
                                            {{ $product['name'] }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <textarea class="form-control" name="description[]" id="description" style="resize: none"
                                    value="{{ $detailstockcount->description }}">{{ $detailstockcount->description }}</textarea>
                            </td>
                            <td>
                                <input type="number" name="qty[]" class="form-control"
                                    value="{{ $detailstockcount->qty }}" min=1>
                            </td>
                            {{-- <td>
                        <input type="number" name="current_qty[]" class="form-control current_qty" readonly>
                    </td>
                    <td>
                        <input type="number" name="return_qty[]" class="form-control">
                    </td> --}}
                            <td>
                                <button class="btn btn-danger remove_item_btn">-</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
            <!-- END Datatable -->
        </div>

    </form>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script>
        $(document).ready(function() {
            $('.productSelect').each(function() {
                let row_item = $(this).parent().parent();
                var products = {!! json_encode($products) !!};
                var selectedProduct = $(this).val();
                var findProduct = products.find(function(product) {
                    $(row_item).find('#product_id').val(product.id);
                    console.log(product.id);
                    return product.name == selectedProduct;
                });
            });
            $(".add_item-btn").click(function(e) {
                e.preventDefault();
                var products = {!! json_encode($products) !!};

                var selectedValues = [];

                $('.productSelect').each(function(index, element) {
                    selectedValues.push($(element).val());
                });

                var options = '';

                products.forEach(function(product) {
                    if (!selectedValues.includes(product.name)) {
                        options += `<option value="${product.id}">${product.name}</option>`;
                    }
                });


                // Append the values to the table
                $("#show_item").append(
                    `
            <tr>
                      <td>
                        <input type="hidden" name="productId[]" id="product_id">
                        <select class="form-select productSelect" aria-label="Default select example" name="product[]">
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
</fieldset>
--}}

{{-- <fieldset disabled>
    <div class="row">
        <div class="col-lg-4">
            <label for="disabledTextInput" class="form-label">Inventory Refrence</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Inventory" name="inventory">
        </div>
    </div>
</fieldset>
--}}

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
