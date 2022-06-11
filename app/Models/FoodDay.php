<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodDay extends Model
{
    protected $table = 'food_days';
    public $timestamps = false;
    
    public function food(){
        return $this->hasMany(Food::class, 'food_id');
    }
}
