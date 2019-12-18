<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //public function post(){
    //    return $this->hasOne('App\Category');
    //}
    public function thread(){
        return $this->hasOne('App\Thread');
    }
}
