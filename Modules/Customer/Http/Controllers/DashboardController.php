<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\{User,Booking,Order};
use Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
class DashboardController extends Controller
{
 

  public function index(){
    $date             = Carbon::today();
    $totalorders      = Order::where('user_id',Auth::id())->count();
    $totalbooking     = Auth::user()->UserBookings()->count();
    $todaydate        = date("Y-m-d");
    $upcomingbooking  = Auth::user()->UserBookings()->orderBy('created_at', 'desc')->where('date', '>=', $todaydate)->get();
    $previousbooking  = Auth::user()->UserBookings()->orderBy('created_at', 'desc')->where('date', '<=', $todaydate)->get();
    $upcomingbookingdata=[];
    foreach ($upcomingbooking as $key => $upcoming) {
      if($upcoming->date==$todaydate && date('H:i:s')>$upcoming->start_time){
        continue;
      }
      $upcomingbookingdata[]=$upcoming;
    }
    $previousbookingdata=[];
    foreach ($previousbooking as $key => $previous) {
      if($previous->date==$todaydate && date('H:i:s')<$previous->start_time){
        continue;
    }
      $previousbookingdata[]=$previous;
    }

  $data = array(
      'totalorders'     => $totalorders,
      'totalbooking'    => $totalbooking,
      'upcomingbooking' => count($upcomingbookingdata),
      'previousbooking' => count($previousbookingdata)
    );
    return view('customer::dashboard')->with($data);
    }
  
  public function Bookingfilter( Request $request, $type){
    $pagename="My Bookings";
    $Bookings=[];
    $previousbookingdata=[];
    $todaydate = date("Y-m-d");
    if($type=="upcoming") {
      $upcomingbooking  = Auth::user()->UserBookings()->orderBy('created_at', 'desc')->where('date', '>=', $todaydate)->get();
      foreach ($upcomingbooking as $key => $upcoming) {
        if($upcoming->date==$todaydate && date('H:i:s')>$upcoming->start_time){
          continue;
        } 
        $upcomingbookingdata[]=$upcoming;
        $Bookings = $upcomingbookingdata;
      }
    }
    else{
      $previousbooking  = Auth::user()->UserBookings()->orderBy('created_at', 'desc')->where('date', '<=', $todaydate)->get();
      foreach ($previousbooking as $key => $previous) {
          if($previous->date==$todaydate && date('H:i:s')<$previous->start_time){
            continue;
        }
          $previousbookingdata[]=$previous;
      }
      $Bookings = $previousbookingdata;
    }
    $paginator = $this->getPaginator($request, $Bookings);
    return view('customer::bookings.bookings',compact('pagename'))->with('Bookings', $paginator);;
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
}
