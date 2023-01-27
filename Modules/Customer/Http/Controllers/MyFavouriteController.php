<?php
namespace Modules\Customer\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\{MyFavourite,Product};
use Illuminate\Http\Request;
use Auth;

class MyFavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $MyFavourite = MyFavourite::where('user_id',Auth::id())->paginate(4);
      return view('customer::myfavourite.index',compact('MyFavourite'));
    }

    public function AddToMyFavourite(Request $Request,$product_id)
    {
      try
      { 
         $product_id  = $Request->product_id;
         $type        = $Request->type;
         $Product     = Product::findorfail($product_id);
         $MyFavourite = MyFavourite::where('product_id' , $product_id)->where('user_id' , Auth::user()->id)->first();
      } 
      catch(ModelNotFoundException $e) 
      {
         return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
      }
      if($Product!="")
        {
          if($MyFavourite!="")
            {
              toastr()->success('Product already exists in my-favourite list !');
              return redirect()->back();
            }
            else
            {
              MyFavourite::create(['product_id' =>$product_id, 'user_id' => Auth::user()->id]);
              toastr()->success('Product add successfully to favourite list!');
              return redirect()->back();
            }
          return response()->json(["message"=>"error","code"=> "404",'error'=>"Product not found",'data' => new \stdClass()], 404); 
        } 
        else
        {
          return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
        }

    }
  
    public function RemoveFavourite(Request $Request,$id)
    {
     try
        { 
          $MyFavourite= MyFavourite::findorfail($id)
                        ->first();
        } 
        catch(ModelNotFoundException $e) 
        {
          alert()->Success('error', 'something went ot wrong')->autoclose(4000);
                return redirect()->back(); 
        }
        if($MyFavourite->delete())
        {
          alert()->Success('success', 'Product Remove successfully')->autoclose(4000);
          return redirect()->back();

        }
    }

}
