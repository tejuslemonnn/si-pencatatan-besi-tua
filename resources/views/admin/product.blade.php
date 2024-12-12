@extends('sb-admin/app')
@section('title', 'Product')
    
@section('content')
    <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Product</h1>
		@if ( auth()->user()->role != "admin_pengajuan")
        <div class="mt-3">
            <a href="/create-product" class="btn btn-secondary"><i class="fas fa-plus"></i> Add Product</a>
        </div>
		@endif
        <br>
			<div class="row g-3 mb-2">					
                @foreach ($data as $row)	
                <div class="col-4 ">
					<a href="/view-product/{{ $row->id }}" class="text-decoration-none">
					<div class="card  shadow" style="width: 100%; height: 197px; ">
						<img src="{{ asset('storage/product-img/'.$row->image) }}" alt="{{ $row->image }}" class="card-img-top h-50" style="width: 30%"  >
						<div class="card-body">
							<h5 class="card-title font-weight-bold fs-3 text-capitalize text-dark">{{ $row->name }}</h5>
							<h5 class="text-danger fs-6 mb-3">Stock on hand : {{ $row->qty }}</h5>		
						</div>
					</div>
					</a>
				</div>
				@endforeach
			</div>

{{ $data->links() }}
@endsection