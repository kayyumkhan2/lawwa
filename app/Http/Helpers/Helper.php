<?php
use Carbon\Carbon ;
use App\Models\{Setting,Notification,PaymentHistory};
function uploadImg($image, $foldername){
        try{
          if (!empty($image)) {
              $imageName = rand().'.'.$image->extension(); 
              $image->move(public_path('images/'.$foldername),$imageName);
             return $imageName;

          }
        }
        catch(Exception $e){
          throw $e;
        }
}
function GetNotifications(){
     return  $result1 = Notification::orderBy('id', 'DESC')->where('status','0')->whereIn('type',['Order','Booking','Membership','NewCutomer','NewBeautician'])->get();  
  }
function GetPaymentHistoryID($txn_id){
     return  $id = PaymentHistory::where('txn_id',$txn_id)->firstorfail()->id;  
  }
function Setting(){
  return  $result = Setting::first();
}
function MemberShipStatusCheck($user="",$membershipinfo="")
{
  if (!Auth::check() && !Request::is('login')) {
          return Redirect::route('login');
  }
  if (!$user=="" && $membershipinfo==""){ 
      if (!$user->UserCurrentMemberShip=="") {
        $UserCurrentMemberShip= $user->UserCurrentMemberShip;
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $UserCurrentMemberShip->created_at);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
        $UserCurrentMemberStatus = $to->diffInDays($from);
        if(365>$UserCurrentMemberStatus) {
          return true;
        }
        else
        {
          return false;
        }
      }
      else
      {
        return false;
      }
  }
  elseif($user=="")
  {
    if (!Auth::user()->UserCurrentMemberShip=="") {
      $UserCurrentMemberShip= Auth::user()->UserCurrentMemberShip;
      $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $UserCurrentMemberShip->created_at);
      $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
      $UserCurrentMemberStatus = $to->diffInDays($from);
      if(365>$UserCurrentMemberStatus) {
        return true;
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }
  elseif($user!="" && $membershipinfo=!"" ){
    if (!$user==""){ 
      if (!$user->UserCurrentMemberShip=="") {
        $UserCurrentMemberShip= $user->UserCurrentMemberShip;
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $UserCurrentMemberShip->created_at)->addYear();
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
        $fromdate = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $UserCurrentMemberShip->created_at);
        $UserCurrentMemberStatus = $to->diffInDays($from);
       return  $arrayName = array('to' =>$to ,'from'=>$fromdate ,'daysremaing'=>$UserCurrentMemberStatus);
      }
   }         
  }
}

         