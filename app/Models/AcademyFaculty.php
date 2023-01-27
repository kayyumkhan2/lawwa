<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyFaculty extends Model
{
    use HasFactory;
    protected $fillable = ['top_heading','top_content','heading','image'];
}
