<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
  protected $fillable = ['user_name', 'products', 'total_price','total_quantity','user_id','address','txn_id','ShippingCharges','address_type','tracking_id','shipping_option'];

	public function get_address(){
        return $this->belongsTo(Address::class, 'address_id');
  }
	public function OrderStatus(){
       return $this->hasMany(OrderStatus::class);
  }
  public function OrderCurrentStatus(){
       return $this->hasOne(OrderStatus::class,'order_id','id')->latest();
  }
	public function get_user(){
		return $this->belongsTo(User::class,'user_id');
  }
	public function OrderCancelReason(){
       return $this->hasOne(OrderCancelReason::class)->latest();
  }
	public function BookingStatusCurrentStatus(){
       return $this->hasOne(BookingStatus::class,'booking_id','id')->latest();
  }
	public function OrderProducts(){
        return $this->hasMany(OrderProduct::class);
  }   
}