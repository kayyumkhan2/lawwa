<?php
namespace Modules\Customer\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\{MembershipUser};
use Illuminate\Http\Request;
use Auth;
class MembershipUserController extends Controller
{
	public $pagename="Membership";
    public function index()
    {
	    $membership = MembershipUser::where('user_id',Auth::id())->latest()->first();
	    return view('customer::memberships.index',compact('membership'))->with('pagename',$this->pagename);;
    }
    public function show()
    {
        $UserCurrentMemberShip= Auth::user()->UserCurrentMemberShip;
        if ($UserCurrentMemberShip=="") {
            alert()->info('Oops', 'Memberships data not found')->autoclose(3000);
            return redirect()->route("customer.membership.index");
        }
        return view('customer::memberships.show',compact('UserCurrentMemberShip'))->with('pagename',$this->pagename);;
    }
}
