<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model {

    protected $guarded = [];
    public function categoryDetails() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ServiceDetails() {
        return $this->belongsTo(Service::class, 'service_id');
    }

}
