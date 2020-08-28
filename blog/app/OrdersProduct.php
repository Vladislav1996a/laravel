<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    public function prod(){
        return $this->belongsTo('App\Product','product_id','id');
    }
    protected $table = 'orders_product';
}
