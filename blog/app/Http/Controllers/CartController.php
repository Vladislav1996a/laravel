<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrdersProduct;
use App\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
  
    public function cart(){
        $user = Auth::user()->id;
        $orderProduct = OrdersProduct::with('prod')->get();

        $sort = Order::where('status', '0')->where('user_id', $user)->first();
      
        return view('cart',[
            'orderProduct' => $orderProduct,
            'user_id'=>$sort,
        ]);
    }

       public function cartAdd(Request $request){

        $productId = $request['productId'];
        $userId = Auth::user()->id;

        $orderTest = Order::where('status', '0')->where('user_id', $userId)->first();
        
        $order = new Order();
        $order->status = 0;
        $order->user_id = $userId;
       
        if(is_null($orderTest)){
            $order->save();
        }

        $orderDB = Order::where('status', '0')
        ->where('user_id', $userId)
        ->first();

        $orderId = $orderDB->id;
        $orderProduct = new OrdersProduct();

        $orderProduct->product_id = $productId;

        $orderProduct->order_id = $orderId;
        $orderProduct->product_count = 1;
       
        $orderProduct->save();

        return;
        
    }

    public function cartDelete(Request $request){
        $orderId = $request['orderId'];
        OrdersProduct::where('id_order_prod', '=', $orderId)->delete();
    }

    public function cartPay(Request $request){
        $user = Auth::user()->id;
        $order = Order::where('status', '0')->where('user_id', $user)->first();
        $orderId = $order->id;
        $OrdersProd = OrdersProduct::where('order_id', $orderId)
        ->with('prod')
        ->get();

        $sum = 0;

        foreach($OrdersProd as $product){
            $sum += $product->prod->price;
        }
        \Stripe\Stripe::setApiKey ( 'add keyрипмавссампи' );
	try {
		\Stripe\Charge::create ( array (
				"amount" => $sum * 100,
				"currency" => "usd",
				"source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
				"description" => "Test payment." 
        ) );
        $status = Order::where('status', '0')->where('user_id', $user)->first();
        $status->status = 1;
        $status->save();
		\Session::flash ( 'success-message', 'Payment done successfully !' );
		return back()->withInput();
    }
        catch ( \Exception $e ) {
            dd($e->getMessage());
        }
    }
}

