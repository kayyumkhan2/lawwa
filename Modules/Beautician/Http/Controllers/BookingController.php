<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\{Booking,BookingUser,BookingAssign,BookingStatus};
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Auth;
use Exception;
class BookingController extends Controller
{
   
    public function Booking(Request $request){
        $pagename="My Bookings";
        $Bookings= Auth::user()->BookingAssign()->orderBy('created_at', 'desc')->paginate(4);
        if($request->has('filter') ) {
            $status= $request->query('filter');
            if ($status=="All") {
                $Bookings->appends(['status' => $status]);
                return view('beautician::bookings.bookings',compact('Bookings','pagename'));
            }
            if ($status=="UPCOMING") {
                $date = date("Y-m-d");
                $time = date('H:i:s');
                $Bookings = Auth::user()->BookingAssign()->orderBy('created_at', 'desc')->WhereIN('current_status',['Postponed','OnTheWay','Booked','Assigned','Accepted','Booked'])->where('date', '>=', $date)->where('start_time', '>=', $time)->paginate(3);
                $Bookings->appends(['filter' => $status]);
            }
            else
            {
                $Bookings = Auth::user()->BookingAssign()->orderBy('created_at', 'desc')->where('current_status',$status)->paginate(3);
                $Bookings->appends(['status' => $status]);
            }
            return view('beautician::bookings.bookings',compact('Bookings','pagename'));
        }
        return view('beautician::bookings.bookings',compact('Bookings','pagename'));
    }

   public function BookingDetails($id)
    {   
    	$pagename="Booking Details";
        $Booking = Booking::find($id);
         if ($Booking=="") {
            alert()->info('Oops', 'Booking data not found')->autoclose(3000);
            return redirect()->route("beautician.Booking");
        }
        return view('beautician::bookings.booking-detail',compact('Booking','pagename'));
    }
    public function BookingsTemperatureUpload($booking_id)
    {   
        $pagename="Temperature update";
        $Booking = Booking::findorfail($booking_id);
        return view('beautician::bookings.temperature.index',compact('Booking','pagename','booking_id'));
    }
    public function BookingsTemperatureStore(Request $request)
    {   
        $temperature=$request->temperature;
        $customer=$request->customer;
        foreach ($customer as $key => $id) {
            $Temperature_image=$request->file('Temperature_image');
            $Temperature_image_file= uploadImg($Temperature_image[$key],"temperature",);
            BookingUser::where('id',$id)->update(["temperature"=>$temperature[$key],"Temperature_image"=>$Temperature_image_file]);
        }
        $BookingAssign= BookingUser::where('id',$id)->first();
        $status_change=BookingStatus::where("booking_id","=",$BookingAssign->booking_id)->update(['status'=>'Temperature uploaded']);
        $current_status=Booking::where("id","=",$BookingAssign->booking_id)->update(['current_status'=>'Temperature uploaded']);
        alert()->Success('Success', 'Temperature updated Successfully')->autoclose(2000);
        return back();
    }
    public function BookingsTemperatureStoreBeautician(Request $request)
    {   
        $temperature=$request->temperature;
        $beautician=$request->beautician;
        foreach ($beautician as $key => $id) {
            $Temperature_image=$request->file('Temperature_image');
            $Temperature_image_file=  uploadImg($Temperature_image[$key],"temperature");
            BookingAssign::where('id',$id)->update(["temperature"=>$temperature[$key],"Temperature_image"=>$Temperature_image_file]);
        }
        $BookingAssign= BookingAssign::where('id',$id)->first();
        $status_change=BookingStatus::where("booking_id","=",$BookingAssign->booking_id)->update(['status'=>'Temperature uploaded']);
        $current_status=Booking::where("id","=",$id)->update(['current_status'=>'Temperature uploaded']);
        alert()->Success('Success', 'Temperature updated Successfully')->autoclose(2000);
        return back();
    }
    
    public function BookingStatusChange(Request $request, $booking_id)
    {  
        try {
            return StatusChange($request->status,$booking_id,"Booking");   
        } 
        catch (Exception $e) {
            return $e;
        } 
    }
    public function cancel(Request $request)
    {
        try {
            return StatusChange($request->status,$request->booking_id,"Booking",$request);   
        } 
        catch (Exception $e) {
            return $e;
        } 
    }
}
