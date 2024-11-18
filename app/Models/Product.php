<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
