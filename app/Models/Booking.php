<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon as Time;

class Booking extends Model
{
	protected $guarded = [];

	public function BookingServices(){
      return $this->hasMany(BookingService::class);
    }
    public function BookingStatus(){
      return $this->hasMany(BookingStatus::class);
    }
    public function BookingVideos(){
      return $this->hasMany(VideoRecoding::class);
    }
    public function BookingStatusCurrentStatus(){
      return $this->hasOne(BookingStatus::class,'booking_id','id')->latest();
    }
    public function AssiagnBeauticianInfo(){
      return $this->hasOne(User::class,'booking_id','id')->latest();
    }
    public function ServiceDetails()
    {
      return $this->belongsToMany(Service::class,BookingService::class,'booking_id','service_id')->withPivot('type'); 
    }
    public function BookingAssign()
    {
      return $this->belongsToMany(User::class,BookingAssign::class,'booking_id','assign_user_id')->withPivot('id','temperature','commission','assign_user_id','Temperature_image'); 
    }
    public function BookingCommission()
    {
      return $this->hasMany(WorkHistory::class); 
    }
    public function UserBookingCommission()
    {
      return $this->hasOne(WorkHistory::class); 
    }
    public function get_user()
    {
    	return $this->belongsTo(User::class,"customer_id","id");
    }
    public function BookingUsers()
    {
      return $this->belongsToMany(User::class,BookingUser::class)->withPivot('id','temperature','Temperature_image');
    }
    public function GetAssiagnBeautician()
    {
    	return $this->belongsTo(User::class,"employee_id","id");
    }
    public function BookingCancelReason(){
       return $this->hasOne(BookingCancelReason::class)->latest();
   }
}
