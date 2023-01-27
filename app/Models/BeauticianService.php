<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeauticianService extends Model
{
    use HasFactory;
     protected $fillable = [
        'service_id',
        'user_id',      
    ];

    public function ServiceInfo(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

}
