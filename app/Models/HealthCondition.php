<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCondition extends Model
{
    use HasFactory;
    protected $fillable = ['Name','Name_type','Address','H_p_no','Dob','Marital_status','Occupation','Emergency_number','Plastic_Surgery_Face','Plastic_Surgery_Date_Face','Plastic_Surgery_Type_Face','Plastic_Surgery_Body','Plastic_Surgery_Date_Body','Plastic_Surgery_Type_Body','Pregnant','Pregnancy_Month','Medications','Medications_Specify','Skin_Allergy','Skin_Allergy_Specify','Skin_Type_Specify','Service_Focus','Service_Focus_Remark','','Last_Facial_Treatment','Last_Facial_Treatment_date','Last_Facial_Treatment_Type','Last_Facial_Treatment_How_Often','Skincare_Routine_At_Home','Skincare_Routine_At_Specify','Product_Brand_Use','Last_Body_Treatment','Last_Body_Treatment','Last_Body_Treatment_Type','Last_Body_Treatment_How_Often','Body_Allergy_Sensitive','Body_Allergy_Sensitive_Specify','Joint_Condition','Joint_Condition_Specify','Bone_Condition','Bone_Condition_Specify','Circulatory_Condition','Circulatory_Condition_Specify','Diabetes','Customer_Sign','user_id','Diabetes_Specify'];
}
