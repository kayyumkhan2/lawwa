<?php

namespace Modules\Customer\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\{Order};
use Illuminate\Support\Facades\Input;
use Validator;
use Auth;
use PDF;
class OrderController extends Controller
{
    public function orders(Request $request){
        $Orders = Order::orderBy('created_at', 'desc')->where('user_id',Auth::id())->paginate(4);
        if($request->has('filter') ) {
            $status= $request->query('filter');
            if ($status=="All") {
                $Orders->appends(['status' => $status]);
                return view('customer::orders.my-order',compact('Orders'));
            }
            if ($status=="UPCOMING") {
                $Orders = Order::WhereIN('current_status',['DISPATCH','ONTHEWAY','ORDERED'])->where('user_id',Auth::id())->paginate(4);
                $Orders->appends(['filter' => $status]);
            }
            else
            {
                $Orders = Order::where('current_status',$status)->where('user_id',Auth::id())->paginate(4);
                $Orders->appends(['status' => $status]);
            }
            return view('customer::orders.my-order',compact('Orders'));
        }
        return view('customer::orders.my-order',compact('Orders'));
    }
	public function orderdetails($Order_id){
	    $Order = Order::where('id',$Order_id)->first();
        if ($Order=="") {
            alert()->info('Oops', 'Order data not found')->autoclose(3000);
            return redirect()->route("customer.orders");
        }
	   return view('customer::orders.orders-details',compact('Order'));
	}
    public function cancel(Request $request)
    {
        try {
            return StatusChange($request->status,$request->order_id,"Order",$request);   
        } 
        catch (Exception $e) {
            return $e;
        } 
    }
}
