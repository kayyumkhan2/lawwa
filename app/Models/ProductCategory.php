<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {

    protected $guarded = [];

    public function categoryDetails() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function ProductDetails() {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
