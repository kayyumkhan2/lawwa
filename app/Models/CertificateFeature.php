<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateFeature extends Model
{
    use HasFactory;
    protected $fillable = ['feature','certificate_id'];
}
