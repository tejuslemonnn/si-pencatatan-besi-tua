@extends('sb-admin/app')
@section('title', 'Create Material Request')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('data-kapal.store') }}" method="POST" id="add_form">
        @csrf

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
        <div class="d-flex justify-content-lg-end">
            <div>
                <a href="{{ route('data-kapal.index') }}" class="btn btn-danger mr-2"> <i class="fas fa-arrow-left"> </i>
                    Back</a>
                <button type="submit" class="btn btn-primary" id="add_btn"> <i class="fas fa-check"> </i>Save</button>
            </div>
        </div>

        <div class="from-group col-12 my-2">
            <label for="nama_kapal">Nama Kapal</label>
            <div class="input-group">
                <input type="text" name="nama_kapal" class="form-control" placeholder="Nama Kapal"
                    value="{{ old('nama_kapal') }}">
            </div>
        </div>


        <div class="form-group col-12">
            <label for="tanggal_datang">Tanggal Datang</label>
            <input type="date" class="form-control" id="tanggal_datang" name="tanggal_datang"
                value="{{ old('tanggal_datang') }}" required>
        </div>

        <hr>


    </form>

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
                    <th>tanggal_datang Date</th>
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
                         <td>{{ $row->tanggal_datang }}</td>
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
