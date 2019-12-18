<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAccount extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
