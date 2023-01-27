<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\{Order,MailTemplate};
class OrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public  $order;
    
    public  function __construct(Order $order)
    {
       return $this->order = $order;
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
        
      switch ($this->order->current_status) {
        case "PAYMENTFAILED":        
            $MailTemplate = MailTemplate::where('title',"PAYMENTFAILED")->first();  
            return (new MailMessage)->view(
                'emails.order.PAYMENTFAILED', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
          break;
        case "DISPATCH":        
            $MailTemplate = MailTemplate::where('title',"DISPATCH")->first();  
           return (new MailMessage)->view(
                'emails.order.DISPATCH', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            return (new MailMessage)->view(
                'emails.order.DISPATCH', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');  
          break;
        case "ONTHEWAY":       
             $MailTemplate = MailTemplate::where('title',"ONTHEWAY")->first();  
           return (new MailMessage)->view(
                'emails.order.ONTHEWAY', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');
          break;
        case "DELIVERED":        
            $MailTemplate = MailTemplate::where('title',"DELIVERED")->first();  
           return (new MailMessage)->view(
                'emails.order.DELIVERED', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
          break;
        case "CANCEL":        
            $MailTemplate = MailTemplate::where('title',"CANCEL")->first(); 
           return (new MailMessage)->view(
                'emails.order.CANCEL', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');
          break;
        case "REFUNDED":        
            $MailTemplate = MailTemplate::where('title',"REFUNDED")->first();  
           return (new MailMessage)->view(
                'emails.order.REFUNDED', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');
          break;
        default:
         return (new MailMessage)->view(
                'emails.order.PAYMENTFAILED', ['order' => $this->order,'MailTemplate'=>$MailTemplate]
        );
      }  
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
