<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrdersProduct;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(){
        $user = Auth::user()->id;

        $orderProduct = DB::table('orders_product')
        ->join('products', 'products.id', '=', 'orders_product.product_id')
        ->get();

        $sort = DB::table('orders')->where('status', '0')->where('user_id', $user)->first();
       
        return view('cart',[
            'orderProduct' => $orderProduct,
            'user_id'=>$sort,
        ]);
    }

       public function cartAdd(Request $request){

        $productId = $request['productId'];
        $userId = Auth::user()->id;


        $orderTest = DB::table('orders')->where('status', '0')->where('user_id', $userId)->first();
        
        $order = new Order();
        $order->status = 0;
        $order->user_id = $userId;
       
        if(is_null($orderTest)){
            $order->save();
        }

        $orderDB =DB::table('orders')
        ->orderBy('id', 'desc')
        ->first();

        $orderId = $orderDB->id;
        $orderProduct = new OrdersProduct();

        $orderProduct->product_id = $productId;

        $orderProduct->order_id = $orderId;

       
        $orderProduct->save();


        
        

        //  получить user_id +
        // найти order по user_id и по status==0+
        // если такого order  нет то создать+
        // поискать order_product по  order_id и product_id
        // если такого order_product - нет то мы его создаем
    }
}

