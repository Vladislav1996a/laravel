@extends('layouts.main')

@section('title', 'cart')

@section('content')

<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
						</tr>

						@if(!is_null($user_id))
							@foreach($orderProduct as $product)
								@if($user_id->id == $product->order_id)
									<tr class="table-row">
										<td class="column-1">
											<div class="cart-img-product b-rad-4 o-f-hidden" type='button' onclick='deleteProduct(this)' data-id='{{$product->id_order_prod}}'>
												<img src="images/item-05.jpg" alt="IMG-PRODUCT">
											</div>
											@csrf
										</td>
										<td class="column-2">{{$product->title}}</td>
										<td class="column-3 price">${{$product->price}}</td>
										<td class="column-4">
											
									</tr>
								@endif
							@endforeach
						@else
							<div>Корзина пуста</div>
						@endif
					</table>
					
				</div>
			</div>
				<div class="size10 trans-0-4 m-t-10 m-b-10">
					
				</div>
			</div>
		</div>
		<div id='pay' class='d-flex justify-content-center'></div>
		<button class='size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4' onclick='price()'>updata price</button>
	</section>
<section>
<div class="container">
		<div class='row'>
			<div class='col-md-4'></div>
			<div class='col-md-4'>
				<script src='https://js.stripe.com/v2/' type='text/javascript'></script>
				<form accept-charset="UTF-8" action="/cart/pay" class="require-validation"
					data-cc-on-file="false"
					data-stripe-publishable-key="pk_test_51HJeyQKd10q33ok4nnopI33pPpbMSIQ2XkaLpjxt4nlS9mGPrnw8olcckoD444dKTuSJgZ1zzLzNIYDpv9QAhaA1005S2PYg1g"
					id="payment-form" method="POST">
					{{ csrf_field() }}
					<div class='form-row'>
						<div class='col-xs-12 form-group required w-100'>
							<label class='control-label'>Name on Card</label> <input
								class='form-control border w-100' size='4' type='text'>
						</div>
					</div>
					<div class='form-row'>
						<div class='col-xs-12 w-100'>
							<label class='control-label'>Card Number</label> <input
								autocomplete='off' class='form-control card-number border' size='20'
								type='text'>
						</div>
					</div>
					<div class='form-row'>
						<div class='col-xs-4 form-group cvc required'>
							<label class='control-label'>CVC</label> <input
								autocomplete='off' class='form-control card-cvc border'
								placeholder='ex. 311' size='4' type='text'>
						</div>
						<div class='col-xs-4 form-group expiration required'>
							<label class='control-label'>Expiration</label> <input
								class='form-control card-expiry-month border' placeholder='MM' size='2'
								type='text'>
						</div>
						<div class='col-xs-4 form-group expiration required d-flex align-items-end'>
							<label class='control-label'> </label> <input
								class='form-control card-expiry-year border' placeholder='YYYY'
								size='4' type='text'>
						</div>
					</div>
					<div class='form-row'>
						<div class='col-md-12 form-group'>
							<button class='form-control btn btn-primary submit-button'
								type='submit' style="margin-top: 10px;">Pay</button>
						</div>
					</div>
				</form>
				@if ((Session::has('success-message')))
				<div class="alert alert-success col-md-12">{{
					Session::get('success-message') }}</div>
				@endif @if ((Session::has('fail-message')))
				@endif
			</div>
			<div class='col-md-4'></div>
		</div>
	</div>

</section>
@endsection

@section('custom_js')
<script src="js/ajax/deleteProduct.js"></script>
<script src="js/price.js"></script>
<script
		integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
		crossorigin="anonymous"></script>
	<script>
		$(function() {
			  $('form.require-validation').bind('submit', function(e) {
			    var $form         = $(e.target).closest('form'),
			        inputSelector = ['input[type=email]', 'input[type=password]',
			                         'input[type=text]', 'input[type=file]',
			                         'textarea'].join(', '),
			        $inputs       = $form.find('.required').find(inputSelector),
			        $errorMessage = $form.find('div.error'),
			        valid         = true;
			    $errorMessage.addClass('hide');
			    $('.has-error').removeClass('has-error');
			    $inputs.each(function(i, el) {
			      var $input = $(el);
			      if ($input.val() === '') {
			        $input.parent().addClass('has-error');
			        $errorMessage.removeClass('hide');
			        e.preventDefault(); // cancel on first error
			      }
			    });
			  });
			});
			$(function() {
			  var $form = $("#payment-form");
			  $form.on('submit', function(e) {
			    if (!$form.data('cc-on-file')) {
			      e.preventDefault();
			      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
			      Stripe.createToken({
			        number: $('.card-number').val(),
			        cvc: $('.card-cvc').val(),
			        exp_month: $('.card-expiry-month').val(),
			        exp_year: $('.card-expiry-year').val()
			      }, stripeResponseHandler);
			    }
			  });
			  function stripeResponseHandler(status, response) {
			    if (response.error) {
			      $('.error')
			        .removeClass('hide')
			        .find('.alert')
			        .text(response.error.message);
			    } else {
			      // token contains id, last4, and card type
			      var token = response['id'];
			      // insert the token into the form so it gets submitted to the server
			      $form.find('input[type=text]').empty();
			      $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
			      $form.get(0).submit();
			    }
			  }
			})
		</script>
@endsection