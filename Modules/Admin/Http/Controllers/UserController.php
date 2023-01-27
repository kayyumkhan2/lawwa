<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Service,BeauticianService,User,Order,Booking,Notification,UserAddress,HealthCondition,MailTemplate};
use App\Models\{PaymentHistory,BeauticianWorkingTime,WorkHistory,BankDetail,CertificateUser,CourseUser,Wallet};
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Events\Registered;
use PDF;
use DB;
class UserController extends Controller{
function __construct() {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-show', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        
        $type=2;
        if($request->routeIs('users.admin.managers*'))
        {  
            $admin_managers = Role::whereNotIn('name', ['Customer','Admin','Beautician'])->get();
            $data = User::orderBy('id','DESC')->role( $admin_managers)->get();
            return view('admin::users.index', compact('data','type'));
        }
        $date =Carbon::today()->subDays(3);
        if ($request->routeIs('users.customers*'))
        {   $type=1;  
            $data = User::orderBy('id','DESC')->role('Customer')->get();
            return view('admin::users.index',compact('data','type'));
        }
        elseif ($request->routeIs('users.beauticians*')) {
            $type=0;  
            $data = User::orderBy('id','DESC')->role('Beautician')->get();
            return view('admin::users.index',compact('data','type'));
        }
        elseif ($request->routeIs('users.membershipcustomers*')) {
            $type=1;  
            $pagename= "Membership customers";
            $data = User::where('membership_plan_id', '!=', 0)->get();    
            return view('admin::users.membershipusers',compact('data','type','pagename'));
        }
        $data = User::orderBy('id','DESC')->get();
        return view('admin::users.index',compact('data','type'));
    }
    
    public function HealthConditionsFormDownload($id)
    {
        $user = HealthCondition::findorfail($id);
        return view('admin::users.health-condition-form',compact('user'));
    }
    public function create(Request $request)
    {
        $services = Service::orderBy('id','DESC')->get();
        $type=2;
     
        if ($request->routeIs('users.createbeautician*'))
         { 
         $type=0;   
         $roles = Role::where('name','Beautician')->pluck('name','name')->all();                       
        return view('admin::users.create',compact('type','services','roles'));
            }
        if ($request->routeIs('users.createcustomer*'))
         { 
         $type=1;
        $roles = Role::where('name','Customer')->pluck('name','name')->all();                                   
        return view('admin::users.create',compact('type','services','roles'));
            }
        $roles = Role::whereNotIn('name', ['Admin','Beautician','Customer'])->pluck('name','name')->all();
        return view('admin::users.create',compact('type','services','roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request,
         [
            'full_name' => 'required',
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_no' => 'required|numeric|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password|min:6',
            'type' => 'required|numeric|min:0',
            'Emergency_Number' => 'required|numeric',
            'id_proof' => 'required',
        ],
        [
            'profile_pic.max' => 'Please select the 3 Mb bellow file in profile pic!',
        ]);
        if (request('type')=='0') {
            $this->validate($request,
             [            
                // "services" => 'required|array|min:1',
                'certifiedstatus' => 'required',
                // "services.*"  => "required|string|distinct|min:1",
            ]);
        }
        $input = $request->all();
        $UserProfileInformation['Emergency_Number'] =$request->Emergency_Number;
         if ($request->hasfile("profile_pic")){
                $url= url('/');
                $imageName = time().'.'.$request->profile_pic->extension(); 
                $request->profile_pic->move(public_path('public/images/profilepics'), $imageName);
                $destinationPath = 'public/images/profilepics/';  
                $input['profile_pic'] =$imageName;
            } 
                $input["password"] = Hash::make($input["password"]);
                $user = User::create($input);
                $user->assignRole($request->input('roles'));
                
            if (request('type')=='0') {
                if ($request->hasfile("id_proof")){
                    $UserProfileInformation['Id_Proof']= uploadImg($request->id_proof,"beauticiansdocs");
                }
                $user->UserProfileInformation()->create($UserProfileInformation); 
                   $user->assignRole($request->input('roles'));
                if ($request->hasfile("doc")){
                    $BeauticianDocs['doc'] =uploadImg($request->doc,"beauticiansdocs");
                    $BeauticianDocs['name'] ="certificate";
                    $xyz = $user->BeauticianDocs()->create($BeauticianDocs);
                }
                if ($request->has("services")){
                    foreach(request('services') as $service_id) {
                        $BeauticianDocs['service_id'] =$service_id;
                        $user->BeauticianServices()->create($BeauticianDocs);    
                    }
                }
            }
            else
            {
                if ($request->hasfile("id_proof")){
                    $UserProfileInformation['Id_Proof']= uploadImg($request->id_proof,"customerphotos");
                }
                $user->UserProfileInformation()->create($UserProfileInformation); 
            }
        event(new Registered($user));      
        switch (request('type')) {
            case '1':
                alert()->Success('Success', 'Customers add Successfully')->autoclose(4000);
                return redirect()->route('users.customers');
                break;
            case '0':
               alert()->Success('Success', 'Beauticians add Successfully')->autoclose(4000);
                return redirect()->route('users.beauticians');
                break;
            case '2':
            alert()->Success('Success', 'Manager add Successfully')->autoclose(4000);
                return redirect()->route('users.admin.managers');
                break;
            default:
                alert()->Success('Success', 'User add successfully')->autoclose(4000);
                return redirect()->route('users.index');
                break;
        }                     
    }

    public function show(Request $request,$id)
    {
        $user               = User::findOrFail($id);
        $orders             = Order::orderBy('created_at', 'desc')->where('user_id',$id)->paginate(4, ['*'], 'orders');
        $bookings           = $user->UserBookings()->orderBy('created_at', 'desc')->paginate(4, ['*'], 'bookings');
        $notifications      = Notification::orderBy('created_at', 'desc')->where('receiver_id',$id)
                                ->orderBy('id', 'DESC')->groupBy('notification_id')->paginate(4, ['*'], 'notifications');
        $address            = UserAddress::orderBy('created_at', 'desc')->where('user_id',$id)->paginate(4, ['*'], 'address');
        $transactionhistory = PaymentHistory::orderBy('created_at', 'desc')->where('user_id',$id)->paginate(4, ['*'], 'transactionhistory');
        

        $totaladdresscount       = UserAddress::where('user_id',$id)->count();
        $totalorderscount        = Order::where('user_id',$id)->count();
        $notificationscount      = Notification::where('receiver_id',$id)->count();
        $transactionhistorycount = PaymentHistory::where('user_id',$id)->count();
        $bookingcount            = $user->UserBookings()->count();
        $data = array(
             'user'=>$user,
             'totalorderscount'=>$totalorderscount,
             'totaladdresscount'=>$totaladdresscount,
             'orders'=>$orders,
             'bookings'=>$bookings,
             'address'=>$address,
             'notifications'=>$notifications,
             'notificationscount'=>$notificationscount,
             'transactionhistory'=>$transactionhistory,
             'transactionhistorycount'=>$transactionhistorycount,
             'bookingcount'=>$bookingcount,
            );
        return view('admin::users.show')->with($data);
    }
    public function adminmanagerprofile($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->getRoleNames()->first();
        $id = $user->roles->first()->id;
        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('permission_for')->get()->groupBy(function($item) 
            {
            return $item->permission_for;
        });
 
         $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        return view('admin::users.adminmanagerprofile',compact('user','id','permissions','rolePermissions'));
    }
    public function beauticianprofile(Request $request,$id)
    {
        $user               = User::findOrFail($id);
        $workingtimes       = BeauticianWorkingTime::orderBy('created_at', 'desc')->where('user_id',$id)->get();
        $bookings           = $user->BookingAssign()->orderBy('created_at', 'desc')->paginate(4, ['*'], 'bookings');
        $notifications      = Notification::orderBy('created_at', 'desc')->where('receiver_id',$id)
                                ->orderBy('id', 'DESC')->groupBy('notification_id')->paginate(8, ['*'], 'notifications');
        $workhistory        = WorkHistory::orderBy('created_at', 'desc')->where('user_id',$id)->paginate(8, ['*'], 'workhistory');
        $bankdetails        = BankDetail::orderBy('created_at', 'desc')->where('user_id',$id)->paginate(4, ['*'], 'bankdetails');
        $transactionhistory = PaymentHistory::orderBy('created_at', 'desc')->where('user_id',$id)->paginate(8, ['*'], 'transactionhistory');
        
        $workhistorycount        = WorkHistory::where('user_id',$id)->count();
        $totalorderscount        = Order::where('user_id',$id)->count();
        $notificationscount      = Notification::where('receiver_id',$id)->count();
        $bankdetailscount        = BankDetail::where('user_id',$id)->count();
        $bookingcount            = $user->BookingAssign()->count();
        $transactionhistorycount = PaymentHistory::where('user_id',$id)->count();
        $certificatecount        = CertificateUser::where('user_id',$id)->count();
        $coursecount             = CourseUser::where('user_id',$id)->where('payment_status','SUCCESS')->count();
        $totalwallet             = Wallet::where('user_id',$id)->where('type','Credit')->sum('amount');
        $wallethistory           = Wallet::orderBy('created_at', 'desc')->where('user_id',$id)->paginate(8, ['*'], 'workhistory');
 
        $data = array(
             'user'=>$user,
             'workhistorycount'=>$workhistorycount,
             'workingtimes'=>$workingtimes,
             'bookings'=>$bookings,
             'workhistory'=>$workhistory,
             'notifications'=>$notifications,
             'notificationscount'=>$notificationscount,
             'bankdetails'=>$bankdetails,
             'bankdetailscount'=>$bankdetailscount,
             'transactionhistory'=>$transactionhistory,
             'transactionhistorycount'=>$transactionhistorycount,
             'bookingcount'=>$bookingcount,
             'certificatecount'=>$certificatecount,
             'coursecount'=>$coursecount,
             'totalwallet'=>$totalwallet,
             'wallethistory'=>$wallethistory,
        );
        return view('admin::users.beauticianprofile')->with($data);
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin::users.edit',compact('user','roles','userRole'));
    }
    public function changepasswordview($id)
    {
        $user = User::find($id);
        return view('admin::users.changepassword',compact('user','id'));
    }
    public function changepassword(Request $request,$id)
    {
        $validatedData = $request->validate([
           'password'=>'required|min:6|max:25',
           'Confirm_password' => 'required|same:password',
        ]);
        $current_password = request('current_password');
        $user = User::findorfail($id);
        $user->password =  Hash::make(request('password'));
        if($user->save()){
            toastr()->success('Password update Successfully!');
            return redirect()->route('users.index');
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
            'full_name' => 'required',
    		'phone_no' => 'required|unique:users,phone_no,'.$id,
    		'Address_Location' => 'required',
            'Emergency_Number' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            ]);
        $input = $request->all();
       
     if ($request->hasfile("profile_pic")){
            $url= url('/');
            $imageName = time().'.'.$request->profile_pic->extension(); 
            $request->profile_pic->move(public_path('public/images/profilepics'), $imageName);
            $destinationPath = 'public/images/profilepics/';  
            $input['profile_pic'] =$imageName;
        }
        $UserProfileInformation['Emergency_Number'] =$request->Emergency_Number;
        $user = User::find($id);
        $user->UserProfileInformation()->updateOrCreate($UserProfileInformation); 
        $user->update($input);
        alert()->Success('Success', 'Profile updated Successfully!')->autoclose(4000);
         if (!$user->roles->first()=='') {
            $role = $user->roles->first()->name;
              switch ($role) {
                case 'Customer':
                  return redirect()->route('users.customers');
                  break;
                case 'Beautician':
                  return redirect()->route('users.beauticians');
                  break; 
                default:
                  return redirect()->route('users.admin.managers');
                break;
             }
        }
    }
    public function destroy($id)
    {
        toastr()->success('User deleted Successfully!');
        User::find($id)->delete();
        return redirect()->route('users.index');
    }

}