<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyFacility extends Model
{
    use HasFactory;
    protected $fillable = ['content','heading','image'];
}
