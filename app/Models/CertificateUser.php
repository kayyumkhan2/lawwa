<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateUser extends Model
{
    use HasFactory;
    protected $fillable = ['amount','certificate_name','user_id','certificate_id','txn_id','payment_status','status'];
    public function CertificateInfo(){
        return $this->belongsTo(AcademyCourse::class,'certificate_id','id');
    }
    public function UserInfo(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
