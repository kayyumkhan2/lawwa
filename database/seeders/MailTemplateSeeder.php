<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MailTemplate;

class MailTemplateSeeder extends Seeder
{
    public function run()
    {  
                  $permissions = array ( 
        array("title"=>'PAYMENTFAILED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Order',"template_for"=>'PAYMENTFAILED'),
        array("title"=>'ORDERED',"subject"=>'Your order is confirmed','html_template'=>'<p>We know you can&#39;t wait to get your hands on it. Our team is working hard while ensuring highest safety standards in these tough times. Deliveries may take longer than usual, we are trying our best to deliver it soon.</p>',"for"=>'Order Success',"template_for"=>'ORDERED'),
        array("title"=>'DISPATCH',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Order On The Way',"template_for"=>'DISPATCH'),
        array("title"=>'ONTHEWAY',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Order Payment Failed',"template_for"=>'ONTHEWAY'),
        array("title"=>'DELIVERED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Order Cancel',"template_for"=>'DELIVERED'),
        array("title"=>'CANCEL',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'CANCEL',"template_for"=>'CANCEL'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Order Refund',"template_for"=>'REFUNDED'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Payment Failed',"template_for"=>'PaymentFailed'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Success',"template_for"=>'Booked'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Assigned to PBTLA',"template_for"=>'Assigned'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Accepted by PBTLA',"template_for"=>'Accepted'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'PBTLA On The Way',"template_for"=>'OnTheWay'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Postponed',"template_for"=>'Postponed'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Cancel',"template_for"=>'Cancel'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'PBTLA Reached On Destination',"template_for"=>'Reached'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Service started by PBTLA',"template_for"=>'Start'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Cancel',"template_for"=>'Completed'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Refund',"template_for"=>'Refunded'),
        array("title"=>'REFUNDED',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Membership Purchase',"template_for"=>'Membership'),
        array("title"=>'Booking Assign mail to PBTA',"subject"=>'your order has been PAYMENT FAILED','html_template'=>'your order has been PAYMENT FAILED',"for"=>'Booking Assign mail to PBTA',"template_for"=>'Bookingassigntopbt'),
        );
                foreach ($permissions as $key => $value) {
                        MailTemplate::create(['title' => $value['title'],'html_template' => $value['html_template'],'subject' => $value['subject'],"for"=>$value['for'],"template_for"=>$value['template_for']]);
        }
    }
}
