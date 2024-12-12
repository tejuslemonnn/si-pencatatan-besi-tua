@extends('sb-admin/app')
@section('title', 'Edit Product')
    
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>

    <form action="{{ route('updateProduct', ['productId' => $product->id]) }}" method="POST" id="add_form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
            <input type="text" name="name" class="form-control" placeholder="Product Name" value="{{ $product->name }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group" method="POST">
            <label for="productcode">Product code</label>
            <input type="text" name="code" class="form-control" placeholder="Product code" value="{{ $product->code }}">
        </div>
    </div>
</div>

<div class="from-group row">
    <div class="col-lg-4">Picture</div>

    <div class="row">
        <div class="col-lg-4">
            <div class="col-lg-4">
                <img src="{{ asset('storage/product-img/'.$product->image) }}" alt="{{ $product->image }}" class="img-thumbnail" id="preview-image">
            </div>
            <div class="col-sm-9">
                <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose File</label>
                </div>
            </div>
        </div>
    </div>

<hr>
<h5 class="mb-4 text-gray-800">General Information</h5>
<hr>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="price">Sales Price</label>
            <input type="text" name="price" class="form-control" value="{{ $product->price }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="qty">QTY</label>
            <input type="number" name="qty" class="form-control" value="{{ $product->qty }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control col-6" name="description"id="description">{{ $product->description }}</textarea>
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

