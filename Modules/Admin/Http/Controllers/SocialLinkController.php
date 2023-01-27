<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    function __construct() {
        $this->middleware('permission:sociallinks-list|sociallinks-create|sociallinks-edit|sociallinks-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:sociallinks-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sociallinks-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sociallinks-delete', ['only' => ['destroy']]);
        $this->middleware('permission:sociallinks-list', ['only' => ['index']]);
        $this->middleware('permission:sociallinks-show', ['only' => ['show']]);
    }

public function index()
{

    $datas = SocialLink::all();
    return view('admin::sociallinks.index')->with('datas',$datas);
}

public function create()
{
      return view('admin::sociallinks.create');
}

public function store(Request $request)
{
        $SocialLink = new SocialLink;           
        $validatedData = $request->validate([
          'name' =>'required|unique:social_links|max:100',
          'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
          'title' => 'required|unique:social_links|max:100',
          'url' => 'required|url|unique:social_links|max:500',
        ]);
         if ($request->hasfile("icon")){
                    $imageName = time().'.'.$request->icon->extension(); 
                    $request->icon->move(public_path('public/images/sociallinks'), $imageName);
                    $validatedData['icon'] =$imageName;
                }
                
        $validatedData['url']=$request->input('url');
        $SocialLink->create($validatedData);
        
        toastr()->success('Social link Added Successfully!');
        return redirect()->route('sociallinks.index');
}

public function show($id)
{
   $data = SocialLink::find($id);
   return view('admin::sociallinks.show',compact('data'));

}



public function edit($id)
{
    $data = SocialLink::find($id);


return view('admin::sociallinks.edit',compact('data'));
}

public function update(Request $request, $id)
{
        $SocialLink = SocialLink::find($id);        
        $validatedData = $request->validate([
          'name'  =>  'required|max:100|unique:social_links,name,'.$id, 
          'title'  =>  'required|max:222|unique:social_links,title,'.$id, 
          'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
          'url' => 'url|max:500',

        ]);
         if ($request->hasfile("icon")){
                    $imageName = time().'.'.$request->icon->extension(); 
                    $request->icon->move(public_path('public/images/sociallinks'), $imageName);
                    $validatedData['icon'] =$imageName;
                }
                
        $validatedData['url']=$request->input('url');
        $SocialLink->update($validatedData);
        
        toastr()->success('Social link updated Successfully!');
        return redirect()->route('sociallinks.index');

}

}

