<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileInformation extends Model
{
  protected $table = 'profile_informations';
  protected $fillable = ['Longitude','Latitude','Dob','Gender','User_id','About_us','Photo','Nric','Emergency_Number','Id_Proof'];
 

}
