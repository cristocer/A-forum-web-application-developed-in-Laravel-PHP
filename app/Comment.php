<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function votes(){
        return $this->hasMany('App\Vote');
    }
    public function thread(){
        return $this->belongsTo('App\Thread');
    }
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
