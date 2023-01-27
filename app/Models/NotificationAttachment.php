<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAttachment extends Model
{
    protected $fillable = ['attachment'];
    use HasFactory;
}
