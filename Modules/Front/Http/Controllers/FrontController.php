<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\SocialLink;
use App\Models\Setting;
use App\Models\Address;
use App\Models\Email;
use App\Models\ContactNumber;
use App\Models\HomePageContent;
class FrontController extends Controller
{
    public function index()
    {
        $banners         = Banner::orderBy('order', 'ASC')->where('status','=','1')->get();                
        $homepagecontent = HomePageContent::orderBy('id', 'ASC')->where('status','=','1')->first();
        $socialLinks     = SocialLink::orderBy('id', 'ASC')->where('status','=','1')->get();     
        $addressess      = Address::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();      
        $emails          = Email::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();    
        $contactnumbers  = ContactNumber::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();        
        return view('front::index',compact('banners','homepagecontent','addressess','emails','contactnumbers'));
    }
}
