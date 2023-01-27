<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\{Order};
class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    public  $order;
    
    public  function __construct(Order $order)
    {
       return $this->order = $order;
    }
    
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
          'emails.order.invoice', ['order' => $this->order]
        );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
