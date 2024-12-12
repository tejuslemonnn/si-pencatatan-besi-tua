@extends('sb-admin/app')
@section('title', 'Detail Product')
    
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Product</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="/delete-product/{{ $product->id }}" method="GET" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
<a href="{{ route('editProduct', ['productId' => $product->id]) }}" class="btn btn-primary">Edit</a>

<hr>
<h5 class="mb-4 text-gray-800">Form Detail Product</h5>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Product Name</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; {{ $product->name }}</p>
    </div>
</div>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Product Code</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; {{ $product->code }}</p>
    </div>
</div>

<div class="from-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Picture</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; </p>
    </div>

<div class="row">           
    <div class="col-lg-4">    
        <div div class="col-lg-4">
            <img src="{{ asset('storage/product-img/'.$product->image) }}" class="img-thumbnail">
        </div>                            
            
        </div>       
    </div>
</div>

<hr>
<h5 class="mb-4 text-gray-800">General Information</h5>
<hr>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Sales Price</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; {{ $product->price }} </p>
    </div>
</div>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">QTY</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; {{ $product->qty }} </p>
    </div>
</div>

<div class="form-group row col-md-10">
    <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Description</label>
    <div class="col-sm-4">
        <p style="margin-top: 6px; "> : &nbsp; {{ $product->description }} </p>
    </div>
</div>
@endsection
