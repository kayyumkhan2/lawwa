<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancelReason extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'comment',      
        'reason',      
    ];
}
