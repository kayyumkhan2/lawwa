<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\PaymentHistory;
use Carbon\Carbon;
class PaymentController extends Controller
{
   function __construct() {
        $this->middleware('permission:Payments-list', ['only' => ['index']]);
    }
  public function index(Request $request)
    {
      switch (request()->query('filterrevenue')) {
        case "Booking":
           $Payments = PaymentHistory::where('type','Booking')->get()->sortByDesc("id");
          break;
        case "Order":
           $Payments = PaymentHistory::where('type','Order')->get()->sortByDesc("id");
          break;
        case "Certification":
           $Payments = PaymentHistory::where('type','Certification')->get()->sortByDesc("id");
          break;
        case "Membership":
           $Payments = PaymentHistory::where('type','Membership')->get()->sortByDesc("id");
          break;
        case "Course":
           $Payments = PaymentHistory::where('type','Course')->get()->sortByDesc("id");
          break;
        default:
          $Payments = PaymentHistory::all()->sortByDesc("id");
      }
       return view('admin::payments.index',compact('Payments'));  
    }
  public function paymentatefilter(Request $request)
   {
      $uri = $request->path();
      $dateS = $request->input('from');
      $dateS = new Carbon($dateS);
      $dateE = $request->input('to');
      $dateE = new Carbon($dateE);

      $dateE->addDays(1);      
      $Payments = PaymentHistory::where('created_at', '>=', $dateS)
                         ->where('created_at','<=', $dateE)
                         ->get()->sortByDesc("id");
     return view('admin::payments.index',compact('Payments'));  
   }
}
