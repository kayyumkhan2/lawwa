<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class QueryManagement extends Model {
    public $fillable = ['name', 'email', 'phone', 'subject', 'message','attachfile','type','company'];
}