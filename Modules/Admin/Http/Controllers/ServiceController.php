<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;
use App\Models\ServiceCategory;
use Auth;
use Alert;
use Toastr;
class ServiceController extends Controller
{
    function __construct() {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
        $this->middleware('permission:service-list', ['only' => ['index']]);
        $this->middleware('permission:service-show', ['only' => ['show']]);
    }
    public function index()
    {
      $categorey_type=0;
      $categories = Category::where('categorey_type','0')->whereNull('parent_id')->get();
      return view('admin::services.index',compact('categories','categorey_type'));
    }
    public function categoryservice($id)
    {
        $Category = Category::where('id',$id)->firstorfail();
        $data=  ($Category->CategoryService)->all();
        return view('admin::services.services',compact('data','Category'));

    }
    public function create()
    {
        $categories = Category::where('categorey_type','0')->whereNull('parent_id')->get();
        return view('admin::services.create',compact('categories'));
    }
    public function store(Request $request)
    {
      $input = $request->all();
      $this->validate($request,[
        'name' => 'unique:services,name',
        'amount' => 'required|min:1|digits_between:1,15',
        'service_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'brief_detail' => 'required',
      ]);
         
      if ($request->hasfile("service_image")){
        $imageName = time().'.'.$request->service_image->extension(); 
        $request->service_image->move(public_path('public/images/serviceimages'), $imageName);
        $input['service_image'] =$imageName;
      }
         $input['UserId'] =Auth::id();
         $service_id  = Service::create($input)->id;
         $service_category = array_filter($request->service_category);
         $category_id  = end($service_category);
            ServiceCategory::create([
                'service_id' => $service_id,
                'category_id'=> $category_id
            ]);
         
        toastr()->success('Service has been added successfully!');
        return redirect()->route('service.index');
    }
    
   
    public function show($id)
    {
      $data       = Service::find($id);
      return view('admin::services.show',compact('data'));

    }

    
    public function edit($id)
    {
      $data       = Service::find($id);
      $categories = Category::where('categorey_type','0')->whereNull('parent_id')->get();
      foreach($data->ServiceCategory as $key => $value){
        $value->subCat  = Category::where('parent_id',$value->category_id)->get();
      }
      return view('admin::services.edit',compact('data','categories'));
    }

    
    public function update(Request $request, $id)
    {
	    $input = $request->all();
        request()->validate([
            'name' => 'unique:services,name,'.$id,
            'amount' => 'required|min:1|digits_between:1,15',
            'service_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brief_detail' => 'required',
        ],
            [
            'name.required' => 'service Name is Required !',
            'price.required' => 'service Price is Required !',
        ]);
        
        if ($request->hasfile("service_image")){
            $imageName = time().'.'.$request->service_image->extension(); 
            $request->service_image->move(public_path('public/images/serviceimages'), $imageName);
            $input['service_image'] =$imageName;
        }
       $data= ServiceCategory::where('service_id', $id)->get();
      if(!$data->isEmpty())
       {
          ServiceCategory::where('service_id', $id)->delete();
       }
        $service_category = array_filter($request->service_category);
        $category_id  = end($service_category);
        ServiceCategory::create([
            'service_id' => $id,
            'category_id'=> $category_id
        ]);
        $Service = Service::find($id);
        $Service->update($input); 
		alert()->success('Success', 'Service updated Successfully!')->autoclose(3000);               
        //toastr()->success('User updated Successfully!');
        return redirect()->route('service.index');
    }

    public function destroy($id)
    {
      toastr()->success('User deleted Successfully!');
      User::find($id)->delete();return redirect()->route('users.index');
    }
}
