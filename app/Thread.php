<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Thread extends Model
{
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function posts(){
        return $this->hasMany('App\Post');
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
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
