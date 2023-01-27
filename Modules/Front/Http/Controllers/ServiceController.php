<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\ServiceCategory;
use App\Models\Banner;
use App\Models\HomePageContent;
use Auth;
use Alert;
use Toastr;
class ServiceController extends Controller
{            
    public function servicescategory()
    {
        $ServiceCategories =  Category::with("subcategory")
                                ->where('status','=','1')
                                ->where('categorey_type','0')
                                ->whereNull('parent_id')
                                ->get();
        return view('front::services.services-category',compact('ServiceCategories'));
    }

    public function servicessubcategory($id)
    {
        $ServiceCategories =  Category::where('parent_id',$id)->where('status','=','1')->get();
        return view('front::services.services-subcategory',compact('ServiceCategories'));
    }
    public function services($id)
    {
        $Category = Category::where('id',$id)->firstorfail();
        $services=  ($Category->CategoryService)->where('status','=','1');
        return view('front::services.services',compact('services','Category'));
    }    
}
