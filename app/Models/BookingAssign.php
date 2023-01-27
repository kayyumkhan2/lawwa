<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAssign extends Model
{
     use HasFactory;
    protected $fillable = ['booking_id','assign_user_id','status'];
}
