<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,HasRoles;
    // use SoftDeletes;
    protected $dates = ['deleted_at'];        
    protected $fillable = [
        'full_name',
        'profile_pic',
        'Address_Location',
        'phone_no',
        'password',
        'email_verified_at',
        'email',
        'access_token',
        'avatar ',
        'provider',
        'provider_id',
        'status',
    ];

    public function UserFreeServices()
    {
        return $this->hasMany(UserFreeService::class);
    }
    public function UserCurrentMemberShip(){
       return $this->hasOne(MembershipUser::class)->where('payment_status','SUCCESS')->latest();
    }
    public function HealthConditionStatus(){
       return $this->hasOne(HealthCondition::class)->latest();
    }
    public function BeauticianDocs(){
        return $this->hasOne(BeauticianDoc::class);
    }
    public function BeauticianServices(){
        return $this->hasMany(BeauticianService::class);
    }
    public function UserProfileInformation(){
        return $this->hasOne(ProfileInformation::class);
    }
    public function UserBookings()
    {
        return $this->belongsToMany(Booking::class,BookingUser::class);
    }
    public function UserReviewGet(){
        return $this->hasMany(UserRating::class,'receiver_id');
    }
    public function UserReviewSend(){
        return $this->hasMany(UserRating::class,'sender_id');
    }
    public function ProductCarts()
    {
        return $this->belongsToMany(Product::class,ProductCart::class)->withPivot('quantity','size', 'color');
    }
    public function MyFavouriteList()
    {
        return $this->hasMany(MyFavourite::class);
    }
    public function BookingAssign()
    {
        return $this->belongsToMany(Booking::class,BookingAssign::class,'assign_user_id','booking_id')->withPivot('id','temperature','booking_id','assign_user_id'); 
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
