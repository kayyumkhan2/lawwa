<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyFavourite extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','user_id'];
    public function ProductDetails() {
        return $this->belongsTo(Product::class, 'product_id');
    }  
}
