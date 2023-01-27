<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'title',
        'phone_no',
        'image',
        'categorey_type',
        'parent_id',
    ];

     public function subcategory(){
        return $this->hasMany(Category::class,'parent_id')->select(['parent_id', 'name', 'image', 'id']);
    }
    public function ServiceDetails() {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function getparent()
    {   
        return $this->belongsTo(Category::class, 'parent_id','id' );
    }
    public function CategoryService()
    {
        return $this->belongsToMany(Service::class,ServiceCategory::class); 
    }
    public function CategoryProduct() {
        return $this->belongsToMany(Product::class,ProductCategory::class);
    }
}
