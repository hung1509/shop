<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='products';
    protected $primaryKey = 'id';
    function category(){
        return $this->belongsTo('App\Category');
    }
    function brand(){
        return $this->belongsTo('App\Brand');
    }
    function size(){
        return $this->belongsToMany('App\Size', 'product_sizes', 'product_id', 'size_id');
    }
}