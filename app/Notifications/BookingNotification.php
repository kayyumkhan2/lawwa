<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\{Booking,MailTemplate};
class BookingNotification extends Notification
{
    use Queueable;
    public  $booking;
    public  $user;
    public  function __construct(Booking $booking,$user="")
    { 
        $this->booking = $booking;
        $this->user    = $user;
    }
    
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {     
      switch ($this->booking->current_status) {
        case "PaymentFailed":        
            $MailTemplate = MailTemplate::where('template_for','PaymentFailed')->first();  
            return (new MailMessage)->view(
                'emails.booking.PaymentFailed', ['Booking'=>$this->booking,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "Booked":        
            $MailTemplate = MailTemplate::where('template_for','Booked')->first();  
           return (new MailMessage)->view(
                'emails.booking.Booked', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "Assigned":
            if ($this->user=="Customer") {
                $MailTemplate = MailTemplate::where('template_for','Assigned')->first();  
             return (new MailMessage)->view(
              'emails.booking.Assigned', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
            )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');           
            }
            elseif ($this->user=="Beautician") {
                $MailTemplate = MailTemplate::where('template_for','Bookingassigntopbt')->first();  
             return (new MailMessage)->view(
              'emails.booking.pbt.bookingassign', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
            )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');    
            }       
            break;
        case "Reached":       
            $MailTemplate = MailTemplate::where('template_for','Reached')->first();  
            return (new MailMessage)->view(
              'emails.booking.Reached', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
            )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "Start":       
            $MailTemplate = MailTemplate::where('template_for','Start')->first();  
            return (new MailMessage)->view(
              'emails.booking.Start', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
            )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "Completed":       
            $MailTemplate = MailTemplate::where('template_for','Completed')->first();  
            return (new MailMessage)->view(
              'emails.booking.Completed', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
            )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "Accepted":        
            $MailTemplate = MailTemplate::where('template_for','Accepted')->first();  
             return (new MailMessage)->view(
              'emails.booking.Accepted', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
            )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "OnTheWay":        
            $MailTemplate = MailTemplate::where('template_for','OnTheWay')->first();  
             return (new MailMessage)->view(
              'emails.booking.OnTheWay', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
            )->subject($MailTemplate->subject)
             ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "Postponed":        
            $MailTemplate = MailTemplate::where('template_for','Postponed')->first();  
           return (new MailMessage)->view(
                'emails.booking.Postponed', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
        case "Cancel":
            $MailTemplate = MailTemplate::where('template_for','Cancel')->first();  
           return (new MailMessage)->view(
                'emails.booking.Cancel', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');
            break;
            
        case "Refunded":        
            $MailTemplate = MailTemplate::where('template_for','Refunded')->first();  
           return (new MailMessage)->view(
                'emails.booking.Start', ['Booking' => $this->booking,'MailTemplate'=>$MailTemplate]
             )->subject($MailTemplate->subject)
              ->from('Lawwa@admin.com', 'Lawwa.Aisa');
          break;
        default:
         return (new MailMessage)->view(
                'emails.booking.PaymentFailed', ['booking' => $this->booking,'MailTemplate'=>$MailTemplate]
        );
      }  
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
