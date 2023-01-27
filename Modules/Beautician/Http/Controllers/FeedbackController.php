<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{Feedback};

use Illuminate\Http\Request;
use Mail;
class FeedbackController extends Controller
{
    public $pagename="Feedback";
    public function create()
    {
	    return view('beautician::feedback.create')->with('pagename',$this->pagename);
    }
    public function store(Request $request)
    {
   
        $messages = [
            'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];
       $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'nullable',
            'g-recaptcha-response' => 'required|captcha',
            'message' => 'required',
            'type' => 'nullable'
        ]);

        if ($request->hasfile('attachfile')){
                 $attachfile= uploadImg($request->attachfile,"feedbackfiles");
                 $validatedData['attachfile']=$attachfile;
              } 
        //  Store data in database
        Feedback::create($validatedData);
        //  Send mail to admin
        Mail::send('mailtemplate.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => "Feedback",
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from('lawwaaisa@gmail.com');
            $message->to([$request->email,'lawwaaisa@gmail.com'], 'Admin')->subject("Feedback sent");
        });
        alert()->Success('Thank you', 'We have received your message and would like to thank you for writing to us.')->autoclose(4000);
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }
}
