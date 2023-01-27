<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyCourse extends Model
{
    use HasFactory;
    protected $fillable = ['heading','image','price','description','details_page_heading'];
    public function CourseFeature(){
        return $this->hasMany(CourseFeature::class,'course_id','id');
    }

}
