<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table ='brands';
    protected $primaryKey = 'id';
    function product(){
        return $this->belongsToMany('App\Product');
    }
}