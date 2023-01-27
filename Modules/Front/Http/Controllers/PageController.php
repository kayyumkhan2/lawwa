<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{AboutUsPage,GalleryNews,GalleryPhoto,GalleryVideo,FaqQuestion,Page,PrivacyPolicy,Address,Email,ContactNumber,HomePageContent,Academy,AcademyCourse,AcademyFacility,MembershipPlan,TermCondition,Certificate,Recruitment};
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PageController extends Controller
{

    public function aboutus()
    {
      $page = AboutUsPage::first();
      return view('front::pages.about-us', compact('page'));
    }  
    public function support()
    {
      return view('front::pages.support');
    }
    public function contactus()
    {
      $addressess      = Address::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();      
      $emails          = Email::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();    
      $contactnumbers  = ContactNumber::orderBy('id', 'ASC')->where('status','=','1')->where('default_status','=','1')->get();  
      $homepagecontent = HomePageContent::orderBy('id', 'ASC')->where('status','=','1')->first();         
      return view('front::pages.contact-us', compact('addressess','emails','contactnumbers','homepagecontent')); 
    }
    public function recruitments()
    {
      $Recruitments = Recruitment::orderBy('id', 'DESC')->get();
      return view('front::pages.recruitments', compact('Recruitments'));  
    }
    public function academy()
    {
      $pagename       = "Academy";
      $AcademyCourse  = AcademyCourse::orderBy('id', 'DESC')->where('status','=','1')->get();
      $Academy        = Academy::first();
      $AcademyFaculty = AcademyFacility::orderBy('id', 'DESC')->where('status','=','1')->get();
      $certificates   = Certificate::orderBy('id', 'DESC')->where('status','=','1')->get();
      return view('front::pages.academy', compact('AcademyCourse','Academy','AcademyFaculty','pagename','certificates'));
    }
    public function coursedetails(Request $request)
    {
      $pagename       = "Course details";
      $AcademyCourse  = AcademyCourse::findorfail($request->query('id'));
      return view('front::pages.course-details', compact('AcademyCourse','pagename'));
    }
    public function recruitmentsdetails (Request $request)
    {
      $pagename       = "Recruitment details";
      $Recruitment  = Recruitment::findorfail($request->query('id'));
      return view('front::pages.recruitments-details', compact('Recruitment','pagename'));
    }
    public function newsdetails(Request $request)
    {
      $pagename       = "News details";
      $GalleryNews  = GalleryNews::findorfail($request->query('id'));
      return view('front::pages.news-details', compact('GalleryNews','pagename'));
    }
    public function academyfacilitiesdetails(Request $request)
    {
      $pagename       = "Academy facilities details";
      $AcademyFacility  = AcademyFacility::findorfail($request->query('id'));
      return view('front::pages.academy-facilities-details', compact('AcademyFacility','pagename'));
    }
    public function certificatedetails(Request $request)
    {
      $pagename       = "Certificate details";
      $Certificate = Certificate::findorfail($request->query('id'));
      return view('front::pages.certificate-details', compact('Certificate','pagename'));
    }

    public function gallery()
    {
      $pagename      = "Gallery";
      $GalleryNews   = GalleryNews::orderBy('id', 'DESC')->where('status','=','1')->paginate(6, ['*'], 'gallery-news-page');
      $GalleryPhotos = GalleryPhoto::orderBy('id', 'DESC')->where('status','=','1')->paginate(6, ['*'], 'gallery-photo-page');
      $GalleryVideos = GalleryVideo::orderBy('id', 'DESC')->where('status','=','1')->paginate(6, ['*'], 'gallery-video-page');
      return view('front::pages.gallery', compact('GalleryNews','pagename','GalleryPhotos','GalleryVideos'));       
    }

    public function termscondition()
    {
      $TermCondition = TermCondition::all();
      return view('front::pages.terms-condition', compact('TermCondition'));
       
    }
    public function privacypolicy()
    { 
      $pagename      = "privacy policy";
      $PrivacyPolicy = PrivacyPolicy::first();
      return view('front::pages.privacy-policy', compact('PrivacyPolicy','pagename'));
       
    }
    public function faq()
    {
      $pagename      = "Faq Question";
      $FaqQuestions  = FaqQuestion::get();
      return view('front::pages.faq', compact('FaqQuestions','pagename'));
       
    }
    public function membership()
    {
      $page="Membership";
      $memberships = MembershipPlan::with('MembershipFeatures')->orderBy('id','DESC')->get();
      return view('front::pages.membership', compact('page','memberships'));
    }

}

