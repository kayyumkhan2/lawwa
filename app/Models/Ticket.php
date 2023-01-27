<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	
    protected $fillable = [
    	'user_id', 'category_id', 'ticket_id', 'title', 'priority', 'message', 'status','user_name','user_info'
    ];

    
	public function user()
    {
    	return $this->belongsTo(User::class);
    }

   
    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

   
    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }
}
