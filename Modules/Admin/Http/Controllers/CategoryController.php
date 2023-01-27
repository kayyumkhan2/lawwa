<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RealRashid\SweetAlert\Facades\Alert;
class CategoryController extends Controller
{
    function __construct() {
        $this->middleware('permission:categories-list|categories-create|categories-edit|categories-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
        $this->middleware('permission:categories-list', ['only' => ['index']]);
        $this->middleware('permission:categories-show', ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        $pagename="Product categories";
        $categorey_type=1;
        $categories = Category::whereIn('categorey_type',['1'])->whereNull('parent_id')->get();
        if ($request->routeIs('categories.servicecategories*'))
         { 
            $pagename="Service categories";
            $categorey_type=0;
            $categories = Category::where('categorey_type','0')->whereNull('parent_id')->get();
         }
         if ($request->routeIs('categories.productsoffrescategory*'))
         { 
            $pagename="Product offer categories";
            $categorey_type=2;
            $categories = Category::where('categorey_type','2')->whereNull('parent_id')->get();
         }
       return view('admin::categories.index',compact('categories','categorey_type','pagename'));
    }
    public function create(Request $request)
    {       $categorey_type=1;
            $categories = Category::where('categorey_type','1')->whereNull('parent_id')->get();
        if ($request->routeIs('categories.create.servicecategory*'))
         { 
            $categorey_type=0;
            $categories = Category::where('categorey_type','0')->whereNull('parent_id')->get();
         }
        return view('admin::categories.create',compact('categories','categorey_type'));
    }
    public function store(Request $request)
    {
        $Category = new Category;           
        $validatedData = $request->validate([
            'name' =>'required|unique:categories|max:100',
            'title' =>'required|unique:categories|max:220',
            'categorey_type' =>'required',
            'description' =>'max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
       
        if ($request->hasfile("image")){
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('public/images/categoriesimages'), $imageName);
            $validatedData['image'] =$imageName;
        }
        if($request->has('parent_id'))
        {
           $validatedData['parent_id']=$request->input('parent_id'); 
        }
           $Category->create($validatedData);
           $categorey_type=$request->categorey_type;
           $categories = Category::where('categorey_type','1')->whereNull('parent_id')->get();
        if($categorey_type==0)
         {   
            $categories = Category::where('categorey_type','0')->whereNull('parent_id')->get();
         }
         if ($categorey_type==0) {
            alert()->Success('Success', 'Successfully add')->autoclose(4000);
            return redirect()->route('categories.servicecategories')->withSuccess('Successfully save');
         }
         else
         {
           alert()->Success('Success', 'Successfully add')->autoclose(4000);
           return redirect()->route('categories.index');
         }
    }

    public function show($category)
    {
        $categorydata = Category::findOrFail($category);             
        $categories = Category::where('parent_id','=',$category)->get();
        return view('admin::categories.show',compact('categorydata','categories'));
    }

    public function edit($category)
    {
        try { 
             $categorydata = Category::findOrFail($category);             
            } 
           catch (ModelNotFoundException $e) 
            {
              return redirect()->route('categories.index');
            } 
        $categories = Category::where('parent_id','=',$category)->where('categorey_type','=',$categorydata->categorey_type)->get();
        $parent_categories = Category::whereNull('parent_id')->where('categorey_type','=',$categorydata->categorey_type)->where('id','!=',$category)->get();
        return view('admin::categories.edit',compact('categorydata','categories','parent_categories'));
    }

    public function edit_category(Request $request)
    {

        $request->validate([
        'id' => 'required',
        ]);
        $category=$request->input('id');
        $Category = Category::findOrFail($category);
        $Category->name = $request->input('value');
        if($Category->save())
        {
            return response()->json(['message' => 'Category update Successfully','status' => 'ok']);
        } 
        else
        {
            return response()->json(['message' => 'Something is wrong','status' => 'error']);
        }

    }
    public function update(Request $request, Category $category)
    {
      $validatedData = $request->validate([
        'name' => 'unique:categories,name,'.$category->id,
        'title' =>'required',
        'description' =>'max:500',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
       
      if($request->hasfile("image"))
        {
          $imageName = time().'.'.$request->image->extension(); 
          $request->image->move(public_path('public/images/categoriesimages'), $imageName);
          $validatedData['image'] =$imageName;
        }
        if(empty($category->parent_id))
        {
           $categorydata=  $category->subcategory;
            foreach ($category->subcategory as $key => $value) 
            {
              $value->parent_id=$request->parent_id;
              $value->save();
            }
        }
        if($request->input('parent_id')!="")
        {
           $validatedData['parent_id']=$request->input('parent_id'); 
        }
            $category->update($validatedData);
            toastr()->success('Category updated Successfully!');
            return redirect()->back();   
         }

   public function destroy($category)
    {
        $Category = Category::findorfail($category);
        $Category->delete();
        toastr()->success('Category deleted successfully!');
        return redirect()->back();
    }
    public function servicesubcategory(Request $request)
    {
        
        $parent_id = $request->cat_id;
        $subcategories = Category::where('parent_id',$parent_id)->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

}
