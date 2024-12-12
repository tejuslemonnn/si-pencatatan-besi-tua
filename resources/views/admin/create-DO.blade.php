@extends('sb-admin/app')
@section('title', 'Create Delivery Order')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Delivery Order</h1>


    <form action="/DO-store" method="POST" id="add_form">
        @csrf
        <div class="mt-3">
            <a href="/DO" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
            <button type="submit" class="btn btn-secondary" id="add_btn"> <i class="fas fa-check"> </i>Save</button>
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
        <h5 class="mb-4 text-gray-800">Form Create Delivery Order</h5>

        <div class="form-group col-lg-4">
            <label for="do_no">DO No.</label>
            <div class="input-group">
                <span class="input-group-text">DO-</span>
                <input type="text" name="do_no" class="form-control" placeholder="DO No." value="{{ old('do_no') }}">
            </div>
        </div>

        <div class="form-group col-lg-4">
            <label for="itr_no">ITR</label>
            <select class="form-select itrSelect js-example-theme-single" aria-label="Default select example" name="itr_no">
                <option value="" selected>Choose a ITR no.</option>
                @foreach ($itr as $ITRitem)
                    <option value="{{ $ITRitem->itr_no }}" {{ old('itr_no') == $ITRitem->itr_no ? 'selected' : '' }}>
                        {{ $ITRitem->itr_no }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-4">
            <label for="source">From Warehouse</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
            <input type="hidden" name="source" class="form-control" value="{{ auth()->user()->id }}" readonly>
        </div>

        <div class="form-group col-lg-4">
            <label for="destination">To Warehouse</label>
            <select name="destination" id="destination" class="form-control" required>
                <option selected>Selected</option>
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ old('destination') == $warehouse->id ? 'selected' : '' }}>
                        {{ $warehouse->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="form-group col-lg-4">
            <label for="created_date">Created DO Date</label>
            <input type="date" class="form-control" id="created_date" name="created_date"
                value="{{ old('created_date') }}" required>
        </div>

        <div class="form-group col-lg-4">
            <label for="delivery_date">Delivery Date</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                value="{{ old('delivery_date') }}" required>
        </div>

        <hr>

        <div class="portlet-body">

            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-secondary add_item-btn">
                Add Data
            </button> --}}

            <table id="datatable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody id="show_item">
                    @if (old('product'))
                        @foreach (old('product') as $index => $productId)
                            <tr>
                                <td>
                                    <input type="text" name="product_name[]" class="form-control"
                                        value="{{ old('product_name.' . $index) }}" readOnly>
                                    <input type="hidden" name="product[]" class="form-control"
                                        value="{{ old('product.' . $index) }}" readOnly>
                                </td>
                                <td>
                                    <textarea class="form-control" name="description[]" id="description"
                                        style="resize: none" readonly>{{ old('description.' . $index) }}</textarea>
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control"
                                        value="{{ old('qty.' . $index) }}" min=1 readonly>
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
            // var products = {!! json_encode($products) !!};


            // $(".add_item-btn").click(function(e) {
            //     e.preventDefault();

            //     var selectedValues = [];

            //     $('.productSelect').each(function(index, element) {
            //         selectedValues.push(parseInt($(element).val()));
            //     });

            //     var options = '';

            //     products.forEach(function(product) {
            //         if (!selectedValues.includes(product.id)) {
            //             options += `<option value="${product.id}">${product.name}</option>`;
            //         }
            //     });


            //     // Append the values to the table
            // $("#show_item").append(
            //     `
            //                                                 <tr>
            //                                                           <td>
            //                                                             <select class="form-select productSelect js-example-theme-single" aria-label="Default select example" name="product[]">
            //                                                            <option value="" selected>Choose a product</option>
            //                                                            ` + options + `
            //                                                            <input type="hidden" name="product_name[]" class="productName" class="form-control">
            //                                                        </select>
            //                                                          </td>
            //                                                          <td>
            //                                                            <textarea class="form-control" name="description[]" id="description" style="resize: none"></textarea>
            //                                                          </td>
            //                                                          <td>
            //                                                            <input type="number" name="qty[]" class="form-control" min=1>
            //                                                          </td>
            //                                                          <td>
            //                                                             <button class="btn btn-danger remove_item_btn">-</button>
            //                                                          </td>
            //                                                          </tr>
            //                                                 `
            // );

            //     $('.js-example-theme-single').select2({
            //         width: '100%',
            //     });
            // });

            $(document).on('click', '.remove_item_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            })

            $(".itrSelect").change(function() {
                $("#show_item").empty();
                var itr = {!! json_encode($itr) !!};

                var itrSelected = itr.find((item) => item.itr_no == $('.itrSelect').val());

                console.log(itrSelected);

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
