<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermCondition extends Model
{
    use HasFactory;
    protected $fillable = [
    		'term',
    		'condition',
    	];
   public function GetQuestion()
    {
        return $this->belongsTo(FaqQuestion::class,'faq_question_id','id');
    }
}
