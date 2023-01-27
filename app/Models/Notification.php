<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = ['title', 'description','sender_id','receiver_id','type','for','notification_id','data'];
	
	public function NotificationAttachments(){
	       return $this->hasOne(NotificationAttachment::class)->latest();
	}
	public function UserInfo(){
	       return $this->hasOne(User::class,'id','receiver_id');
	}
}
