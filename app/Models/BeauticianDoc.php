<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeauticianDoc extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc',
        'name',
        ];
}
