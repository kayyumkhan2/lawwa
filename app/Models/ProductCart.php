<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
	protected $table = 'product_cart';
    protected $fillable = ['product_id','user_id','quantity','size','color'];

    public function ProductDetails() {
        return $this->belongsTo(Product::class);
    }  
}
