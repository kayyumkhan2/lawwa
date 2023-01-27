<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;
     protected $fillable = [
        'booking_id',
        'service_id',      
        'type',      
    ];

    public function ServiceDetails() {
        return $this->belongsTo(Service::class,'id','service_id');
    }

    public function Serviceinfo() {
        return $this->belongsTo(Service::class,'service_id','id');
    }    

}
