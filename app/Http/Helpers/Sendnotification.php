<?php
use App\Models\{Notification,User,MailTemplate,MembershipPlan};
use App\Notifications\{BookingInvoice,MembershipInvoice,BookingNotification,OrderNotification,InvoicePaid};
function Sendnotification($type,$data,$user_id="")
{
  if (!$user_id=="") {
      try {
      $user = User::findorfail($user_id);
     } catch (Exception $e) {
        alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);       
     }
  }
  else{
    $user= Auth::user();
  }
  if ($type=="Order") {
      switch ($data->current_status) {
        case "PAYMENTFAILED":
           $MailTemplate = MailTemplate::where('template_for',"PAYMENTFAILED")->first();  
           $user->notify(new OrderNotification($data));
          break;
        case "ORDERED":
            $MailTemplate = MailTemplate::where('template_for',"ORDERED")->first();  
            $user->notify(new InvoicePaid($data));
          break;
        case "DISPATCH":
            $MailTemplate = MailTemplate::where('template_for',"DISPATCH")->first();  
            $user->notify(new OrderNotification($data));
          break;
        case "ONTHEWAY":
            $MailTemplate = MailTemplate::where('template_for',"ONTHEWAY")->first();  
            $user->notify(new OrderNotification($data));
          break;
        case "DELIVERED":
            $MailTemplate = MailTemplate::where('template_for',"DELIVERED")->first();  
            $user->notify(new OrderNotification($data));
          break;
        case "CANCEL":
            $MailTemplate = MailTemplate::where('template_for',"CANCEL")->first();  
            $user->notify(new OrderNotification($data));
          break;
        case "REFUNDED":
            $MailTemplate = MailTemplate::where('template_for',"REFUNDED")->first();  
            $user->notify(new OrderNotification($data));
          break;
        default:
        $user->notify(new OrderNotification($data));
    }
  }
     elseif ($type=="Booking") {
        switch ($data->current_status) {
        case "PaymentFailed":
            $MailTemplate = MailTemplate::where('template_for','PaymentFailed')->first();  
           $user->notify(new BookingNotification($data));
          break;
        case "Booked":
            $MailTemplate = MailTemplate::where('template_for','Booked')->first();  
            $user->notify(new BookingInvoice($data));
          break;
        case "Assigned":
            $MailTemplate = MailTemplate::where('template_for','Assigned')->first();  
            $user->notify(new BookingNotification($data,$user->roles->first()->name));
          break;
        case "Accepted":
            $MailTemplate = MailTemplate::where('template_for','Accepted')->first();  
            $user->notify(new BookingNotification($data));
          break;
        case "OnTheWay":
            $MailTemplate = MailTemplate::where('template_for','OnTheWay')->first();  
            $user->notify(new BookingNotification($data));
          break;
        case "Postponed":
            $MailTemplate = MailTemplate::where('template_for','Postponed')->first();  
            $user->notify(new BookingNotification($data));
          break;
        case "Cancel":
            $MailTemplate = MailTemplate::where('template_for','Cancel')->first();  
            $user->notify(new BookingNotification($data));
          break;
        case "Reached":
            $MailTemplate = MailTemplate::where('template_for','Reached')->first();  
            $user->notify(new BookingNotification($data));
          break;
        case "Start":
            $MailTemplate = MailTemplate::where('template_for','Start')->first();  
            $user->notify(new BookingNotification($data));
        break;
        case "Completed":
            $MailTemplate = MailTemplate::where('template_for','Completed')->first();  
            $user->notify(new BookingNotification($data));
        break;
        case "Refunded":
            $MailTemplate = MailTemplate::where('template_for','Completed')->first();  
            $user->notify(new BookingNotification($data));
          break;
        default:
        $user->notify(new BookingNotification($data));
        } 
    }
    elseif($type=="Membership"){
        $MailTemplate = MailTemplate::where('template_for','Membership')->where('for','Membership')->first();  
        $user->notify(new MembershipInvoice($data));
    }   
    $notification_id = Str::random(9);
    $sender_id = User::role('Admin')->first()->id;
    Notification::create([
        'receiver_id' => $user->id,
        'notification_id' => $notification_id,
        'type' =>$type,
        'sender_id' => $sender_id,
        'description' => "$MailTemplate->html_template",
        'title' => "$MailTemplate->subject",
        'data' => json_encode($data),
    ]);
}   