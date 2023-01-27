<?php
namespace Modules\Customer\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use App\Models\{Booking,User};
use Illuminate\Http\Request;
use Auth;
use Alert;
use Illuminate\Pagination\LengthAwarePaginator;
class BookingController extends Controller
{
   
    public function Booking(Request $request){
        $pagename="My Bookings";
        $Bookings= Auth::user()->UserBookings()->orderBy('created_at', 'desc')->paginate(3);
        //$Bookings = Booking::orderBy('created_at', 'desc')->where('customer_id',Auth::id())->paginate(3);
        if($request->has('filter') ) {
            $status= $request->query('filter');
            if ($status=="All") {
                $Bookings->appends(['status' => $status]);
                return view('customer::bookings.bookings',compact('Bookings','pagename'));
            }
            if ($status=="UPCOMING") {
                $Bookings = array();
                $todaydate = date("Y-m-d");
                  $upcomingbooking  = Auth::user()->UserBookings()->orderBy('created_at', 'desc')->where('date', '>=', $todaydate)->get();
                  foreach ($upcomingbooking as $key => $upcoming) {
                    if($upcoming->date==$todaydate && date('H:i:s')>$upcoming->start_time){
                      continue;
                    } 
                    $upcomingbookingdata[]=$upcoming;
                    $Bookings = $upcomingbookingdata;
                  }
                $paginator = $this->getPaginator($request, $Bookings);
                return view('customer::bookings.bookings',compact('pagename'))->with('Bookings', $paginator);;
                }
            else
            {
                $Bookings = Auth::user()->UserBookings()->orderBy('created_at', 'desc')->where('current_status',$status)->paginate(3);
                $Bookings->appends(['status' => $status]);
            }
            return view('customer::bookings.bookings',compact('Bookings','pagename'));
        }
        return view('customer::bookings.bookings',compact('Bookings','pagename'));
    }
    private function getPaginator(Request $request, $items)
    {
        $total = count($items); // total count of the set, this is necessary so the paginator will know the total pages to display
        $page = $request->page ?? 1; // get current page from the request, first page is null
        $perPage = 3; // how many items you want to display per page?
        $offset = ($page - 1) * $perPage; // get the offset, how many items need to be "skipped" on this page
        $items = array_slice($items, $offset, $perPage); // the array that we actually pass to the paginator is sliced
        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
    } 
    public function BookingDetails($id)
    {   
    	$pagename="Booking Details";
        $Booking = Booking::find($id);
        if ($Booking=="") {
            alert()->info('Oops', 'Booking data not found')->autoclose(3000);
            return redirect()->route("customer.Booking");
        }
        return view('customer::bookings.booking-detail',compact('Booking','pagename'));
    }
    public function BookingStart($assign_beautician_id,$booking_id)
    {  
       $Booking = Booking::findorfail($booking_id);
       if ($Booking->employee_id==$assign_beautician_id) {
            $Booking->BookingStatus()->update(["status"=>"Start"]);
            $Booking->BookingStatus()->update(["status"=>"Scanned"]);
            Booking::where("id","=",$booking_id)->update(["current_status"=>"Start"]);
            Booking::where("id","=",$booking_id)->update(["current_status"=>"Scanned"]);
            alert()->Success('Success', 'Booking Start Successfully')->autoclose(3000);
            return redirect()->back(); 
        }
        else{
            alert()->error('error', 'Something is went to wrong')->autoclose(3000);
            return redirect()->back();
        } 
    }
    //if time is less then 48 houres then user can not
    public function checkTimeVlidation($booking_id){
        $Booking= Booking::findorfail($booking_id);
        $to      = \Carbon\Carbon::createFromFormat("Y-m-d H:i:00", "$Booking->date $Booking->start_time");
        $from    = \Carbon\Carbon::now();
        $minutes = $to->diffInMinutes($from);
        $hours   = floor($minutes / 60);
        if ($hours>48) {
            return true;
        }
        else{
            return false;   
        }
    }
    public function cancel(Request $request)
    {
       if($this->checkTimeVlidation($request->booking_id)===true){
            try {
                return StatusChange($request->status,$request->booking_id,"Booking",$request);   
            } 
            catch (Exception $e) {
                return $e;
            }
        }
        else{
            alert()->warning('Error',"You can postpone or cancel the booking before 48 hours.")->autoclose(3000);
            return redirect()->back();
        } 
    }
    public function IsOnBooking($bookings,$date,$end_time,$start_time)
    {
       // If request data is not provided then return false
        if(!isset($bookings) or !isset($date) or !isset($start_time) or !isset($end_time)) {
                return false;
        }
        // Set time
        $reqStartTime = $start_time;
        $reqEndTime   =  $end_time;
        $time = strtotime($end_time);
        $reqEndTime = date("H:i:00", strtotime('+1 minutes', $time));
        foreach($bookings as $booking) {
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
    public function postpone(Request $request)
    {
        if($this->checkTimeVlidation($request->booking_id)===true){
            $Booking = Booking::findorfail($request->booking_id);
            if($Booking->BookingAssign->count()>0){
                alert()->info('Sorry','You can not postpone booking after assigned')->autoclose(2000);
                return redirect()->back();  
            }
            else{
            $to      = \Carbon\Carbon::createFromFormat("Y-m-d H:i:00", "$Booking->date $Booking->end_time");
            $from    = \Carbon\Carbon::createFromFormat('Y-m-d H:i:00', "$Booking->date $Booking->start_time");
            $minutes = $to->diffInMinutes($from); 
            $hours   = floor($minutes / 60);
            $min     = $minutes - ($hours * 60);
            $end_time   = date('H:i:s',strtotime('+'.$hours.' hour +'.$min.' minutes',strtotime($request->time)));
            foreach ($Booking->BookingUsers as $key => $user){
                if ($this->IsOnBooking(($user->UserBookings)->where('date', $request->date),$request->date,$end_time,date("H:i:s", strtotime("$request->time")))==false) {
                    alert()->warning('Error',"$user->full_name booked on Other booking at this time")->autoclose(3000);
                    return redirect()->back();  
                }
                else{
                     $request->merge([
                        'start_time' => date("H:i:s", strtotime("$request->time"))
                    ]);
                    $Booking->date=$request->date;
                    $Booking->start_time=$request->start_time;
                    $Booking->end_time=$request->$end_time;
                    $Booking->save();
                    try {
                            return StatusChange('Postponed',$Booking->id,"Booking"); 
                        } 
                        catch (Exception $e) {
                            return $e;
                    } 
                }  
            }               
          }
        }
        else{
            alert()->warning('Error',"You can postpone or cancel the booking before 48 hours.")->autoclose(3000);
            return redirect()->back();  
        }
    }
}
