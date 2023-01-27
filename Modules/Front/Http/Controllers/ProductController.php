<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\{ProductCategory,Product,Category};
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Alert;
use Toastr;
use DB;
class ProductController extends Controller
{
    
    public function productscategory()
    {
      $ProductCategories =  Category::with("subcategory")->where('status','=','1')->where('categorey_type','1')->whereNull('parent_id')->get();
      return view('front::products.products-category',compact('ProductCategories'));
    }

    public function productslisting(Request $request,$id)
    {
      $Category          =  Category::findorfail($id);
      $ProductCategories =  Category::with("subcategory")->where('status','=','1')->where('categorey_type','2')->whereNull('parent_id')->get();
      $Productlist =  $Category->CategoryProduct()->where('status','=','1')->orderBy('created_at', 'desc')->paginate(6);
      $value       =  $request->Search;
      if($request->has('filter')) {
          $filter= $request->query('filter');
          if($filter=="All") {
            $Productlist =  $Category->CategoryProduct()->where('status','=','1')->orderBy('id','desc');
          }
          elseif ($filter=="new") {
            $Productlist =  $Category->CategoryProduct()->where('status','=','1')->orderBy('id','desc');
          }
          elseif ($filter=="price_desc") {
            $Productlist =  $Category->CategoryProduct()->where('status','=','1')->orderBy('sale_price','desc');
          }
          elseif ($filter=="price_asc") {
            $Productlist =  $Category->CategoryProduct()->where('status','=','1')->orderBy('sale_price','asc');
          }
          elseif ($filter=="Customer_Rating") {
           $Productlist =  Product::leftJoin('product_review_ratings', 'product_review_ratings.product_id', '=', 'products.id')->select('products.*', DB::raw('AVG(rating) as ratings_average' ))->groupBy('id')->orderBy('ratings_average', 'DESC');
          }
          if($request->has('Search')) {
              $Productlist = $Productlist->Where('name', 'like', "%{$value}%")
                            ->orWhere('description', 'like', "%{$value}%");
            }
          $Productlist =  $Productlist->paginate(6);
          $Productlist->appends(['filter' => $filter]);
      }
      return view('front::products.products-listing',compact('Productlist','id','ProductCategories'));
    }
    public function productdetails($id)
    {
      $productdetails = Product::where('id',$id)->first();
      $rating_counts  = DB::table('product_review_ratings')
                      ->select(DB::raw('count(*) as rating_count, rating'))
                      ->groupBy('rating')
                      ->where('product_id',$productdetails->id)
                      ->get();
      $array1 = array(1,2,3,4,5);
      $array2 = array();
      foreach ($rating_counts as $key => $value) {
                $array2[] = $value->rating;
        }
        foreach (array_diff($array1, $array2) as $key => $value) {
            $rating_counts->put($rating_counts->count()+1,(object)['rating_count'=>0,'rating'=>$value]);
        }
      return view('front::products.product-details',compact('productdetails','rating_counts'));
    }
}
