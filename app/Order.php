<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table ='orders';

    function product(){
        return $this->belongsToMany('App\Product', 'order_detail', 'order_id', 'product_id');
    }
}
