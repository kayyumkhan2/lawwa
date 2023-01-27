<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
 	protected $table = 'user_address';
 	protected $fillable = ['Name','MobileNumber','Country','State_Province_Region','Town_City','Zip_Postcode','Type','Address_line1','Address_line2','Longitude','Latitude','user_id'];
 	
 	public function GetCity()
    {
	   return $this->belongsTo(City::class,'Town_City','id');
    }
    public function GetCountry()
    {
	   return $this->belongsTo(Country::class,'Country','id');
    }
	public function GetState()
    {
	   return $this->belongsTo(State::class,'State_Province_Region','id');
    }
 

}
