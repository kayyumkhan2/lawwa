<?php
namespace Modules\Customer\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;
use Illuminate\Support\Str;
class NotificationController extends Controller
{
   
    public function index()
    {
        $notifications = Notification::where('receiver_id',Auth::id())->orderBy('id', 'DESC')->groupBy('notification_id')->paginate(6);
        return view('customer::notifications.index')->with('notifications',$notifications);
    } 
}
