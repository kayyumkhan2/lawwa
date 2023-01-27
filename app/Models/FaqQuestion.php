<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
   protected $fillable = [
    		'question',
    		'answer',
    	];
   public function GetQuestion()
    {
        return $this->belongsTo(FaqQuestion::class,'faq_question_id','id');
    }
}
