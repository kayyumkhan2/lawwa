<?php
namespace Modules\Customer\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\{UserRating,UserAddress,ProfileInformation,Service,User,BeauticianService,Booking,BeauticianGallery};
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Validator;
use Auth;
use DB;
class AssignedBeauticianProfile extends Controller
{
    public function index($booking){
      $pagename="Beautician profile";
      $Beautician=  User::findorfail($booking);
      $ReceivedRating = UserRating::where('receiver_id',$Beautician->id)->orderBy('id', 'DESC')->get();
      $rating_counts  = DB::table('user_ratings')
                          ->select(DB::raw('count(*) as rating_count, rating'))
                          ->groupBy('rating')
                          ->where('receiver_id',$Beautician->id)
                          ->get();
          $array1 = array(1,2,3,4,5);
          $array2 = array();
          foreach ($rating_counts as $key => $value) {
                    $array2[] = $value->rating;
         
            }
            foreach (array_diff($array1, $array2) as $key => $value) {
                $rating_counts->put($rating_counts->count()+1,(object)['rating_count'=>0,'rating'=>$value]);
            }
      $BeauticianGallery = BeauticianGallery::where('user_id',$Beautician->id)->orderBy('created_at','DESC')->limit(8)->get();
      return view('customer::assignedbeauticianprofile.index',compact('Beautician','pagename','BeauticianGallery','rating_counts'));
    }

}
