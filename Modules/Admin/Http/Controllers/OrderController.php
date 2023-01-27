<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order};
use Carbon\Carbon;
use Session;
use PDF;
class OrderController extends Controller
{
    
    function __construct() {
        $this->middleware('permission:orders-list|orders-create|orders-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:orders-status-change', ['only' => ['StatusChange']]);
        $this->middleware('permission:orders-list', ['only' => ['index']]);
        $this->middleware('permission:orders-show', ['only' => ['show']]);
    } 
    public function ordersexport($type='pdf')
    {
       $today=date("Y-M-d");
       return Excel::download(new OrderExport, "$today OrdersData.$type");
    }

    public function index(Request $request)
    {        
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('admin::orders.index', compact('orders'));
    }
   
    public function orderdatefilter(Request $request)
    {
        $uri = $request->path();
        $dateS = $request->input('from');
        $dateS = new Carbon($dateS);
        $dateE = $request->input('to');
        $dateE = new Carbon($dateE);
        $dateE->addDays(1);
    	$orders = Order::where('created_at', '>=', $dateS)
                           ->where('created_at','<=', $dateE)
                           ->get()->sortByDesc("id");
		if($uri=='driverearningfilter')
			{
				$orders = Order::where('created_at', '>=', $dateS)
                           ->where('created_at','<=', $dateE)->where('status','=','Delivered')
                           ->get()->sortByDesc("id");
				return view('admin.DriverEarnings.index', compact('orders','uri'));
			}  
			 return view('admin::orders.index', compact('orders'));
    }
    
    public function show($id)
    {

        $order = Order::findorfail($id);
        if(!$order->tracking_id=="" && $order->shipping_option=="Gdexpress" ){
            $response = Http::withHeaders([
                'ApiToken' => '2626e67d-f58c-496e-b169-057b61788b7b',
                'Subscription-Key' => '426bab58c16c441ebb2d36133a92483e',
                'Content-Type' => "application/json"
            ])
            ->get('https://myopenapi.gdexpress.com/api/demo/prime/GetShipmentStatusDetail',[
                    'consignmentNumber' => "$order->tracking_id",
            ]);
            $data = json_decode($response, true);
            if($data['r']['latestConsignmentNoteStatus']=="Cancelled"){
                Order::where("id","=",$order->id)->update(['current_status'=>'CANCEL']);
            }
        }
        if(!$order->tracking_id=="" && $order->shipping_option=="Skypostpaid" ){
             $response = Http::withHeaders([
                'ApiToken' => '2626e67d-f58c-496e-b169-057b61788b7b',
                'Subscription-Key' => '426bab58c16c441ebb2d36133a92483e',
                'Content-Type' => "application/json"
            ])->withBody(json_encode([
                    "access_token"=>"C4447448-D5F0-484D-B3FA-5B2E07A83094",
                    "awbs"=>array(["awbnumber"=>"23879082990"]),
            ]),'application/json')
            ->post('http://api.skynet.com.my/api/sn/pub/AWBTracking');
            $status=json_decode($response,true);
            $order_status = $status['0']['Description'];
            switch ($order_status) {
                case 'Picked up from shipper':
                    $current_status="DISPATCH";
                    break;
                case 'Out for Delivery':
                    $current_status="ONTHEWAY";
                    break;
                default:
                    $current_status=$Order->current_status;
                    break;
            }
            Order::where('tracking_id','23879082990')->update(['current_status'=>"$current_status"]);
        }
	    return view('admin::orders.show',compact('order'));
    }
    public function Downloadinvoice($id)
    {
        $order = Order::findorfail($id);
        $pdf = PDF::loadView('admin::orders.invoice',['order' =>$order]);
        return $pdf->download("#Order-$order->id.pdf");
    }

	public function StatusChange(Request $request)
    {
    	if ($request->status=="CANCEL") {
    		$request['comment']="Order cancel by administrator";
    		$request['reason']="Order cancel by administrator";
    	}
		try {
			return StatusChange($request->status,$request->order_id,"Order",$request);   
		} 
		catch (Exception $e) {
			return $e;
		} 
    }
    public function trakingIdUpdate(Request $request)
    {
        Order::where('id',$request->order_id)->update(['tracking_id'=>$request->tracking_id]);
        return response()->json(['message' => "Tracking id updated Successfully",'status' => 'ok']);
    }
    public function destroy($id)
    {
	    Order::destroy($id); 
	    toastr()->success('Order Deleted successfully!');
	    return redirect()->route('order.index');
    }
}
