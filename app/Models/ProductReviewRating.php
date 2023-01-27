<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviewRating extends Model
{
    use HasFactory;
    protected $fillable = ['rating','user_id','product_id','comment','order_id','title'];
    public function sender()
    {
		return $this->belongsTo(User::class,'user_id');

    }
}
