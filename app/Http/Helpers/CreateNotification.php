<?php
use App\Models\{User,Notification As Notifications};

function CreateNotification($type,$data,$user_id="",$description)
{
  $sender_id = User::role('Admin')->first()->id;
  $notification_id = Str::random(9);
  try {
        $user = User::findorfail($user_id);
        Notifications::create([
           'receiver_id' => $user_id,
           'notification_id' => $notification_id,
           'type' =>$type,
           'sender_id' => $sender_id,
           'description' => $description,
           'title' => "$description",
           'data' => json_encode($data),
        ]);
     } catch (Exception $e) {
        return $e;
        alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);       
     }
  
}
