<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ServiceCart extends Model
{
	protected $table = 'service_cart';
    protected $fillable = ['service_id','user_id','type'];

    public function ServiceDetails() {
        return $this->belongsTo(Service::class, 'service_id');
    }  
}
