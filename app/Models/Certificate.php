<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = ['heading','image','price','description'];
    public function CertificateFeature(){
        return $this->hasMany(CertificateFeature::class,'certificate_id','id');
    }
}
