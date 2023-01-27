<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHistory extends Model
{
    use HasFactory;
    protected $fillable = ['services_amount','services','customer_info','commission','booking_id','status','user_id','booking_info'];
}
