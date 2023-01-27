<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeauticianGallery extends Model
{
    use HasFactory;
    protected $table = 'beautician_gallery';
     protected $fillable = [
        'user_id',      
        'image',      
    ];

}
