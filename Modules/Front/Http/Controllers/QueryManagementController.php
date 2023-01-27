<?php

namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\QueryManagement;
use Mail;
use Ixudra\Curl\Facades\Curl;
use Validator;
class QueryManagementController extends Controller {
    public function ContactUsForm(Request $request) {
        // Form validation
       $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'subject'=>'required',
            'type'=>'required',
            'message' => 'required'
         ]);
       if ($request->has('company')){
            $validatedData['company']=$request->get('company');
        }
        //  Store data in database
        QueryManagement::create($validatedData);
        //  Send mail to admin
        Mail::send('mailtemplate.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'company' => $request->get('company'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from('lawwaaisa@gmail.com');
            $message->to([$request->email,'lawwaaisa@gmail.com'], 'Admin')->subject($request->get('subject'));
        });
        alert()->Success('Thank you', 'We have received your message and would like to thank you for writing to us.')->autoclose(4000);
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }
    public function SupportForm(Request $request) {
        // Form validation
        $messages = [
            'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];
       $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'subject'=>'required',
            'g-recaptcha-response' => 'required|captcha',
            'message' => 'required',
            'type' => 'required'
        ]);

        if ($request->hasfile('attachfile')){
                 $attachfile= uploadImg($request->attachfile,"supportfiles");
                 $validatedData['attachfile']=$attachfile;
                 $request['attachfile']=$attachfile;
              } 
        //  Store data in database
       $QueryManagement= QueryManagement::create($validatedData);
        //  Send mail to admin
       if ($request->hasfile('attachfile')){
            Mail::send('mailtemplate.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from('lawwaaisa@gmail.com');
            $message->to([$request->email,'lawwaaisa@gmail.com'], 'Admin')
            ->attach(url('images/supportfiles/'.$request->get('attachfile')))
            ->subject($request->get('subject'));
        });
        }
        else
        {
            Mail::send('mailtemplate.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from('lawwaaisa@gmail.com');
            $message->to([$request->email,'lawwaaisa@gmail.com'], 'Admin')
            ->subject($request->get('subject'));
        });
        }
        alert()->Success('Thank you', 'We have received your message and we would like to thank you for writing to us.')->autoclose(4000);
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }
}