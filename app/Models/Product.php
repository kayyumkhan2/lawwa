<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Product extends Model
{
    protected $hidden = ['pivot'];
	protected $fillable = ['name', 'description','price','image','product_id','status','member_price','sale_price','product_thumbnail','product_type','unit_type','unit'];
    public  function getFullNameAttribute($value) {
        return sprintf('%s %s', $this->name, $this->ProductAttribute);
    }
    
    public function getsalepriceAttribute($value){
        if (!Auth::guest())
        {
            if(MemberShipStatusCheck()){
                return  $this->attributes['sale_price'] = $this->attributes['member_price'];    
            }
            else{
                return  $this->attributes['sale_price'] = $this->attributes['sale_price'];    
            } 
        }
        else
        {
            return  $this->attributes['sale_price'] = $this->attributes['sale_price'];    
        }
    }
    public function ProductAttribute(){
        return $this->belongsToMany(AttributeValue::class,ProductAttribute::class,'product_id','attribute_id')->withPivot('attribute_type','unit_value','id','unit_sale_price');
    }
    public function categoriesdata(){
        return $this->belongsToMany(Category::class,ProductCategory::class,'product_id','category_id');
    }
    public function category(){
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function ProductCategory(){
        return $this->hasMany(ProductCategory::class);
    }
    public function ProductCart(){
        return $this->hasOne(ProductCart::class);
    }
    public function Productimages(){
        return $this->hasMany(ProductImage::class);
    }
    public function ProductSize(){
        return $this->hasMany(ProductSize::class);
    }
    public function ProductColor(){
        return $this->hasMany(ProductColor::class);
    }
    public function ProductReviewRatings(){
        return $this->hasMany(ProductReviewRating::class,'product_id');
    }
    protected $guarded = [];
}