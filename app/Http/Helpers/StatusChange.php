<?php
use App\Models\{Booking,Order,OrderCancelReason,BookingCancelReason,WorkHistory,BookingAssign};
use App\Models\{Wallet};
  
function StatusChange($status,$id,$type,$request="")
{
	if ($type=="Order")
		{ 
			try{
		        	$Order = Order::findorfail($id);
		        if ($Order->current_status =='CANCEL' || $Order->current_status =='PAYMENTFAILED'|| $Order->current_status =='PENDING' || $Order->current_status =='DELIVERED' || $Order->current_status=='REFUNDED' ) {
		        	if($request->ajax()){
						return response()->json(['message' => 'Something is wrong','status' => 'error']);
					}
					else{
					    alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
		         		return back(); 
					}
		        }
		        $status_change=$Order->OrderStatus()->create(['status'=>$status]);
				$current_status=Order::where("id","=",$id)->update(['current_status'=>$status]);
				$Order = Order::findorfail($id);
				if($status==true && $current_status==true ) 
				{
				 	if($status=="CANCEL"){
				 	  $OrderCancelReason=OrderCancelReason::create(['order_id'=>$id,'comment'=>$request->comment,'reason'=>$request->reason]);
					 	if($request->ajax()){
					 		Sendnotification('Order',$Order,$Order->user_id);
							return response()->json(['message' => "$type $status Successfully",'status' => 'ok','currentstatus'=>$request->status]);
						}
						else{
					 		Sendnotification('Order',$Order,$Order->user_id);
						    alert()->Success('Success', "$type $status Successfully")->autoclose(4000);
			                return redirect()->back();  
						} 
				 	}
				 	if($request->ajax()){
					 	Sendnotification('Order',$Order,$Order->user_id);
						return response()->json(['message' => "$type $status Successfully",'status' => 'ok','currentstatus'=>$request->status]);
					}
					else{
					 	Sendnotification('Order',$Order,$Order->user_id);
					    alert()->Success('Success', "$type $status Successfully")->autoclose(4000);
		                return redirect()->back();  
					}
				}
				else
				{
					if($request->ajax()){
						return response()->json(['message' => 'Something is wrong','status' => 'error']);
					}
					else{
					    alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
		         		return back(); 
					}
				}
		    } 
		    catch (Exception $e) {
		     	if($request->ajax()){
					return response()->json(['message' => 'Something is wrong','status' => 'error']);
				}
				else{
				    alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
	         		return back(); 
				}
		    }
	    }
	else
		{
		    try {
		    		$Booking = Booking::findorfail($id);
			    	if ($Booking->current_status=="PaymentFailed" || $Booking->current_status=="Pending" || $Booking->current_status=="Cancel" || $Booking->current_status=="Completed" || $Booking->current_status=="Refunded"){
			    	alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
		         	return back();
			    }
		        $status_change=$Booking->BookingStatus()->update(['status'=>$status]);
				$current_status=Booking::where("id","=",$id)->update(['current_status'=>$status]);
		    	$Booking = Booking::findorfail($id);
				if($current_status==true && $current_status==true ) {
					if($status=="Cancel"){
				 	  $BookingCancelReason=BookingCancelReason::create(['booking_id'=>$id,'comment'=>$request->comment,'reason'=>$request->reason]);
				 	  alert()->Success('Success', "$type Cancel Successfully")->autoclose(4000);
				 	foreach($Booking->BookingUsers as $user){
                       Sendnotification('Booking',$Booking,$user->id); 
                    }
                    if(!$Booking->BookingAssign->isEmpty()){
	                    foreach($Booking->BookingAssign as $Assign){
	                       Sendnotification('Booking',$Booking,$Assign->id); 
	                    }
               		}
		            return redirect()->back();  
				 	}
				 	if($status=="Completed"){
				 	  foreach ($Booking->BookingAssign as $key => $beautician) {
						$services      =  json_encode($Booking->ServiceDetails);
						$customer_info =  json_encode($Booking->BookingUsers);
						$booking_info  =  json_encode(Booking::findorfail($Booking->id));
						$percentage    =  Setting()->BeauticianCommission;
						$totalamount   =  $Booking->amount;
						$commission    =  ($percentage / 100) * $totalamount;
						$beauticiantotalassign = ($Booking->BookingAssign)->count();
						$beauticiancommission  = $commission/$beauticiantotalassign;
						Wallet::create(['user_id'=>$beautician->id,'amount'=>$beauticiancommission,'narration'=>"Commission For Booking : $Booking->id","type"=>'Credit']);
						BookingAssign::where('assign_user_id',$beautician->id)->where('booking_id',$Booking->id)->update(["commission"=>$beauticiancommission]);
						$WorkHistory=WorkHistory::create(['booking_id'=>$Booking->id,'user_id'=>$beautician->id,'services_amount'=>$Booking->amount,'services'=>"$services",'status'=>"Assigned" ,'customer_info'=>"$customer_info" ,'commission'=>$beauticiancommission,"booking_info"=>$booking_info]);
						CreateNotification("Commission",$WorkHistory,$beautician->id,"You have Got $beauticiancommission RM Commission For Booking : $Booking->id");
				 	  }
				 	}
				    foreach($Booking->BookingUsers as $user){
                       Sendnotification('Booking',$Booking,$user->id); 
                    }
                    if ($status=="Reached") {
                    	alert()->Success('Success', "PBTLA Reached Successfully")->autoclose(4000);	
                    }
                    elseif ($status=="OnTheWay") {
						alert()->Success('Success', "PBTLA On The Way Reach will be Soon ")->autoclose(4000);
                    }
                    else{
						alert()->Success('Success', "$type $status Successfully")->autoclose(4000);
                    }
		            return redirect()->back();    
				}
				else
				{
					alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
		         	return back();
				}
		     } catch (Exception $e) {
		     dd($e);
		     	 alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
		         return back();
		    }
	    }	 
}
