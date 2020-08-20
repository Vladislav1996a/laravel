<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class indexController extends Controller
{
    public function dom()
    {
        $products = Product::all();
        return view('dom',[
            'products' => $products
        ]);
    }

}
