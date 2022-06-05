<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class State extends Model
{
    public function restaurant(){
        return $this->hasOne(Restaurant::class,'state_id','id');
    }
    public function restaurants(){
        return $this->hasMany(Restaurant::class,'state_id','id');
    }
}
