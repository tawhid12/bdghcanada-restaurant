<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Food::class,'category_id','id');
    }
}
