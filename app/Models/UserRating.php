<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;
    protected $fillable = ['rating','sender_id','receiver_id','comment','booking_id'];

    public function receiver()
    {
		return $this->belongsTo(User::class,'receiver_id');

    }

     public function sender()
    {
		return $this->belongsTo(User::class,'sender_id');

    }
}
