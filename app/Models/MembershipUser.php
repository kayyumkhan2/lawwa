<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipUser extends Model
{
    use HasFactory;
    protected $fillable = ['amount','membership_plan_name','user_id','membership_plan_id','txn_id','payment_status'];
    public function MembershipInfo(){
        return $this->belongsTo(MembershipPlan::class,'membership_plan_id','id');
    }
    
}
