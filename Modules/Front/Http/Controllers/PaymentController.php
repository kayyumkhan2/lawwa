<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\{Address,Notification,Order,Product,User,ProductCart,Booking,ServiceCart,MembershipUser,MembershipPlan,UserFreeService,PaymentHistory};
use App\Models\{CourseUser,CertificateUser,UserAddress};
use Illuminate\Support\Facades\Http;
use App\Helpers\Sendnotifications;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;
use Validator;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function PaymentPaymentHistoryCreate($type,$ShippingCharges=0,$amount,$txn_id,$status="Successed")
    {
        $PaymentHistory = PaymentHistory::where("txn_id","=","$txn_id")->first();
        if (!$PaymentHistory=="") {
            return true;
        }
        PaymentHistory::create([
            'user_id'         =>Auth::id(),
            'type'            => $type,
            'ShippingCharges' => $ShippingCharges,
            'amount'          => $amount,
            'txn_id'          => $txn_id,
            'status'          => $status,
        ]);
    }
    public function Payment(Request $request)
    { 
        try{
            $Payments =  request()->query('billplz');
            $paymentstatus  =  $Payments['paid'];
            if($paymentstatus=="true"){
                return redirect()->route('payment.success',$Payments['id']);
            }
            elseif($paymentstatus=="false"){
                return redirect()->route('payment.fail',$Payments['id']);
            }  
        } 
        catch (Exception $e){
            return redirect()->route('payment.fail',$Payments['id']);
        }
    }
    public function shippingOption($order=""){
        if (!$order=="") {
            if (!$order->shipping_option=="" && $order->shipping_option=="Gdexpress" ) {
                $response = Http::withHeaders([
                        'ApiToken' => '2626e67d-f58c-496e-b169-057b61788b7b',
                        'Subscription-Key' => '426bab58c16c441ebb2d36133a92483e',
                        'Content-Type' => "application/json"
                    ])->withBody(json_encode([[
                            'shipmentType' => 'Parcel',
                            'totalPiece' => '3',
                            "shipmentContent"=> "Office Document",
                            "shipmentValue"=> 200,
                            "shipmentWeight"=> 10,
                            "shipmentLength"=> 5,
                            "shipmentWidth"=> 0,
                            "shipmentHeight"=> 0,
                            "isDangerousGoods"=> true,
                            "companyName"=> "myGDEX Prime",
                            "receiverName"=> "Seng See",
                            "receiverMobile"=> "01139167123",
                            "receiverMobile2"=> "",
                            "receiverEmail"=> "myGDexPrime@Example.com",
                            "receiverAddress1"=> "No 23, Mardan Road",
                            "receiverAddress2"=> "Golder Park",
                            "receiverAddress3"=> "",
                            "receiverPostcode"=> "46000",
                            "receiverCity"=> "Petaling jaya",
                            "receiverState"=> "Selangor",
                            "receiverCountry"=> "Malaysia",
                            "IsInsurance"=> false,
                            "note1"=> "",
                            "note2"=> "",
                            "orderID"=> "",
                            "isCod"=> false,
                            "codAmount"=> 0,
                            "doNumber1"=> "",
                            "doNumber2"=> "",
                            "doNumber3"=> "",
                            "doNumber4"=> "",
                            "doNumber5"=> "",
                            "doNumber6"=> "",
                            "doNumber7"=> "",
                            "doNumber8"=> "",
                            "doNumber9"=> ""
                    ]]),'application/json')
                    ->post('https://myopenapi.gdexpress.com/api/demo/prime/CreateConsignment');
                    /*return $response;*/
                    $data = json_decode($response);
                 return   $tracking_id=$data->r[0];            
            }
            elseif (!$order->shipping_option=="" && $order->shipping_option=="Skypostpaid") {
                return   $tracking_id=NULL;            
            }
        }    
    }
    public function PaymentSuccess($id)
    {
      $address_id = session('address_id');
      $order_address = UserAddress::findorfail($address_id);
      $txn_id=  trim($id);
      $type="Order";
        try{
            if(!$id=""){
                $order = Order::where("txn_id","=","$txn_id")
                        ->firstorfail();
                $order_id=$order->id;
                if(!$this->PaymentPaymentHistoryCreate("Order",$order->ShippingCharges,$order->total_price,$txn_id,'Successed')) {       
                $order->OrderStatus()->update(["status"=>"ORDERED"]);
                Order::where("id","=",$order->id)->update(["current_status"=>"ORDERED"]);
                $order_id=$order->id;
                $order = Order::findorfail($order_id);
                $Cart=ProductCart::where('user_id' , Auth::user()->id)->delete();
                
                //write in Sendnotification.php helper

                Sendnotification('Order',$order);
                $tracking_id  =  $this->shippingOption($order);
                Order::where("id","=",$order->id)->update(["tracking_id"=>$tracking_id]);
                return view('front::payment.success',compact('order_id','type'));
            }
                return view('front::payment.success',compact('order_id','type'));
            }
        } 
        catch (Exception $e) 
        {
          return "Somting is Wronf";      
        }
    }
    public function PaymentFail($id)
    { 
        $txn_id=  trim($id);
        $type="Order";
        try{
            if(!$id=""){
                $order = Order::where("txn_id","=","$txn_id")
                       ->first();
                $order->OrderStatus()->update(["status"=>"PAYMENTFAILED"]);
                Order::where("id","=",$order->id)->update(["current_status"=>"PAYMENTFAILED"]);
                $this->PaymentPaymentHistoryCreate("Order",$order->ShippingCharges,$order->total_price,$txn_id,'Failed');       
                $order_id=$order->id;
                $order = Order::findorfail($order_id);
                Sendnotification('Order',$order);
                return view('front::payment.fail',compact('order_id','type'));
            }  
        } 
        catch (Exception $e) 
        {
          return "Somting is Wronf";      
        }      
    }
    //Booking Payment   
    public function BookingPayment(Request $request)
    { 
        try{
            $Payments =  request()->query('billplz');
            $paymentstatus  =  $Payments['paid'];
            if($paymentstatus=="true"){
                return redirect()->route('Booking.payment.success',$Payments['id']);
            }
            elseif($paymentstatus=="false"){
                return redirect()->route('Booking.payment.fail',$Payments['id']);
            }  
        } 
        catch (Exception $e){
            return redirect()->route('Booking.payment.fail',$Payments['id']);
        }
          
    }
    public function BookingPaymentSuccess($id)
    {
      $txn_id=  trim($id);
      $type="Booking";
        try{
            if(!$id=""){
                $booking = Booking::where("txn_id","=","$txn_id")
                        ->first();
                $booking_id=$booking->id;
                if(!$this->PaymentPaymentHistoryCreate("Booking",$ShippingCharges="0",$booking->amount,$txn_id)){      
                $booking->BookingStatus()->update(["status"=>"Booked"]);
                Booking::where("id","=",$booking->id)->update(["current_status"=>"Booked"]);
                foreach(GetServiceCart() as $cartdata)
                {
                   if($cartdata->type=="Free"){
                       $FreeService = array($cartdata->service_id);
                       UserFreeService::where('user_id',Auth::id())->where('service_id' , $cartdata->service_id)->delete();
                    }
                }
                $Cart=ServiceCart::where('user_id' , Auth::user()->id)->delete();
                $booking= Booking::findorfail($booking_id);
                Sendnotification('Booking',$booking);
                return view('front::payment.success',compact('booking_id','type'));
                }
                return view('front::payment.success',compact('booking_id','type'));
            }
        } 
        catch (Exception $e) 
        {
          return "Somting is Wrong";      
        }
          
    }
    public function BookingPaymentFail($id)
    { 
        $txn_id=  trim($id);
        $type="Booking";
        try{
            if(!$id=""){
                $booking = Booking::where("txn_id","=","$txn_id")
                        ->first();
                $this->PaymentPaymentHistoryCreate("Booking",$ShippingCharges=0,$booking->amount,$txn_id,'Failed');   
                $booking->BookingStatus()->update(["status"=>"PaymentFailed"]);
                Booking::where("id","=",$booking->id)->update(["current_status"=>"PaymentFailed"]);
                $booking_id=$booking->id;
                $booking= Booking::findorfail($booking_id);
                Sendnotification('Booking',$booking);
                return view('front::payment.fail',compact('booking_id','type'));
            }  
        } 
        catch (Exception $e) 
        {
          return "Somting is Wronf";      
        }      
    }


    //Membership Payment    
    public function MembershipPayment(Request $request)
    { 
        try{
            $Payments =  request()->query('billplz');
            $paymentstatus  =  $Payments['paid'];
            if($paymentstatus=="true"){
               // return view('front::payment.success');
                return redirect()->route('membership.payment.success',$Payments['id']);
            }
            elseif($paymentstatus=="false"){
                return redirect()->route('membership.payment.fail',$Payments['id']);
            }  
        } 
        catch (Exception $e){
            return redirect()->route('membership.payment.fail',$Payments['id']);
        }     
    }
    public function MembershipPaymentSuccess($id)
    {
      $txn_id=  trim($id);
      $type="Membership";
        try{
            if(!$id=""){
                $Membership = MembershipUser::where("txn_id","=","$txn_id")->where("user_id","=",Auth::id())
                        ->first();
                $membership_id=$Membership->id;
                if(!$this->PaymentPaymentHistoryCreate("Membership",$ShippingCharges="0",$Membership->amount,$txn_id)) {       
                $MembershipPlan=MembershipPlan::where('id',$Membership->membership_plan_id)->first();
                MembershipUser::where("id","=",$Membership->id)->update(["payment_status"=>"SUCCESS"]);
                User::where("id","=",Auth::id())->update(["membership_plan_id"=>$Membership->membership_plan_id]);
                UserFreeService::where('user_id',Auth::id())->delete();
                foreach ($MembershipPlan->MemberShipServices as $key => $value) {
                    UserFreeService::firstOrCreate(["service_id"=>$value->id,"user_id"=>Auth::id()]);
                    ServiceCart::updateOrCreate(["service_id"=>$value->id,"user_id"=>Auth::id()],
                                                ["service_id"=>$value->id,"user_id"=>Auth::id(),"type"=>"Free"]);
                }
                $membership_id=$Membership->id;
                Sendnotification('Membership',$MembershipPlan);
                return view('front::payment.success',compact('membership_id','type'));
            }
                return view('front::payment.success',compact('membership_id','type'));
            }
        } 
        catch (Exception $e) 
        {
          return "Somting is Wrong";      
        }      
    }
    public function MembershipPaymentFail($id)
    { 
        $txn_id=  trim($id);
        $type="Membership";
        try{
            if(!$id=""){
                $Membership = MembershipUser::select('txn_id','id')
                       ->where("txn_id","=","$txn_id")
                       ->first();
                MembershipUser::where("id","=",$Membership->id)->update(["payment_status"=>"PAYMENTFAILED"]);
                $membership_id=$Membership->id;
                return view('front::payment.fail',compact('membership_id','type'));
            }  
        } 
        catch (Exception $e) 
        {
          return "Somting is Wrong";      
        }      
    }

    //Course Payment    
    public function CoursePayment(Request $request)
    { 
        try{
            $Payments =  request()->query('billplz');
            $paymentstatus  =  $Payments['paid'];
            if($paymentstatus=="true"){
               // return view('front::payment.success');
                return redirect()->route('course.payment.success',$Payments['id']);
            }
            elseif($paymentstatus=="false"){
                return redirect()->route('course.payment.fail',$Payments['id']);
            }  
        } 
        catch (Exception $e){
            return redirect()->route('course.payment.fail',$Payments['id']);
        }     
    }
    public function CoursePaymentSuccess($id)
    {
      $txn_id=  trim($id);
      $type="Course";
        try{
            if(!$id=""){
                $Course = CourseUser::where("txn_id","=","$txn_id")->where("user_id","=",Auth::id())
                        ->first();
                $course_id=$Course->id;
                if(!$this->PaymentPaymentHistoryCreate("Course",$ShippingCharges="0",$Course->amount,$txn_id)){       
                $CourseUser=CourseUser::where('id',$Course->course_id)->first();
                CourseUser::where("id","=",$Course->id)->update(["payment_status"=>"SUCCESS"]);
                return view('front::payment.success',compact('course_id','type'));
            }
                return view('front::payment.success',compact('course_id','type'));
            }
        } 
        catch (Exception $e) 
        {
          return "Somting is Wrong";      
        }      
    }
    public function CoursePaymentFail($id)
    { 
        $txn_id=  trim($id);
        $type="Course";
        try{
            if(!$id=""){
                $Course = CourseUser::select('txn_id','id')
                       ->where("txn_id","=","$txn_id")
                       ->first();
                CourseUser::where("id","=",$Course->id)->update(["payment_status"=>"PAYMENTFAILED"]);
                $course_id=$Course->id;
                return view('front::payment.fail',compact('course_id','type'));
            }  
        } 
        catch (Exception $e) 
        {
          return "Somting is Wrong";      
        }      
    }
}
