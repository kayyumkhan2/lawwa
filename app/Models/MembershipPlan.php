<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;
    protected $fillable = ['price','name'];

    public function MembershipFeatures()
	{
	    return $this->belongsToMany(MembershipFeature::class,MembershipHasFeature::class);
	}
	public function MemberShipServices()
	{
	    return $this->belongsToMany(Service::class,MemberShipService::class);
	}
	public function MembershipFeaturesList(){
       return $this->hasMany(MembershipHasFeature::class);
    }

}
