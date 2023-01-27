<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
     protected $fillable = [
        'product_name',
        'product_image',
		'product_price',
		'product_quantity',
		'product_id',
		'order_id',      
        'size',      
        'color',      
        'unit',      
    ];

    public function ProductDetails() {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }  

}
