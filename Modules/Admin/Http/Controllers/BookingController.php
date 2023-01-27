<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Booking,BeauticianWorkingTime,User,BookingAssign,WorkHistory,WorkingTime};
use Carbon\Carbon;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
class BookingController extends Controller
{
 
    function __construct() {
        $this->middleware('permission:bookings-list|bookings-create|bookings-bookingassign|bookings-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:bookings-assign', ['only' => ['bookingassign', 'bookingassigntobeautician']]);
        $this->middleware('permission:bookings-list', ['only' => ['index']]);
        $this->middleware('permission:bookings-show', ['only' => ['show']]);
    }   
 public function index(Request $request)
    {
      $uri = $request->path();
      $Bookings = Booking::orderBy('id', 'DESC')->get();
      return view('admin::bookings.index', compact('Bookings'));
    }
  public function show($id)
    {
      $Booking = Booking::findorfail($id);
      $Beauticians = User::orderBy('id','DESC')->role('Beautician')->get();
      return view('admin::bookings.show',compact('Booking','Beauticians'));
    }
  public function bookingassign($id,$monthYear="07-2020",$employeeID='187',Request $request)
  {
    
    // List of months
    $monthList = getMonthList($monthYear);

    // Set date string
    $date = monthYearToDate($monthYear);

    // Get bookings of the month
    $bookings = Booking::where('date', '<=', $date->endOfMonth()->toDateString())
        ->where('date', '>=', $date->startOfMonth()->toDateString())
        ->get()
        ->sortBy('date');

    // Find employee
    $employee = User::find($employeeID);

    if ($employeeID) {
        // Find working time by employee ID
        $workingTimes = WorkingTime::where('employee_id', $employeeID);
    }
    else {
        // Else get all working times
        $workingTimes = WorkingTime::all();
    }

    $workingTimes = $workingTimes->where('date', '<=', $date->endOfMonth()->toDateString())
        ->where('date', '>=', $date->startOfMonth()->toDateString())
        ->get();
    $Booking = Booking::findorfail($id);
    $Beauticians = User::orderBy('id','DESC')->role('Beautician')->get();
    if($request->has('filter') ) {
            $user_id    = $request->query('filter');
            $bTimes     = BeauticianWorkingTime::where('user_id',$user_id)->get();
            $beautician = User::findorfail($user_id);
            $Bookings   = $beautician->BookingAssign()->orderBy('created_at', 'desc')->where('date', '=',$Booking->date)->get();
            return view('admin::bookings.assign-booking', compact('Booking','bTimes','Beauticians','Bookings','beautician'));
    }
    return view('admin::bookings.assign-booking', [
        'bookings'      => $bookings,
        'business'      => User::first(),
        'employeeID'    => $employeeID,
        'employee'      => $employee,
        'roster'        => $workingTimes,
        'date'          => $date,
        'dateString'    => $date->format('m-Y'),
        'months'        => $monthList,
        'Beauticians'   => $Beauticians,
        'Booking'       => $Booking,
    ]);
    // return view('admin::bookings.assign-booking',compact('Booking','Beauticians'));
  }
  public function bookingassigntobeautician(Request $request ,$id)
    {
      $booking_info=  $Booking = Booking::findorfail($id);
      $request->merge(['customer_id' => $Booking->customer_id]);
      $start_time = strtotime($Booking->start_time);
      $start_time_convert = date ("Y-m-d H:i", $start_time);
      $minutess=0;  
      foreach ($Booking->ServiceDetails as $value) {
        $service_hours=$value->houre;
        $minutess =$value->minute+$minutess;
        $newtime  = strtotime(''.$start_time_convert.' + '.$value->minute.' minute');
        $start_time_convert= date('Y-m-d H:i:s', $newtime);
      }
      $minutes = $minutess*($Booking->BookingUsers)->count();
      $service_taking_hours = $service_hours*($Booking->BookingUsers)->count();
      $hours   = floor($minutes / 60);
      $min     = $minutes - ($hours * 60);
      $Booking->employee_id;
      // Parameter variables
      if ($service_taking_hours>0) {
            $hours=$hours+$service_taking_hours;
      }
      $reqStartTime = toTime($Booking->start_time);
      $reqEndTime   = date('H:i:s',strtotime('+'.$hours.' hour +'.$min.' minutes',strtotime($Booking->start_time)));
      $pStartTime   = $Booking->start_time;
      $pEndTime     = $reqEndTime;
      //  Get bookings of the date
      $bookings     = User::findorfail($request->employee_id)->BookingAssign()->where('date', '=', $Booking->date)->where('current_status','!=','Cancel')->where('current_status','!=','Pending')->where('current_status','!=','PaymentFailed')->where('current_status','!=','Refunded')->get();
      // Loop through booking results
      foreach($bookings as $booking) {
        // Booking start and end time
        $bookStartTime = $booking->start_time;
        $bookEndTime   = $booking->end_time;
        // If times are conflicting with any exiting booking
        // Then break and return false
        if($reqStartTime >= $bookStartTime && $reqEndTime <= $bookEndTime ||
            $reqStartTime < $bookStartTime && $reqEndTime > $bookStartTime ||
            $reqStartTime < $bookEndTime && $reqEndTime > $bookEndTime) {
            alert()->warning('Error','Beautician booked on Other booking at this time')->autoclose(3000);
          return redirect()->back();
        } 
      }
      // Get the day value from attribute
      // Convert to enum day
      // e.g. MONDAY, TUESDAY
      $day = strtoupper(parseDateTime($Booking->date)->format('l'));
      // Get business time of the date
      $btTime = BeauticianWorkingTime::where('day', $day)->where('user_id',$request->employee_id)->first();
      // If not found, then return false
      if ($btTime == null) {
              alert()->warning('Error','Beautician not Working this time')->autoclose(2000);
              return redirect()->back()->with('success', 'Not Working this time');   
      }
      // Time alias
      $b = $btTime->start_time;
      $e = $btTime->end_time; 
      // Check if booking is in between employee working time
      if ($pStartTime >= $b and $pEndTime <= $e) {
        BookingAssign::create(['booking_id'=>$Booking->id,'assign_user_id'=>$request->employee_id,'status'=>"Assigned" ]);
            $booking = Booking::where('id',$Booking->id)->update([
            'customer_id' =>$Booking->customer_id,
            'employee_id' => $request->employee_id,
            'start_time' => $Booking->start_time,
            'type' => $Booking->type,
            'end_time' => $reqEndTime,
            'date' => $Booking->date,
            'location' => $request->location,
            'note' => $Booking->note,
            'amount' =>$Booking->amount,
            'current_status' =>"Assigned",
        ]);
            $Booking->BookingStatus()->update(["status"=>"Assigned"]);
            $booking= Booking::findorfail($id);
            Sendnotification('Booking',$booking,$booking->customer_id);
            Sendnotification('Booking',$booking,$request->employee_id);
            alert()->success('Done','Booking assigned successfully')->autoclose(2000);
            return redirect()->back();  
      }
      else{  
            alert()->warning('Error','Not Working this time')->autoclose(2000);
            return redirect()->back()->with('success', 'Not Working this time');    
       }
    }
  public function destroy($id)
    {
        Booking::destroy($id); 
        toastr()->success('Booking Deleted successfully!');
        return redirect()->route('Booking.index');
    }
    public function Downloadinvoice($id)
    {
        $booking = Booking::findorfail($id);
        $pdf = PDF::loadView('admin::bookings.invoice',['Booking' =>$booking]);
        return $pdf->download("#booking-$booking->id.pdf");
    }
     public function Bookingdatefilter(Request $request)
    {
        $dateS = $request->input('from');
        $dateE = $request->input('to');
        $Bookings = Booking::where('date', '>=', $dateS)
                           ->where('date','<=', $dateE)
                           ->get()->sortByDesc("id");
      return view('admin::bookings.index', compact('Bookings'));
    }
    
}
