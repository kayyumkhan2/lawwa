<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;
    protected $fillable = ['heading','content'];
     public function RecruitmentFeature(){
        return $this->hasMany(RecruitmentFeature::class,'recruitment_id','id');
    }
}
