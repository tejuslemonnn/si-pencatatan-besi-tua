@extends('sb-admin/app')
@section('title', 'Create Product')
    
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Product</h1>

    <form action="/product-store" method="POST" id="add_form" enctype="multipart/form-data">
        @csrf
    <div class="mt-3">
        <a href="/product" class="btn btn-danger"><i class="fas fa-xmark"></i> Discard</a>
        <button type="submit" class="btn btn-secondary" id="add_btn"> <i class="fas fa-check"> </i>Save</button>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<hr>
<h5 class="mb-4 text-gray-800">Form Create Product</h5>


<div class="row">
    <div class="col-lg-4">
        <div class="form-group" method="POST">
            <label for="productname">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Product Name">
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-lg-4">
        <div class="form-group" method="POST">
            <label for="productcode">Product code</label>
            <span class="input-group-text">MMI-</span>
            <input type="text" name="code" class="form-control" placeholder="Product code">
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="sc_no">Product No</label>
            <div class="input-group">
                <span class="input-group-text">MMI-</span>
                <input type="text" name="code" class="form-control" placeholder="Product code">
            </div>
        </div>
    </div>
</div>

<div class="from-group row">
    <div class="col-lg-4">Picture</div>

    <div class="row">
        <div class="col-lg-4">
            <div class="col-lg-4">
                <img src="img/placeholder.png" class="img-thumbnail" id="preview-image">
            </div>
            <div class="col-sm-9">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose File</label>
                </div>
            </div>
        </div>
    </div>

{{-- <hr>
<h5 class="mb-4 text-gray-800">General Information</h5>
<hr> --}}
<hr>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="price">Sales Price</label>
            <input type="text" name="price" class="form-control" value="Rp.">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="qty">QTY</label>
            <input type="number" name="qty" class="form-control" min="0" value="0">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control col-6" name="description"id="description"></textarea>
 </div>

    </form>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <script>
         $(document).ready(function() {
        $('#image').on('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-image').attr('src', e.target.result);
                    $('#preview-image').css('width', '265px');
                    $('#preview-image').css('height', 'auto');
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
    </script>
@endsection

