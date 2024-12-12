@extends('sb-admin/app')
@section('title', 'Edit Material Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Material Request</h1>

    <form action="{{ route('updateMaterial', ['materialId' => $material->id]) }}" method="POST" id="add_form">
        @csrf
        @method('PUT')
        <div class="mt-3">
            <a href="/materialreq" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
            <button type="submit" class="btn btn-secondary"> <i class="fas fa-check mr-1"> </i>Save</button>
        </div>

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
        <hr>
        <h5 class="mb-4 text-gray-800">Form Edit Material Requests</h5>

        <div class="form-group col-lg-4">
            <label for="material_no">Material No.</label>
            <input type="text" name="material_no" class="form-control" placeholder="Material No." value="{{$material->material_no}}" readonly>
        </div>

        <div class="form-group col-lg-4">
            <label for="request">Request By</label>
            <input type="hidden" name="request" class="form-control" value="{{ $material->requestMaterial->id }}">
            <input type="text" class="form-control" value="{{ $material->requestMaterial->name }}">
        </div>

        <div class="form-group col-lg-4">
            <label for="destination">Destination Refrence</label>
            <select name="destination" id="destination" class="form-control" required>
                {{-- <option value="{{ $material->destination }}" selected>{{ $material->destination }}</option> --}}
                @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}" {{ $warehouse->id }}=={{ $material->destination }} ? selected : ''>
                        {{ $warehouse->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-4">
            <label for="scheduledate">Schedule Date</label>
            <input type="date" class="form-control" id="scheduledate" name="schedule"
                value="{{ $material->schedule }}"required>
        </div>

        <div class="form-group col-lg-4">
            <label for="expirydate">Expiry Date</label>
            <input type="date" class="form-control" id="expirydate" name="expired"
                value="{{ $material->expired }}"required>
        </div>
        <hr>
        {{-- <h5 class="mb-4 btn btn-success add_item-btn"">Add Item</h5> 

<div id="show_item">
    @if (count($detailmaterials) != null)
    @foreach ($detailmaterials as $index => $detailmaterial)
    <div class="row"> 
        <div class="row col-md-4 mb-3">
            <input type="text" name="product[]" class="form-control" placeholder="Product Name" required value="{{ $detailmaterial->product }}">
        </div>

        <div class="row col-md-2 mb-3 mx-1">
            <input type="number" name="qty[]" class="form-control" placeholder="Quantity" required  value="{{ $detailmaterial->qty }}">
        </div>

        <div class="row col-md-4 mb-3">
            <input type="text" name="description[]" class="form-control" placeholder="Description"  value="{{ $detailmaterial->description }}">
        </div>
        
        <div class="col-md-1 mb-3 d-grid">
            <button class="btn btn-danger remove_item_btn">-</button>
        </div>
    </div>
    @endforeach
    @endif
</div>
</form> --}}

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
                <tbody id="show_item"></tbody>
                @foreach ($detailmaterials as $detailmaterial)
                    <tr>
                        <td>
                            <input type="text" name="product[]" class="form-control"
                                value="{{ $detailmaterial->product }}">
                        </td>
                        <td>
                            <textarea class="form-control" name="description[]" id="description" style="resize: none"
                                value="{{ $detailmaterial->descripton }}"></textarea>
                        </td>
                        <td>
                            <input type="number" name="qty[]" class="form-control" value="{{ $detailmaterial->qty }}">
                        </td>
                        <td>
                            <button class="btn btn-danger remove_item_btn">-</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{-- </form> --}}
            <!-- END Datatable -->
        </div>
    </form>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script>
        $(document).ready(function() {
            $(".add_item-btn").click(function(e) {
                e.preventDefault();
                $("#show_item").append(
                    `
            <tr>
                      <td>
                    <input type="text" name="product[]" class="form-control">
                     </td>
                     <td>
                       <textarea class="form-control" name="description[]" id="description" style="resize: none"></textarea>
                     </td>
                     <td>
                       <input type="number" name="qty[]" class="form-control">
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
        });
    </script>
@endsection
