<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;
    protected $fillable = ['amount','course_name','user_id','course_id','txn_id','payment_status'];
    
    public function CourseInfo(){
        return $this->belongsTo(AcademyCourse::class,'course_id','id');
    }
    public function UserInfo(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
