<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryNews extends Model
{
	protected $table = "gallery_news";
	protected $fillable = ['heading','image','content'];
    use HasFactory;
}
