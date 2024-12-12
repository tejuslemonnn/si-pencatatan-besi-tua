@extends('sb-admin/app')
@section('title', 'Product')
    
@section('content')
    <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Product</h1>
        <div class="mt-3">
            <a href="/create-product" class="btn btn-secondary">Add Product</a>
        </div>
        <br>
	<div>
			<div class="row g-3">

                <div class="col-4">
				<a href="#">
					<div class="card" style="width: 100%; height: 197px;">
						<img src="img/bmth.png" class="card-img-top h-50" style="width: 30%"  >
						<div class="card-body">
							<h5 class="card-title font-weight-bold fs-3 text-capitalize text-dark">Baut</h5>
							<h5 class="text-danger fs-6 mb-3">Rp.15000</h5>									
						</div>			
					</div>
				</a>
				</div>
				
                <div class="col-4">
					<div class="card" style="width: 100%; height: 197px;">
						<img src="img/bmth.png" class="card-img-top h-50" style="width: 30%" >
						<div class="card-body">
							<h5 class="card-title font-weight-bold fs-3 text-capitalize text-dark">Baut</h5>
							<h5 class="text-danger fs-6 mb-3">Rp.15000</h5>		
						</div>
					</div>
				</div>		

                <div class="col-4">
					<div class="card" style="width: 100%; height: 197px;">
						<img src="img/bmth.png" class="card-img-top h-50" style="width: 30%" >
						<div class="card-body">
							<h5 class="card-title font-weight-bold fs-3 text-capitalize text-dark">Baut</h5>
							<h5 class="text-danger fs-6 mb-3">Rp.15000</h5>		
						</div>
					</div>
				</div>			

                <div class="col-4">
					<div class="card" style="width: 100%; height: 197px;">
						<img src="img/bmth.png" class="card-img-top h-50" style="width: 30%" >
						<div class="card-body">
							<h5 class="card-title font-weight-bold fs-3 text-capitalize text-dark">Baut</h5>
							<h5 class="text-danger fs-6 mb-3">Rp.15000</h5>		
						</div>
					</div>
				</div>	
						
			</div>

            {{-- <div class="row">	
				<div class="col-4">
					<div class="card" style="width: 18rem;">
						<img src="img/bmth.png" class="card-img-top" >
						<div class="card-body">
							<h5 class="card-title font-weight-bold fs-3 text-capitalize text-dark">Baut</h5>
							<h5 class="text-danger mb-3">Rp.15000</h5>		
						</div>
					</div>
				</div>		
			</div> --}}
    </div>
		





	{{-- <?php foreach($produk as $row) : ?> --}}
            {{--<?php endforeach; ?> --}}




      {{--   <div class="container">
            <div class="image">
                <img src="img/bmth.png" alt="">
            </div>
            <div class="namePrice">
                <h3>Baut</h3>
                <span>Price : 15000</span>
            </div>
            <div class="count"></div>
                <span>count : 100</span>
        </div> --}}




      {{--   <div class="card" style="width: 18rem;">
            
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
 --}}
@endsection