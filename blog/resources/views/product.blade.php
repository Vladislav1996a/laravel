
@extends('layouts.main')

@section('title', 'Product')

	
@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-02.jpg);">
		<h2 class="l-text2 t-center">
			Women
		</h2>
		<p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					

					<!-- Product -->
					<div class="row">
					@foreach($products as $product)
					@php
						$image ='';

						if(count($product->images)>0){
							$image = $product->images[0]['img'];
						}
						else{
							$image = 'item-13.jpg';
						}
					@endphp
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="images/{{$image}}" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
										
												<button type='button'  data-id='{{$product->id}}' onclick="dataCard(this)"  class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
													Add to Cart
												</button>
												@csrf
											
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<div class="block2-name dis-block s-text3 p-b-5">
										{{$product->title}}
								</div>

									<span class="block2-price m-text6 p-r-5">
										{{$product->price}}
									</span>
								</div>
							</div>
						</div>
						@endforeach
					</div>

					<!-- Pagination -->
					
					<div class="pagination flex-m flex-w p-t-26">
					@if($products->total()>$products->count())
						{{$products->links()}}
					@endif
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection

@section('custom_js')
	<script src="js/ajax/dataProduct.js"></script>
@endsection