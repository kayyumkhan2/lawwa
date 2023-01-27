<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PaymentHistory extends Model
{
		protected $table = 'payment_history';
    protected $fillable = ['amount','user_id','txn_id','type','status','ShippingCharges'];
    public function PaymentUser()
    {
		  return $this->belongsTo(User::class,'user_id','id');
    }
    public function PaymentOrder()
    {
          return $this->belongsTo(Order::class,'txn_id','txn_id');
    }
    public function PaymentBooking()
    {
          return $this->belongsTo(Booking::class,'txn_id','txn_id');
    }
    public function PaymentCertificate()
    {
          return $this->belongsTo(CertificateUser::class,'txn_id','txn_id');
    }
    public function PaymentCourse()
    {
          return $this->belongsTo(CourseUser::class,'txn_id','txn_id');
    }
}
