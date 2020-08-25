<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class OrderController extends Controller
{
    public function order(Request $request){
      
        $pay = $request['sum'];
        $request->session()->put('key', $pay);
        $value = $request->session()->get("key");


        \Stripe\Stripe::setApiKey ( 'sk_test_51HJeyQKd10q33ok47SkMq6MogaHhvlX4CxB5BjkdQbdkaJNKi5NCxCV6FRMTLKyyr72lZ0MHSUkfTslcOHr18r9V00Lyx7rfWX' );
	try {
		\Stripe\Charge::create ( array (
				"amount" => $value * 100,
				"currency" => "usd",
				"source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
				"description" => "Test payment." 
		) );
		\Session::flash ( 'success-message', 'Payment done successfully !' );
		// return Redirect::back ();
	} catch ( \Exception $e ) {
		\Session::flash ( 'fail-message', "Error! Please Try again." );
		// return Redirect::back ();
	}
        return view('order');
    }
}
