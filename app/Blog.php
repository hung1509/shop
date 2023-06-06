<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table ='blogs';
    protected $primaryKey = 'id';
    function user(){
        return $this->hasOne('App\Member', 'id', 'user_id');
    }
}