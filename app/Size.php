<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table ='sizes';
    protected $primaryKey = 'id';
    function product(){
        return $this->belongsToMany('App\Product', 'product_sizes', 'product_id');
    }
}