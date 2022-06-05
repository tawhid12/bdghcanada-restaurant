<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductDetail;
use App\Models\Category;



class Food extends Model
{
    protected $table = 'foods';
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
