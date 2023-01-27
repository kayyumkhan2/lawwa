<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    use HasFactory;
    protected $fillable = ['about_us_text','membership_text','contact_us_text','status','about_us_image','about_us_video'];

}
