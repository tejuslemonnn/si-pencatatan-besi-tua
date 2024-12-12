@extends('sb-admin/app')
@section('title', 'Create Material Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Material Request</h1>


    <form action="/materialreq-store" method="POST" id="add_form">
        @csrf
        <div class="mt-3">
            <a href="/materialreq" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
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
        <h5 class="mb-4 text-gray-800">Form Create Material Requests</h5>

        <div class="from-group col-lg-4">
            <label for="material_no">Material No.</label>
            <div class="input-group">
                <span class="input-group-text">M-</span>
                <input type="text" name="material_no" class="form-control" placeholder="Material No."
                    value="{{ old('material_no') }}">
            </div>
        </div>


        <div class="form-group col-lg-4">
            <label for="request">Request By</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
            <input type="hidden" name="request" class="form-control" value="{{ auth()->user()->id }}" readonly>
        </div>

        <div class="form-group col-lg-4">
            <label for="destination">Destination Refrence</label>
            <select name="destination" id="destination" class="form-control" required>
                <option value="" selected>Select</option>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tbody id="show_item">
                    @if (old('product'))
                        @foreach (old('product') as $index => $product)
                            <tr>
                                <td>
                                    <input type="text" name="product[]" class="form-control" value="{{ $product }}">
                                </td>
                                <td>
                                    <textarea class="form-control" name="description[]" id="description"
                                        style="resize: none">{{ old('description.' . $index) }}</textarea>
                                </td>
                                <td>
                                    <input type="number" name="qty[]" class="form-control"
                                        value="{{ old('qty.' . $index) }}">
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

{{-- // $(document).ready(function(){
    //     $(".add_item-btn").click(function(e){
    //         e.preventDefault();
    //         $("#show_item").prepend(`<div class="row append_item"> 
    //         <div class="row col-md-4 mb-3">
    //             <input type="text" name="product[]" class="form-control" placeholder="Product Name" required>
    //         </div>
    
    //         <div class="row col-md-2 mb-3 mx-1">
    //             <input type="number" name="qty[]" class="form-control" placeholder="Quantity" required>
    //         </div>

    //         <div class="row col-md-4 mb-3">
    //             <input type="text" name="description[]" class="form-control" placeholder="Description">
    //         </div>

    //         <div class="col-md-1 mb-3 d-grid">
    //             <button class="btn btn-danger remove_item_btn">-</button>
    //         </div>
    //     </div>`);
    //     }); --}}



{{-- <div class="form-group col-lg-4">
    <label for="Product">Product</label>
    <input type="text" name="product" class="form-control">
</div>

<div class="form-group col-lg-4">
    <label for="QTY">QTY</label>
    <input type="text" name="qty" class="form-control">
</div>

<div class="form-group col-lg-4">
    <label for="description">Description</label>
    <textarea class="form-control" name="description"id="description"></textarea>
</div> --}}




{{-- <hr>
<h5 class="mb-4 text-gray-800">Add Item</h5>
<div class="card-body">
    <form action="#" method="POST" id="add_form"></form>
    <div id="show_item">
        <div class="row"> 
            <div class="row- col-md-4 mb-3">
                <input type="text" name="product" class="form-control" placeholder="Product Name" required>
            </div>
    
            <div class="row col-md-2 mb-3">
                <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
            </div>

            <div class="row col-md-4 mb-3">
                <input type="text" name="description" class="form-control" placeholder="Descriptiion" required>
            </div>

            <div class="col-md-1 mb-3 d-grid">
                <button class="btn btn-success add_item-btn">+</button>
            </div>
        </div>
    </div>
</div> --}}


{{-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
            Add Item
        </button>
 <div class="portlet-body">
    
    <form action="#" method="POST">
        <!-- Button trigger modal -->    
        <table id="table" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Request By</th>
                    <th>Product</th>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>Destination Warehouse</th>
                    <th>Schedule Date</th>
                    <th>Expierd Date</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @php
                      $no = 1;   
                    @endphp
                     @foreach ($data as $row)
                     <tr>
                         <td>{{ $no++ }}</td>
                         <td>{{ $row->request }}</td>
                         <td>{{ $row->product }}</td>
                         <td>{{ $row->description }}</td>
                         <td>{{ $row->qty }}</td>
                         <td>{{ $row->destination }}</td>
                         <td>{{ $row->schedule }}</td>
                         <td>{{ $row->expired }}</td>
                         <th>
                             <button type="button" class="additem btn btn-success">+</button>
                            <form action="#" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </form>
                         </th>
                     </tr>
                    @endforeach
                 </tbody>
        </table>
    </form> --}}
<!-- END Datatable -->
{{-- </div> --}}

{{-- Modal --}}
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Data Material Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form action="/materialreq-create" method="POST">
                @csrf
            
                <div class="form-group">
                    <label for="Product">Product</label>
                    <input type="text" name="product" class="form-control">
                </div>
  
                <div class="form-group">
                    <label for="QTY">QTY</label>
                    <input type="text" name="qty" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"id="description"></textarea>
                </div>               
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary">Add Data</button>
        </div>
    </form>
    </div>
  </div>
  </div> --}}

{{-- // $("#add_form").submit(function(e){
    //     e.preventDefault();
    //     $("#add_btn").val('Adding...');
    //     $.ajax({
    //         url: 'create-material',
    //         method: 'post',
    //         data: $(this).serialize(),
    //         success: function(response){
    //             $("#add_btn").val('Add');
    //             $("#add_form")[0].reset();
    //             $(".append_item").remove();
    //             $("#show_alert").html;
    //         };
    //     });
    // }); --}}
