<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\{AboutUsPage,GalleryNews,GalleryPhoto,GalleryVideo,FaqQuestion,Page,PrivacyPolicy,TermCondition};
use App\Models\{AcademyFacility,Academy,AcademyCourse,Certificate,Recruitment,RecruitmentFeature};
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    function __construct() {
        $this->middleware('permission:Pages-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Pages-list', ['only' => ['index']]);
    }
    public function index()
    {
      $pages = array(
        array('about-us'),
        array('gallery'),
        array('faq-question'),
        array('privacy-policy'),
        array('academy'),
        array('terms-condition'),
        array('recruitments'),
      );      
      return view('admin::pages.index')->with('pages', $pages);
    }

    public function update( Request $request,$pagename,$id=null)
    {
      $updatedata="";
      switch ($pagename) {
              case 'about-us':
                  $updatedata = AboutUsPage::first();
                  return view('admin::pages.about_us_page',compact('updatedata','pagename'));
              break;
              case 'gallery':
                  $pages = array(
                    array('gallery-photos'),
                    array('gallery-videos'),
                    array('gallery-news'),
                  );  
                  return view('admin::pages.gallery.index',compact('pages'));
                  break;
              case 'faq-question':
                  $data = FaqQuestion::get();
                  return view('admin::pages.faqquestion.faq-question',compact('data','id','updatedata','pagename'));
                  break;
              case 'terms-condition':
                  $data = TermCondition::get();
                  return view('admin::pages.termscondition.terms-condition',compact('data','id','updatedata','pagename'));
                  break;
              case 'privacy-policy':
                  $data = PrivacyPolicy::get();
                  $updatedata = PrivacyPolicy::first();
                  return view('admin::pages.privacy-policy',compact('data','id','updatedata','pagename'));
                  break;
              case 'academy':
                  $updatedata = Academy::first();
                  return view('admin::pages.academy.academy',compact('updatedata','pagename'));
              break;
              case 'recruitments':
                  if ($request->has('id')) {
                         $id = $request->input('id');
                  }
                  $data = Recruitment:: orderBy('id', 'DESC')->get();
                  $updatedata = "";
                  if ($id)
                  {
                    try
                    {
                      $updatedata = Recruitment::findorfail($id);
                    } 
                    catch (\Exception $ex) 
                    {
                      return view('admin::pages.recruitments.index',compact('data','id','updatedata','pagename'));
                    }
                  } 
                  return view('admin::pages.recruitments.index',compact('data','id','updatedata','pagename'));
              break;
              case 'academy-courses':
                  $data = AcademyCourse::orderBy('id', 'DESC')->get();
                  return view('admin::pages.academy.academy-courses',compact('data','id','updatedata','pagename'));
                  break;
              case 'academy-facilities':
                  $data = AcademyFacility::get();
                  $updatedata = Academy::first();
                  return view('admin::pages.academy.academy-facilities',compact('data','id','updatedata','pagename'));
              break;
              case 'certificates':
                  $data = Certificate::orderBy('id', 'DESC')->get();
                  return view('admin::pages.academy.certificates',compact('data','id','updatedata','pagename'));
                  break;
              default:
                  alert()->warning('Success', 'Something is wrong')->autoclose(4000);
                  return redirect()->back();
                  break;
          }      
    }
    public function gallery( Request $request,$pagename,$id=null)
    {

      $updatedata="";
      $pages = array(
                    array('gallery-photos'),
                    array('gallery-videos'),
                    array('gallery-news'),
                 );  
      switch($pagename) {
            case 'gallery-photos':
                $data = GalleryPhoto::orderBy('id', 'DESC')->get();
                if ($id)
                {
                  try
                  {
                    $updatedata = GalleryPhoto::findorfail($id);
                  } 
                  catch (\Exception $ex) 
                  {
                    return redirect()->route('admin::pages.gallery.index');
                  }
                } 
                return view('admin::pages.gallery.gallery-photos',compact('data','id','updatedata','pagename'));
            break;
            case 'academy-facilities':
                $data = AcademyFacility::orderBy('id', 'DESC')->get();
                if ($id)
                {
                  try
                  {
                    $updatedata = AcademyFacility::findorfail($id);
                  } 
                  catch (\Exception $ex) 
                  {
                    return redirect()->route('admin::pages.gallery.index');
                  }
                } 
                return view('admin::pages.gallery.gallery-academy-facility',compact('data','id','updatedata','pagename'));
            break;
            case 'gallery-videos':
                $data = GalleryVideo::orderBy('id', 'DESC')->get();
                if ($id)
                {
                  try
                  {
                    $updatedata = GalleryVideo::findorfail($id);
                  } 
                  catch (\Exception $ex) 
                  {
                    return redirect()->route('admin::pages.gallery.index');
                  }
                }
                $data = GalleryVideo::orderBy('id', 'DESC')->get(); 
                return view('admin::pages.gallery.gallery-videos',compact('data','id','updatedata','pagename'));
                break;
            case 'gallery-news':
                $data = GalleryNews:: orderBy('id', 'DESC')->get();
                if ($id)
                {
                  try
                  {
                    $updatedata = GalleryNews::findorfail($id);
                  } 
                  catch (\Exception $ex) 
                  {
                    return redirect()->route('admin::pages.gallery.index');
                  }
                } 
                return view('admin::pages.gallery.gallery-news',compact('data','id','updatedata','pagename'));
                break;
            default: 
                return view('admin::pages.gallery.index',compact('pages'));
                break;
        } 
    }

    public function GalleryNewsUpdateStore(Request $request,$id=null )
    {
        $pages = array(
                      array('gallery-photos'),
                      array('gallery-videos'),
                      array('gallery-news'),
                    ); 
        $validatedData = $request->validate([
          'heading' => 'required|max:100|unique:gallery_news,heading,'.$id,
          'content' => 'required|max:500|unique:gallery_news,content,'.$id,
        ]);
        if ($request->hasfile("image")){
           $validatedData['image']= $this->uploadImg($request->image,"frontpages/gallerynews");
        }
       if ($id){
             try {
                  $updatedata = GalleryNews::findorfail($id);
                  } 
            catch (\Exception $ex) {
                  return redirect()->route('admin::pages.gallery.index');
                } 
          $addresses = GalleryNews::where('id',$id)->update($validatedData);
          alert()->Success('Success', 'Gallery News update Successfully')->autoclose(3000);
          return redirect()->back();
          }
          $addresses = GalleryNews::create($validatedData);
          alert()->Success('Success', 'Gallery News add Successfully')->autoclose(3000);
          return redirect()->back();
    }
    public function RecruitmentsUpdateStore(Request $request,$id=null )
    {
        $validatedData = $request->validate([
          'heading' => 'required|max:100|unique:recruitments,heading,'.$id,
          'content' => 'required|max:1500|unique:recruitments,content,'.$id,
        ]);
        if ($id){
          try {
              $updatedata = Recruitment::findorfail($id);
          } 
          catch(\Exception $ex) {
            return redirect()->route('admin.page.recruitments');
          } 
          $Recruitment=Recruitment::findorfail($id);
          Recruitment::where('id',$id)->update($validatedData);
          RecruitmentFeature::where('recruitment_id',$id)->delete();
          foreach(array_filter(request('features')) as $feature) {
            $RecruitmentFeature['feature'] =$feature;
            $Recruitment->RecruitmentFeature()->create($RecruitmentFeature);    
          }
          alert()->Success('Success', 'Recruitment update Successfully')->autoclose(3000);
          return redirect()->back();
          }
        
        $Recruitment = Recruitment::create($validatedData);
        foreach(request('features') as $feature) {
          $RecruitmentFeature['feature'] =$feature;
          $Recruitment->RecruitmentFeature()->create($RecruitmentFeature);    
        }
        alert()->Success('Success', 'Recruitment add Successfully')->autoclose(3000);
        return redirect()->back();
    }

    public function GalleryPhotosUpdateStore(Request $request,$id=null )
    {
      $pages = array(
                array('gallery-photos'),
                array('gallery-videos'),
                array('gallery-news'),
              ); 
      $validatedData = $request->validate([
        'heading' => 'required|max:20|unique:gallery_photos,heading,'.$id,
        'image' => 'image|mimes:jpeg,png,jpg|max:2048',
      ]);
      
      if ($request->hasfile("image")){
         $validatedData['image']= $this->uploadImg($request->image,"frontpages/galleryphotos");
      }
     if ($id) {
     try {
          $updatedata = GalleryPhoto::findorfail($id);
          } catch (\Exception $ex) {
            return redirect()->route('admin::pages.gallery.index');
        } 
           $addresses = GalleryPhoto::where('id',$id)->update($validatedData);
           alert()->Success('Success', 'Gallery Photo update Successfully')->autoclose(3000);
          return redirect()->back();
        }
         $addresses = GalleryPhoto::create($validatedData);
         alert()->Success('Success', 'Gallery Photo add Successfully')->autoclose(3000);
        return redirect()->back();
    }

    public function GalleryVideosUpdateStore(Request $request,$id=null )
    {
      $pages = array(
                      array('gallery-photos'),
                      array('gallery-videos'),
                      array('gallery-news'),
              ); 
      $validatedData = $request->validate([
        'heading' => 'required|max:20|unique:gallery_videos,heading,'.$id,
        'video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm',
      ]);
      
      if ($request->hasfile("video")){
         $validatedData['video']= $this->uploadImg($request->video,"frontpages/galleryvideos");
      }
     if($id){
       try{
            $updatedata = GalleryVideo::findorfail($id);
            } catch (\Exception $ex) {
              return redirect()->route('admin::pages.gallery.index');
          } 
            $addresses = GalleryVideo::where('id',$id)->update($validatedData);
            alert()->Success('Success', 'Gallery video update Successfully')->autoclose(3000);
            return redirect()->back();
          }
          $addresses = GalleryVideo::create($validatedData);
          alert()->Success('Success', 'Gallery video add Successfully')->autoclose(3000);
          return redirect()->back();
      }

    public function TermsConditionUpdateStore(Request $request,$id=null)
    {
      $TermCondition   = new TermCondition;           
      $validatedData = $request->validate([
        'term' => 'required|max:500|unique:term_conditions,question,'.$id,
        'condition'     => 'required',
      ]);
      if($id)
        {
          try
          {
            $updatedata = TermCondition::findorfail($id);
          } 
          catch(\Exception $ex) 
          {
            return redirect()->route('admin::pages.index');
          } 
          $addresses = TermCondition::where('id',$id)->update($validatedData);
          alert()->Success('Success', 'Term condition update Successfully')->autoclose(3000);
          return redirect()->back();
        }
      $addresses = TermCondition::create($validatedData);
      alert()->Success('Success', 'Term condition Created successfully')->autoclose(3000);
      return redirect()->back();
    }
    public function TermsCondition(Request $request,$id=null)
    {
      $pagename="Term Condition";
      $data = TermCondition::get();
      if ($id)
      {
        try
        {
          $updatedata = TermCondition::findorfail($id);
        } 
        catch (\Exception $ex) 
        {
          return view('admin::pages.termscondition.terms-condition','data','id','updatedata','pagename');
        }
      } 
      return view('admin::pages.termscondition.terms-condition',compact('data','id','updatedata','pagename'));
    }
    public function FaqQuestionsUpdateStore(Request $request,$id=null)
    {
      $FaqQuestion   = new FaqQuestion;           
      $validatedData = $request->validate([
        'question' => 'required|max:500|unique:faq_questions,question,'.$id,
        'answer'     => 'required|max:500',
      ]);
      if($id)
        {
          try
          {
            $updatedata = FaqQuestion::findorfail($id);
          } 
          catch(\Exception $ex) 
          {
            return redirect()->route('admin::pages.index');
          } 
          $addresses = FaqQuestion::where('id',$id)->update($validatedData);
          alert()->Success('Success', 'Faq Question update Successfully')->autoclose(3000);
          return redirect()->back();
        }
      $addresses = FaqQuestion::create($validatedData);
      alert()->Success('Success', 'Faq Question Created successfully')->autoclose(3000);
      return redirect()->back();
    }

    public function FaqQuestions(Request $request,$id=null)
    {
      $pagename="Faq-Questions";
      $data = FaqQuestion::get();
      if ($id)
      {
        try
        {
          $updatedata = FaqQuestion::findorfail($id);
        } 
        catch (\Exception $ex) 
        {
          return view('admin::pages.faqquestion.faq-question','data','id','updatedata','pagename');
        }
      } 
      return view('admin::pages.faqquestion.faq-question',compact('data','id','updatedata','pagename'));
    }

    function uploadImg($image, $foldername){
        try{
          if (!empty($image)) {
              $imageName = rand().'.'.$image->extension(); 
              $image->move(public_path('images/'.$foldername),$imageName);
             return $imageName;

          }
        }
        catch(Exception $e){
          throw $e;
        }
    }

    public function Aboutusupdate(Request $request)
    {
      $page = AboutUsPage::first();
      if ($page=="") {
        $page=new AboutUsPage;
      }
      $request->validate([
        'section_1_heading'  =>  'required|max:100', 
        'section_1_content'  =>  'required|max:4000', 
        'section_2_heading'  =>  'required|max:100', 
        'section_2_content'  =>  'required|max:4000', 
        'section_3_heading'  =>  'required|max:100', 
        'section_3_content'  =>  'required|max:4000', 
        'section_4_heading'  =>  'required|max:100', 
        'section_4_content'  =>  'required|max:4000', 
        'section_5_heading'  =>  'required|max:100', 
        'section_5_content'  =>  'required|max:4000', 
      ]);
      if ($request->hasfile("section_1_image")){
         $page->section_1_image= $this->uploadImg($request->section_1_image,"frontpages/aboutusimages");
      }
      if ($request->hasfile("section_2_image_1")){
         $page->section_2_image_1= $this->uploadImg($request->section_2_image_1,"frontpages/aboutusimages");
      }
      if ($request->hasfile("section_2_image_2")){
         $page->section_2_image_2= $this->uploadImg($request->section_2_image_2,"frontpages/aboutusimages");
      }
      if ($request->hasfile("section_2_image_3")){
         $page->section_2_image_3= $this->uploadImg($request->section_2_image_3,"frontpages/aboutusimages");
      }
      if ($request->hasfile("section_2_image_4")){
         $page->section_2_image_4= $this->uploadImg($request->section_2_image_4,"frontpages/aboutusimages");
      }
      if ($request->hasfile("section_3_image")){
         $page->section_3_image= $this->uploadImg($request->section_3_image,"frontpages/aboutusimages");
      }
      if ($request->hasfile("section_4_image")){
         $page->section_4_image= $this->uploadImg($request->section_4_image,"frontpages/aboutusimages");
      }
      if ($request->hasfile("section_5_image")){
         $page->section_5_image= $this->uploadImg($request->section_5_image,"frontpages/aboutusimages");
      }

      $page->section_1_heading = $request->input('section_1_heading');
      $page->section_1_content = $request->input('section_1_content');

      $page->section_2_heading = $request->input('section_2_heading');
      $page->section_2_content = $request->input('section_2_content');

      $page->section_3_heading = $request->input('section_3_heading');
      $page->section_3_content = $request->input('section_3_content');

      $page->section_4_heading = $request->input('section_4_heading');
      $page->section_4_content = $request->input('section_4_content');

      $page->section_5_heading = $request->input('section_5_heading');
      $page->section_5_content = $request->input('section_5_content');
      $page->save();
      toastr()->success('About us update successfully!');
      return redirect()->back();
    }

    public function PrivacyPolicyUpdate(Request $request)
    {
      $page = PrivacyPolicy::first();
      if ($page=="") {
          $page=new PrivacyPolicy;
      }
      $request->validate([
        'content'  =>  'required|max:4000', 
      ]);
      $page->content = $request->input('content');
      $page->save();
      toastr()->success('Privacy Policy updated successfully!');
      return redirect()->back();
    }

    public function Academy(Request $request)
    {
      $page = Academy::first();
      if ($page=="") {
          $page=new Academy;
      }
      $request->validate([
        'section_1_heading'  =>  'required|max:20', 
        'section_1_content'  =>  'required|max:4000',
        'section_2_heading'  =>  'required|max:70', 
        'section_2_content'  =>  'required|max:4000',
        'section_3_heading'  =>  'required|max:70', 
        'section_3_content'  =>  'required|max:4000', 
        'section_4_heading'  =>  'required|max:70', 
        'section_4_content'  =>  'required|max:4000', 
      ]);
      $page->section_1_heading = $request->input('section_1_heading');
      $page->section_1_content = $request->input('section_1_content');
      $page->section_2_heading = $request->input('section_2_heading');
      $page->section_2_content = $request->input('section_2_content');
      $page->section_3_heading = $request->input('section_3_heading');
      $page->section_3_content = $request->input('section_3_content');
      $page->section_4_heading = $request->input('section_4_heading');
      $page->section_4_content = $request->input('section_4_content');
      if ($request->hasfile("section_1_image")){
        $page->section_1_image= $this->uploadImg($request->section_1_image,"frontpages/academy");
      }
      $page->save();
      alert()->Success('Success', 'Academy updated successfully')->autoclose(3000);
      return redirect()->back();
    }
    public function AcademyFacilitiesUpdateStore(Request $request,$id=null )
    {
      
      $validatedData = $request->validate([
        'heading' => 'required|max:50|unique:academy_facilities,heading,'.$id,
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'content' => 'required|max:1500|unique:academy_facilities,content,'.$id,
      ]);
      if ($request->hasfile("image")){
           $validatedData['image']= $this->uploadImg($request->image,"frontpages/academyfaculty");
      }
         $AcademyFaculty = AcademyFacility::create($validatedData);
         alert()->Success('Success', 'Academy Facilities add Successfully')->autoclose(3000);
        return redirect()->back();
    }
     public function AcademyCertificatesUpdateStore(Request $request,$id=null )
    {
                  
      $validatedData = $request->validate([
        'heading' => 'required|max:200|unique:certificates,heading,'.$id,
        'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
      ]);
      if ($request->hasfile("image")){
           $validatedData['image']= $this->uploadImg($request->image,"frontpages/certificates");
      }

      $AcademyCertificates = Certificate::create($validatedData);;
      foreach(array_filter(request('features')) as $feature) {
        $CourseFeature['feature'] =$feature;
        $AcademyCertificates->CertificateFeature()->create($CourseFeature);    
      }
        alert()->Success('Success', 'Certificate add Successfully')->autoclose(3000);
        return redirect()->back();
    }
    public function AcademyCoursesUpdateStore (Request $request,$id=null )
    {
                  
      $validatedData = $request->validate([
        'heading' => 'required|max:200|unique:academy_courses,heading,'.$id,
        'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        'description' => 'required',
        'details_page_heading' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'features' => 'required|array|min:1',
        'features.*'  => "required|string|distinct|min:1",
      ]);
      if ($request->hasfile("image")){
           $validatedData['image']= $this->uploadImg($request->image,"frontpages/academycourses");
      }

      $AcademyCourse = AcademyCourse::create($validatedData);;
      foreach(array_filter(request('features')) as $feature) {
        $CourseFeature['feature'] =$feature;
        $AcademyCourse->CourseFeature()->create($CourseFeature);    
      }
        alert()->Success('Success', 'Academy Course add Successfully')->autoclose(3000);
        return redirect()->back();
    }

}

