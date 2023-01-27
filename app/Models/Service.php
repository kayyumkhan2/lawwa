<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
	
	
	  protected $fillable = [
        'name',
        'service_image',
        'status',
        'price',
        'houre',
        'minute',
        'amount',
        'brief_detail',
        'UserId',
    ];

    public function ServiceCategory(){
        return $this->hasMany(ServiceCategory::class);
    }
    public function Service(){
        return $this->belongsTo(Service::class);
    }
    public function ServiceCategories(){
        return $this->belongsToMany(Category::class,ServiceCategory::class,'service_id','category_id');
    }
    
}
