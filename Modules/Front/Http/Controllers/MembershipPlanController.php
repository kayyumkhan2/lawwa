<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Billplz\Client;
use Carbon\Carbon ;
use Illuminate\Http\Client\Response;
use App\Models\{MembershipUser};
use Auth;

class MembershipPlanController extends Controller
{
  public function store(Request $request)
    {
        $this->validate($request,[
           'plan' => 'required',
           'price' => 'required',
        ]);
        $membership_plan_name=$request->plan;
        $totalprice=$request->price;
        $membership_plan_id=$request->membership_plan_id;
        if(!Auth::user()->UserCurrentMemberShip=="") {
          $UserCurrentMemberShip= Auth::user()->UserCurrentMemberShip;
          $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $UserCurrentMemberShip->created_at);
          $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
          $UserCurrentMemberStatus = $to->diffInDays($from);
          if(365>$UserCurrentMemberStatus){
            if($UserCurrentMemberShip->membership_plan_id==$membership_plan_id) {
               alert()->info('error', 'You can not buy same plan again')->autoclose(2000);
                  return back();
            }
          }
        }
        $billplz = Client::make('289ad88c-ca09-42a3-a6e3-46ad93b96fe4');
        $billplz->useSandbox();
        $bill = $billplz->bill();
        $email=Auth::user()->email;
        $full_name=Auth::user()->full_name ? Auth::user()->full_name : 'Guest' ;
        $response = $bill->create(
          'lusclvw8',
          "$email",
           null,
          "$full_name",
          \Duit\MYR::given($totalprice*100),
          'https://lawwa.ezxdemo.com/admin',
          "$membership_plan_name",
          ['redirect_url' => url("membership/payment")]
        );
        $data=$response->toArray();
        $url=$data['url'];
        $order = MembershipUser::create([
          'user_name'      =>Auth::user()->full_name,
          'amount'         => $totalprice,
          'user_id'        => Auth::id(),
          'txn_id'         => $data['id'],
          'membership_plan_id'   =>$membership_plan_id,
          'membership_plan_name' => $membership_plan_name
      ]);
      
        if($response->getStatusCode() !== 200) {
          throw new SomethingHasGoneReallyBadException();
        }
        return redirect($url);
       return $request->input('plan');
        
    }
     
}
