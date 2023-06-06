<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';
    protected $primaryKey = 'id';
    function children(){
        return $this->hasMany('App\Category', 'parent_id');
    }
    function parent(){
        return $this->belongsTo('App\Category');
    }
    function product(){
        return $this->hasMany('App\Product');
    }
}