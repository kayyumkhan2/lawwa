<?php

namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Models\{RecruitmentApply,Recruitment};
use Illuminate\Http\Request;
use Mail;
class RecruitmentApplyController extends Controller
{
   
    public function create($id)
    {
        $Recruitment  = Recruitment::findorfail($id);
        return view('front::pages.recruitments-apply', compact('Recruitment'));
    }
    
    public function store(Request $request) {
            // Form validation
        $messages = [
            'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];
       $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'g-recaptcha-response' => 'required|captcha',
            'message' => 'required',
            'attachfile' => 'required'
        ]);

        if ($request->hasfile('attachfile')){
                 $attachfile= uploadImg($request->attachfile,"recruitmentapplies");
                 $validatedData['attachfile']=$attachfile;
                 $request['attachfile']=$attachfile;
              } 
        //  Store data in database
       $QueryManagement= RecruitmentApply::create($validatedData);
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
            ->attach(url('images/recruitmentapplies/'.$request->get('attachfile')))
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
        return back();
    }
}
