<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentFeature extends Model
{
    use HasFactory;
    protected $fillable = ['feature','recruitment_id'];
}
