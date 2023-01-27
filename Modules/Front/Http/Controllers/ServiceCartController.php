<?php

namespace Modules\Front\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\{Service,ServiceCart};
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use App\Models\{Booking,BookingService,User,BookingUser,WorkingTime,UserFreeService};
use Auth;
use Alert;
use Toastr;
use Carbon\Carbon;
use Carbon\Carbon as Time;
class ServiceCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addservicecarttocart(Request $request,$service_id)
    {

        try
        { 
           $Service =  Service::findorfail($service_id);
           $ServiceCart= ServiceCart::where('service_id' , $service_id)->where('user_id' , Auth::user()->id)->first();
        } 
        catch(ModelNotFoundException $e) 
        {
           return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
        }
        if($Service!="" && $ServiceCart=="")
        {      $type="Buy"; 
            if (UserFreeService::where('user_id',Auth::id())->where('service_id' , $service_id)->first()) {
                    $type="Free";
                } 
            ServiceCart::create(['service_id' => $service_id, 'user_id' => Auth::user()->id,'type'=>$type]);
            toastr()->success('Service added successfully to service list!');
            return redirect()->route('services', ['id' => $request->query('id')]);
        } 
        else
        {
          toastr()->success('Service already exists in service list!');
            return redirect()->route('services', ['id' => $request->query('id')]);
        }
    }
    
    public function removeservicecarttocart($service_id)
    {
        try
        { 
           $ServiceCart= ServiceCart::where('service_id' , $service_id)->where('user_id' , Auth::user()->id)->first();
        } 
        catch(ModelNotFoundException $e) 
        {
           return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404); 
        }
        if($ServiceCart->delete())
        {
           alert()->Success('success', 'Service Removed successfully')->autoclose(2000);
           return redirect()->back();
        }
    }
    public function emptycart()
    {
        try
           { 
            $ServiceCart= ServiceCart::where('user_id' , Auth::user()->id)->first();
        } 
        catch(ModelNotFoundException $e)
            {
                return response()->json(["message"=>"error","code"=> "404",'error'=>"something went ot wrong",'data' => new \stdClass()], 404);
        }
        if(!$ServiceCart=="")
          {
            $Cart=ServiceCart::where('user_id' , Auth::user()->id)->delete();
            if($Cart)
            {
                alert()->Success('success', 'Services Removed successfully')->autoclose(2000);
                return redirect()->back();
            }
            else
            {
              return redirect()->back();
            }
        }        
    }
}
