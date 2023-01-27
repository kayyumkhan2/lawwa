<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Auth;
use Illuminate\Support\Str;
class NotificationController extends Controller
{
    
    public function index()
    {
	 $pagename="Notifications";
     $notifications = Notification::where('receiver_id',Auth::id())->orderBy('id', 'DESC')->groupBy('notification_id')->paginate(7);
     return view('beautician::notifications.index',compact('pagename'))->with('notifications',$notifications);
    
    }   
}
