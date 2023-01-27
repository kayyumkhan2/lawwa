<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Brand extends Model {
   protected $fillable = ['name','description','brand_logo','status']; 
   protected $guarded = [];

}
