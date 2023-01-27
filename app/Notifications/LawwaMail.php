<?php

namespace App\Notifications;
use App\Models\Notification as NotificationModel ;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\{NotificationAttachment};
class LawwaMail extends Notification implements ShouldQueue
{
    use Queueable;

    public  $Notification;
    public  function __construct(NotificationModel $Notification)
    {
       return $this->Notification = $Notification;
    }
    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toMail($notifiable)
    {
        // dd($this->Notification->id);
       if ($this->Notification->NotificationAttachments!="") {
        $NotificationAttachments= NotificationAttachment::where("notification_id",$this->Notification->id)->first();
           return (new MailMessage)->view(
             'emails.lawwamail', ['Notification' => $this->Notification]
           )->subject($this->Notification->title)
            ->from('Lawwa@admin.com', 'Lawwa.Aisa')
            ->attach(url('images/notificationattachments/'.$NotificationAttachments->attachment));
       }
       else
       {
          return (new MailMessage)->view(
             'emails.lawwamail', ['Notification' => $this->Notification]
           )->subject($this->Notification->title)
            ->from('Lawwa@admin.com', 'Lawwa.Aisa');
       }
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
