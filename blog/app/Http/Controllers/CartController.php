<?php

namespace App\Http\Controllers;

use App\Order;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        return view('cart');
    }

       public function cartAdd(Request $request){

        $productId = $request['productId'];


        $order = new Order();
        $order->name = $productId;

        $order->save();

        //  получить user_id
    // найти jrder по user_id и по status==0
    // если такого order  нет то создать
    // поискать order_product по  order_id и product_id
    // если такого order_product - нет то мы его создаем
    }
}

