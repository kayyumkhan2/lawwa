<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;
    protected $fillable = ['title','subject','html_template','text_template','template_for','for']; 
    protected $guarded = [];
}
