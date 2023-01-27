<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\{Service,Booking,BookingService,ServiceCart,User,UserAddress,BookingUser,WorkingTime,Country};
use Billplz\Client;
use Illuminate\Http\Client\Response;
use Auth;
use Alert;
use Toastr;
use Validator;
use Carbon\Carbon as Time;
class BookingController extends Controller
{
    public function summary()
    {
        return view('admin.summary', [
            'bookings'  => Booking::allLatest('7'),
            'business'  => BusinessOwner::first(),
            'latest'    => Booking::allLatest('+7 days')
        ]);
    }
    public function history()
    {
        return view('admin.history', [
            'bookings' => Booking::allLatest('7'),
            'business' => BusinessOwner::first(),
            'history'  => Booking::allHistory()
        ]);
    }
    public function finduser(Request $request)
    {
        $validation  = Validator::make($request->all(), [ 
           'mobile' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['message' => 'Please enter mobile number','status' => 'error']);
        }
        $phone_no   = $request->input('mobile');
        $id         = $request->input('id');
        $user       = User::where('phone_no',$phone_no)->first();
        $name ="#name".$id;
        if(!$user==""){
           return response()->json(['message' => 'Customer found','status' => 'ok','username'=>$user->full_name,'id'=>$name]);
        } 
        else{
            return response()->json(['message' => 'Customer not found','status' => 'error','id'=>$name]);
        }
    }
    public function create()
    {
        $countries = Country::get(["name","id"]);
        $monthYear= toMonthYear(getNow());
        $date = monthYearToDate($monthYear);
        return view('front::book-service', [
            'date'          => $date,
            'dateString'    => $date->format('m-Y'),
            'months'        => getMonthList($monthYear),
            'countries'        =>$countries,
        ]);
    }
    public function IsOnBooking($customer,$date,$end_time,$start_time)
    {
        // If request data is not provided then return false
        if(!isset($customer) or !isset($date) or !isset($start_time) or !isset($end_time)) {
            return false;
        }
        try{
            $user = User::where('phone_no',$customer)->first();
        }
        catch(ModelNotFoundException $e){
            return false;
        }
        // Set time
        
        $reqStartTime = $start_time;
        $reqEndTime   =  $end_time;
        $time         = strtotime($end_time);
        $reqEndTime   = date("H:i:00", strtotime('+1 minutes', $time));
        $bookings     = $user->UserBookings->where('date', $date)->where('current_status','!=','Cancel')->where('current_status','!=','Pending')->where('current_status','!=','PaymentFailed')->where('current_status','!=','Refunded');
        // Loop through booking results
        foreach($bookings as $booking) {
            // Booking start and end time
            $bookStartTime = $booking->start_time;
            $bookEndTime = $booking->end_time;
            // If times are conflicting with any exiting booking
            // Then break and return false
            if ($reqStartTime >= $bookStartTime && $reqEndTime <= $bookEndTime ||
                $reqStartTime < $bookStartTime && $reqEndTime > $bookStartTime ||
                $reqStartTime < $bookEndTime && $reqEndTime > $bookEndTime) {
                return false;
            }
        }
        return true;
    }
    public function store(Request $request)
    {
        // Use logged in customer ID
        $request->validate([
           'type'       => 'required',
           'time'       => 'required',
           'date'       => 'required',
           "customer"    => "required|array|min:1",
           "customer.*"  => "required|string|distinct|min:1",
        ]);
        $request->merge(['customer_id' => Auth::id()]);
        $selected_address = UserAddress::findorfail($request->location);
       //insert address id to session for access on payment success page
       $address_type     = $selected_address->Type;
       $location          = $selected_address->Name.' , '.$selected_address->MobileNumber.' , '.$selected_address->Address_line1.' , '.$selected_address->GetCity->name.','.$selected_address->Zip_Postcode.' ('.$selected_address->GetState->name.') , '.$selected_address->GetCountry->name;
        if($request->start_time) {
            $request->merge([
                'end_time' => date("H:i:s", strtotime("$request->time"))
            ]);
        }
        // Convert start time to proper time format
        $request->merge([
            'start_time' => date("H:i:s", strtotime("$request->time"))
        ]);
        $end_time = date("H:i:s", strtotime("$request->time"));
        if(GetServiceCart()->count()>0)
        {  
            $amount=0;
            foreach(GetServiceCart() as $cartdata)
            {
               if($cartdata->type=="Buy"){
                      $amount+= $cartdata->ServiceDetails->amount;
                }
            }
            if ($amount<=0) {
                alert()->error('error', 'Please select at least one paid service')->autoclose(3000);
                return redirect()->back()->withInput();
            }
        }
        else
        {
            alert()->error('error', 'Service cart is empty')->autoclose(3000);
            return redirect()->back()->withInput();
        } 
        $start_time = strtotime($request->start_time);
        $start_time_convert = date ("Y-m-d H:i", $start_time);
        $minutess=0;  
        foreach(GetServiceCart() as $value) {
           $service_hours=$value->ServiceDetails->houre;
           $minutess=$value->ServiceDetails->minute+$minutess;
           $newtime = strtotime(''.$start_time_convert.' + '.$value->minute.' minute');
           $start_time_convert= date('Y-m-d H:i:s', $newtime);
        }
        $minutes = $minutess*(count($request->customer));
        $service_taking_hours = $service_hours*(count($request->customer));
        $hours   = floor($minutes / 60);
        $min     = $minutes - ($hours * 60);
        if ($service_taking_hours>0) {
            $hours=$hours+$service_taking_hours;
        }    
        // Parameter variables
        $reqStartTime     = toTime($request->start_time);
        $end_time_booking = date('H:i:s',strtotime('+'.$hours.' hour +'.$min.' minutes',strtotime($request->start_time)));
        foreach ($request->customer as $key => $user_number) {
            if ($this->IsOnBooking($user_number,$request->date,$end_time_booking,date("H:i:s", strtotime("$request->time")))==false) {
                    alert()->warning('Error','Customer booked on Other booking at this time')->autoclose(3000);
                    return redirect()->back()->withInput();  
            }      
        }
        if($request->type=="group") { 
            $booking_at="salon";
        }
        else{
            $booking_at="home";
        }
        $billplz = Client::make('289ad88c-ca09-42a3-a6e3-46ad93b96fe4');
        $billplz->useSandbox();
        $bill = $billplz->bill();
        $email=Auth::user()->email;
        $full_name=Auth::user()->full_name ? Auth::user()->full_name : "Guest" ;
        $response = $bill->create(
          'lusclvw8',
          "$email",
           null,
          "$full_name",
          \Duit\MYR::given($amount*100),
          'https://lawwa.ezxdemo.com/admin',
          'Maecenas eu placerat ante.',
          ['redirect_url' => url("booking/payment")]
        );
        $data=$response->toArray();
        $url=$data['url'];
        if($response->getStatusCode() !== 200) {
           throw new SomethingHasGoneReallyBadException();
        }
        $booking = Booking::create([
            'customer_id' =>Auth::id(),
            'employee_id' => "",
            'start_time'  => $request->start_time,
            'type'        => $request->type,
            'end_time'    => $end_time_booking,
            'date'        => $request->date,
            'location'    => $location,
            'txn_id'      => $data['id'],
            'note'        => $request->note,
            'amount'      =>$amount,
            'booking_at'  =>$booking_at,
        ]);

        $services = [];
        foreach (GetServiceCart() as $value) {
            $service = new BookingService;
            $service->booking_id = $value->booking_id;
            $service->service_id = $value->service_id;
            $service->type = $value->type;
            array_push($services, $service);
        }
        $booking->BookingServices()->saveMany($services);
        $booking->BookingStatus()->create($services);
        foreach ($request->customer as $key => $user_number) {
            $user=User::where('phone_no' ,$user_number)->first();
            $BookingUsers = BookingUser::create([
                'user_id' =>$user->id,
                'booking_id' => $booking->id,
            ]);
        }
        return redirect($url);
    }
}
