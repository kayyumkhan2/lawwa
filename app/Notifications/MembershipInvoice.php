<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\{MembershipPlan,MembershipUser};
use Auth;
class MembershipInvoice extends Notification implements ShouldQueue
{
    use Queueable;

    public  $Membership;

    public  function __construct(MembershipPlan $Membership)
    {
       return $this->Membership = $Membership;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    
    public function toMail($notifiable)
    {
        $MembershipUser = MembershipUser::where("membership_plan_id","=",$this->Membership->id)->where("user_id","=",Auth::id())->latest()
                        ->first();
        return (new MailMessage)->view(
          'emails.membership.invoice', ['Membership' => $this->Membership,'MembershipUser'=>$MembershipUser]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
