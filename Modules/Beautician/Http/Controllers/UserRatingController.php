<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{Wallet,Booking,UserRating};
use Illuminate\Http\Request;
use Auth;
class UserRatingController extends Controller
{
	public $pagename="Reviews & Ratings";
    public function index()
    {
	    $ReceivedRating = UserRating::where('receiver_id',Auth::id())->orderBy('id', 'DESC')->paginate(4, ['*'], 'receivedrating');
	    $SentRating = UserRating::where('sender_id',Auth::id())->orderBy('id', 'DESC')->paginate(4, ['*'], 'sentrating');
	    return view('beautician::ratings.index',compact('ReceivedRating','SentRating'))->with('pagename',$this->pagename);;
    }
    
    public function create(Request $request)
    {
    	$Booking=Booking::findorfail($request->query('id'));
        return view('beautician::ratings.create',compact('Booking'))->with('pagename',$this->pagename);
    } 
    public function store(Request $request)
    {
        $comments=$request->comments;
        $beautician=$request->beautician;
        $ratings=$request->ratings;
        $booking_id=$request->booking_id;
        foreach ($beautician as $key => $id) {
        	if ($ratings[$key]=="") {
        		 continue;
        	}
            UserRating::create(["rating"=>$ratings[$key],"comment"=>$comments[$key],"receiver_id"=>$beautician[$key],"sender_id"=>Auth::id(),"booking_id"=>$booking_id]);
        }
        alert()->Success('Success', 'Rating Send Successfully')->autoclose(2000);
        return redirect()->route('beautician.ratings.index');
	}
}
