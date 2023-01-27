<?php
namespace Modules\Customer\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{HealthCondition};
use Illuminate\Http\Request;
use Auth;
class HealthConditionController extends Controller
{
   public $pagename="Feedback";
   public function create()
   {
      $data = HealthCondition::where('user_id',Auth::id())->first();
      return view('customer::healthconditions.create',compact('data'));
   }
   public function store(Request $request)
   {
      $request->request->add(['Service_Focus' => json_encode($request->Service_Focus)]);
      $request->request->add(['user_id' => Auth::user()->id]);
      $validatedData=$request->all();
      if ($request->hasfile("Customer_Sign")){
         $Customer_Sign= uploadImg($request->Customer_Sign,"healthconditions");
      }
      $exiting =   HealthCondition::where('user_id',Auth::id())->exists();
      if (!$exiting) {
         $validatedData['Customer_Sign']=$Customer_Sign;
         HealthCondition::create($validatedData);
      }
      $validatedData = $request->except('_token','Customer_Sign');
      $validatedData['Customer_Sign']=$Customer_Sign;
      HealthCondition::where('user_id',Auth::id())->update($validatedData);
      alert()->Success('Thank you', 'We have received your health condition form and we would like to thank you for join to us.')->autoclose(4000);
      return back();
   }
}
