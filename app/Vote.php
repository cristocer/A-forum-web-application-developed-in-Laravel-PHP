<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function thread(){
        return $this->belongsTo('App\Thread');
    }
    public function comment(){
        return $this->belongsTo('App\Comment');
    }
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
