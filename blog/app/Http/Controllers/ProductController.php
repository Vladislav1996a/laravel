<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   

   public function product(){
      $products = Product::paginate(13);
    return view('product',[
         'products' => $products
      ]);
   }
}
