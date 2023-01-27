<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\{ProductImage,ProductCategory,Category,Product};
use App\Models\{ProductSize,ProductColor};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller {
    function __construct() {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:product-list', ['only' => ['index']]);
        $this->middleware('permission:product-show', ['only' => ['show']]);
    }
    public function index(Request $request){
        $categorey_type=1;
        $categories = Category::orderBy('id', 'DESC')->whereIn('categorey_type',['1','2'])->whereNull('parent_id')->get();
        return view('admin::products.index',compact('categories','categorey_type'));
    }
    public function categoryproducts($id)
    {
        $Category = Category::where('id',$id)->firstorfail();
        $products=  ($Category->CategoryProduct)->sortByDesc('id')->all();
        return view('admin::products.products',compact('products','Category'));
    }
    public function create() {
        $categories = Category::whereIn('categorey_type',['1','2'])->whereNull('parent_id')->get();
        return view('admin::products.create', compact('categories'));
    }
   public function store(Request $request) {
        request()->validate([
            'name' => 'required|unique:products',
            'price' => 'required|numeric|min:1', 
            'sale_price' => 'required|numeric|min:1|lte:price', 
            'member_price' => 'required|numeric|min:1|lte:price', 
            'category' => 'required|exists:categories,id',
            'description' => 'required',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg', 
            'product_thumbnail' => 'required |image|mimes:jpeg,png,jpg,gif,svg'
        ],
            ['name.required' => 'Product Name is Required !',
             'price.required' => 'Product Price is Required !',
        ]);
        if ($request->has("unit")){
           $request->request->add(['unit', $request->unit]);
           $request->request->add(['unit_type', $request->unit_type]);
        }
        if ($request->hasfile("product_thumbnail")){
           $product_thumbnail= uploadImg($request->product_thumbnail,"productsimages");
        }
        $Product = Product::create(['product_type' =>$request->product_type,'product_thumbnail' =>$product_thumbnail,'unit' =>$request->input('unit'),'unit_type' =>$request->input('unit_type'),'name' => $request->input('name'), 'sale_price' => $request->sale_price, 'price' => $request->price, 'member_price' => $request->member_price, 'description' => $request->input('description')  ]);
        $subcategory = $request->input('subcategory');
        $category = $request->input('category');
        if ($image = $request->file('image')) {
            foreach ($image as $files) {
                $imagename= uploadImg($files,"productsimages");
                ProductImage::create(['product_id' => $Product->id,'image' => $imagename]);
            }
        }
        foreach ($request->input('category') as $category_id){
            ProductCategory::create(['product_id' => $Product->id, 'category_id' => $category_id]);
        }
        if ($request->has("color")){
            foreach(request('color') as $color) {
                $ProductColor['color'] =$color;
                $Product->ProductColor()->create($ProductColor);    
            }
        }
        if ($request->has("size")){
            foreach(request('size') as $size) {
                $ProductSize['size'] =$size;
                $Product->ProductSize()->create($ProductSize);    
            }
        }
    
        toastr()->success('Product has been added successfully!');
        return redirect()->route('products.index');
    }
    public function update(Request $request, Product $product) {
       request()->validate([
             'name' => 'unique:products,name,'.$product->id,
            'price' => 'required', 
            'sale_price' => 'required', 
            'member_price' => 'required', 
            'category' => 'required|exists:categories,id',
            'description' => 'required', 
            'product_thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ],
            // 'image' => 'required|array',
            // 'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg'],
            ['name.required' => 'Product Name is Required !',
             'price.required' => 'Product Price is Required !',
        ]);
        if ($request->has("unit")){
           $request->request->add(['unit', $request->unit]);
           $request->request->add(['unit_type', $request->unit_type]);
        }
        if($request->hasfile("product_thumbnail")){
           $product_thumbnail= uploadImg($request->product_thumbnail,"productsimages");
        }
        else
        {
           $product_thumbnail=$product->product_thumbnail;   
        }
         Product::where('id',$product->id)->update(
            [
                'product_thumbnail' =>$product_thumbnail,
                'unit' =>$request->input('unit'),
                'unit_type' =>$request->input('unit_type'),
                'name' => $request->input('name'),
                'sale_price' => $request->sale_price,
                'price' => $request->price,
                'member_price' => $request->member_price,
                'product_type' =>$request->product_type,
                'description' => $request->description
            ]);
        $subcategory = $request->input('subcategory');
        $category = $request->input('category');
        if ($image = $request->file('image')) {
            foreach ($image as $files) {
                $imagename= uploadImg($files,"productsimages");
                ProductImage::create(['product_id' => $product->id,'image' => $imagename]);
            }
        }
        foreach ($request->input('category') as $category_id){
            ProductCategory::where('product_id',$product->id)->update(['product_id' => $product->id, 'category_id' => $category_id]);

        }
        if ($request->has("color")){
            ProductColor::where('product_id', $product->id)->delete();
            foreach(request('color') as $color) {
                $ProductColor['color'] =$color;
                $product->ProductColor()->create($ProductColor);    
            }
        }
        if ($request->has("size")){
            ProductSize::where('product_id', $product->id)->delete();
            foreach(request('size') as $size) {
                $ProductSize['size'] =$size;
                $product->ProductSize()->create($ProductSize);    
            }
        }
    
        toastr()->success('Product has been updated successfully!');
        return redirect()->route('products.categoryproducts',$category_id);

        return back();
    }
    public function show(Product $product) {
        return view('admin::products.show', compact('product'));
    }
    public function edit($product_id) {
        $product       = Product::findorfail($product_id);
        $categories = Category::where('categorey_type','1')->whereNull('parent_id')->get();
        foreach($product->ProductCategory as $key => $value){
            $value->subCat  = Category::where('parent_id',$value->category_id)->get();
        }
        return view('admin::products.edit',compact('product','categories'));
    }
    public function productimagedelete(Request $request) {
        $image = ProductImage::find($request->id);
        if ($image) {
            // unlink(public_path() .  'images/products_images/' . $image->src );
            $destroy = ProductImage::destroy($request->id);
            return response()->json(['message' => 'Image deleted Successfully.']);
        }
    }
}
