<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use App\Models\Food;

class Restaurant extends Model
{
    use HasFactory;
    public function galleries()
    {
        return $this->hasMany(Gallery::class,'restaurant_id','id');
    }
    public function gallery()
    {
        return $this->hasOne(Gallery::class,'restaurant_id','id');
    }
    public function food(){
        return $this->hasOne(Food::class,'restaurant_id','id');
    }
    public function foods(){
        return $this->hasMany(Food::class,'restaurant_id','id');
    }
}
