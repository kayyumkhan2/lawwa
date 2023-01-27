<?php
namespace Modules\Customer\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{ProductReviewRating,Order};
use Illuminate\Http\Request;
use Auth;
class ProductReviewRatingController extends Controller
{
    public $pagename="Product Review Rating";
   
    
    public function create(Request $request)
    {
    	$Order=Order::findorfail($request->query('id'));
        return view('customer::productreviewratings.create',compact('Order'))->with('pagename',$this->pagename);
    } 
    public function store(Request $request)
    {
        $comments=$request->comments;
        $products=$request->products;
        $ratings=$request->ratings;
        $titles=$request->titles;
        $order_id=$request->order_id;
        foreach ($products as $key => $id) {
        	if ($ratings[$key]=="") {
        		 continue;
        	}
            ProductReviewRating::create(["rating"=>$ratings[$key],"comment"=>$comments[$key],"product_id"=>$products[$key],"title"=>$titles[$key],"user_id"=>Auth::id(),"order_id"=>$order_id]);
        }
        alert()->Success('Success', 'Rating Send Successfully')->autoclose(2000);
        return redirect()->back();
	}
   
}
