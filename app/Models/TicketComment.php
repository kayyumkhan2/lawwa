<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
	protected $fillable = [
		'ticket_id', 'user_id', 'comment','user_name'
	];   
    public function ticket()
    {
    	return $this->belongsTo(Ticket::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
