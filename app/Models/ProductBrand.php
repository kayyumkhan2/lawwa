<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model {

    protected $guarded = [];
    
    public function brandDetails() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

}
