<?php
namespace App\Http\Controllers;
use App\Page;
use Illuminate\Http\Request;
use App\Models\{Country,State,City};
class UniversalController extends Controller
{
public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }

  public function universalstatuschange(Request $request)
    {
      $id=$request->input('id');
      $model=$request->input('model'); 
      $nameSpaceapp = '\\App\\'; 
      $nameSpace = 'Models\\';
      $nameSpace=$nameSpaceapp.$nameSpace;
      $find_data = $nameSpace . $model; 
      $data=   $find_data::find($id); 
        if($data->status=='0')
           {
                  $status ='1';
          }
          else
            {
              $status ='0';
           }
        $data->status = $status ;
        $data->save();
        if($data)
        {
            return response()->json(['message' => 'Status update Successfully','status' => 'ok','currentstatus'=>$status]);
        } 
        else
        {
            return response()->json(['message' => 'Something is wrong','status' => 'error']);
        }
                   
    }

public function notificationsalstatuschange(Request $request)
    {
      $id=$request->input('id');
      $model=$request->input('model');
      $action=$request->input('action');
      $nameSpace = '\App\Models\\'; 
      $find_data = $nameSpace . $model; 

      if ($action=="clearall") 
      {
         $find_data::where('status','=','0')->update(['status' =>'1']);
         // $find_data::where('status','=','1')->update(['status' =>'0']);
         return response()->json(['message' =>'Clear Successfully','status' =>"clearall"]);

      }
       
    $notification=   $find_data::findorfail($id);
    $data = json_decode($notification->data,true);
 if($notification->type =='NewBeautician')
 	{
        $route=route('users.beauticianprofile',$data['id']);
  	}
    elseif($notification->type=='NewCutomer')
    {
        $route=route('users.show',$data['id']);
    }
    elseif($notification->type=='Membership')
    {
        $route=route('users.show',$notification->receiver_id);
    }
    elseif($notification->type=='Booking')
     {
        $route=route('bookings.show',$data['id']);
     }
    else
     {
    	$route= route('orders.show',$data['id']);
     }
               
    if($request->input('status')==0)
    {
       $status ='1';
    }
    else
    {
      $status ='0';
    }
    $notification->status = $status ;
    $notification->save();
    if($notification)
           {
            return response()->json(['message' => 'Remove successfully','status' => 'ok','route' =>$route]);
            
           } 
           else
           {
            return response()->json(['message' => 'Something is wrong','status' => 'error']);
           }
           
       }

public function universaldelete(Request $request)
    {
      $id=$request->input('id');
      $model=$request->input('model');
      $action=$request->input('action');
      $nameSpaceapp = '\\App\\'; 
      $nameSpace = 'Models\\';
      $nameSpace=$nameSpaceapp.$nameSpace;
      $find_data = $nameSpace . $model; 
      if ($action=="clearall") 
      {
         //$find_data::where('status','=','0')->update(['status' =>'1']);
         $find_data::where('status','=','1')->update(['status' =>'0']);
         return response()->json(['message' =>'Clear Successfully','status' =>"clearall"]);
      }
       
      $data=   $find_data::findorfail($id); 
      $data->delete(); 
      if($data)
       {
        return response()->json(['message' => 'Remove successfully','status' => 'ok']);
       } 
       else
       {
        return response()->json(['message' => 'Something is wrong','status' => 'error']);
       }                      	    
    }
}

