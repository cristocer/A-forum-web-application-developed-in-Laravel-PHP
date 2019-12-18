<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function thread(){
        return $this->belongsTo('App\Thread');
    }
    public function votes(){
        return $this->hasMany('App\Vote');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

}
