<?php

namespace Modules\Admin\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{
      function __construct() {
        $this->middleware('permission:banners-list|banners-create|banners-edit|banners-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:banners-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:banners-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:banners-delete', ['only' => ['destroy']]);
        $this->middleware('permission:banners-list', ['only' => ['index']]);
        $this->middleware('permission:banners-show', ['only' => ['show']]);
    }
    public function index()
    {
    
        $banners = Banner::orderBy('order','ASC')->get();
        return view('admin::banners.index',compact('banners'));
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
     return view('admin::banners.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
           $Banner = new Banner;           
           $validatedData = $request->validate([
           'banner' => 'required',
           'title' => 'nullable',
        ]);

    if ($request->hasfile("banner")){
          $imageName = time().'.'.$request->banner->extension(); 
          $request->banner->move(public_path('public/images/banner_images'),$imageName);
          $validatedData['banner'] =$imageName;
                }
          $path = asset('public/images/banner_images/'.$imageName);
          $maxpostion = Banner::max('order');
          $validatedData['order']=$maxpostion+1;        
          $validatedData['url']=$path;
          $Banner->create($validatedData);
          toastr()->success('Banner Created successfully!');
          return redirect()->route('banners.index')->with('success','Banner Created successfully');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Homepagebanner  $homepagebanner
     * @return \Illuminate\Http\Response
     */
    public function show($homepagebanner)
    {
        $banner = Banner::find($homepagebanner);
        return view('admin::banners.show',compact('banner'));
    }
    public function edit($homepagebanner)
    {
       $Homepagebanner = Banner::find($homepagebanner);
        return view('admin::banners.edit',compact('Homepagebanner'));
    }
    public function update1(Request $request)
    {

        $posts = Homepagebanner::all();
        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }

            }

        }

        
        return response('Update Successfully.', 200);

    }


    public function update(Request $request, $id)
    {

    

        $request->validate([
        'title' => 'nullable|max:225',
     ]);

        
 $Homepagebanner = Banner::find($id);
if ($request->hasfile("banner")){
          $imageName = time().'.'.$request->banner->extension(); 
          $request->banner->move(public_path('public/images/banner_images'),$imageName);
          $Homepagebanner->banner =$imageName;
          $path = asset('public/images/banner_images/'.$imageName);
          $Homepagebanner->url=$path;
                }
          
          $Homepagebanner->title = $request->input('title');
          $Homepagebanner->save();
          toastr()->success('Banner updated successfully!');
          return redirect()->route('banners.index')->with('success','Banner updated successfully');
    }
    public function destroy( $homepagebanner)
    {
       
        $Homepagebanner = Homepagebanner::find($homepagebanner);
        $Homepagebanner->delete();
        toastr()->success('Banner deleted successfully!');
        return redirect()->back();   
    }
}
