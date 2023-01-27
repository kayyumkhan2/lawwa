<?php
namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;
use Illuminate\Support\Str;
use App\Notifications\LawwaMail;

class NotificationController extends Controller
{
    function __construct() {
        $this->middleware('permission:Notifications-list|Notifications-create|Notifications-edit|Notifications-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Notifications-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Notifications-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Notifications-delete', ['only' => ['destroy']]);
        $this->middleware('permission:Notifications-list', ['only' => ['index']]);
        $this->middleware('permission:Notifications-show', ['only' => ['show']]);
    }
    public function index()
    {
        $notifications = Notification::where('type',"Notify")->orderBy('id', 'DESC')->groupBy('notification_id')->get();
        Notification::where('status','=','0')->update(['status' =>'1']);
        return view('admin::notifications.index')->with('notifications',$notifications);
    }   
    public function create(Request $request)
    {
        // $roles = Role::whereNotIn('name', ['Admin',Auth::user()->getRoleNames()->first(),'Beautician','Customer'])->get();
        $roles = Role::whereNotIn('name', ['Admin',Auth::user()->getRoleNames()->first()])->get();
           $users = User::orderBy('id','DESC')->role($roles)->get();
        if ($request->routeIs('notifications.send.beauticians*'))
            {
              $type=0;  
              $roles = Role::whereIn('name', ['Beautician'])->get();
              $users = User::orderBy('id','DESC')->role('Beautician')->get();
              return view('admin::notifications.create',compact('users','roles','type'));
            }
        if ($request->routeIs('notifications.send.customers*'))
            { 
              $type=1;
              $roles = Role::whereIn('name', ['Customer'])->get();
              $users = User::orderBy('id','DESC')->role('Customer')->get();
              return view('admin::notifications.create',compact('users','roles','type'));
            }
             $type=2;
        return view('admin::notifications.create',compact('users','roles','type'));
    }
    public function SendMail($user,$Notification)
    { 
       $to = User::findorfail($user); 
       $to->notify(new LawwaMail($Notification));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'title' =>'required|max:100',
          'description' => 'required',
          'receiver_id' => 'nullable',
          "users"    => "required|array|min:1",
          'users.*'  => "required|string|distinct|min:1",
        ],
        [
            'users.required' => 'Please select which one you want to send notification!',
        ]);
        $notification_id = Str::random(9);
        foreach(request('users') as $user) {
           $Notification= Notification::create([
            'receiver_id' => $user,
            'notification_id' => $notification_id,
            'type' =>'Notify',
            'sender_id' => Auth::user()->id,
            'description' => $request->input('description'),
            'title' => $request->input('title'),
           ]);
           if($request->hasfile("attachment")){
                $attachments['attachment']= uploadImg($request->attachment,"notificationattachments");
                $Notification->NotificationAttachments()->create($attachments);
            }
            $this->SendMail($user,$Notification);
        }
        toastr()->success('Notification Send Successfully!');
        return redirect()->route('notifications.index');
    }

    public function show($id)
    {
        $Notification = Notification::find($id);
        return view('admin::notifications.show',compact('Notification'));
    }
    public function edit($notification_id)
    {
        $Notification=Notification::where('notification_id',"$notification_id")->first();    
        return view('admin::notifications.edit',compact('Notification'));
    }
    public function update(Request $request, $notification_id)
    {
        $validatedData = $request->validate([
              'title' =>'required|max:100',
              'description' => 'required',
            ]);
        $Notifications=Notification::where('notification_id',"$notification_id")->get(); 
        foreach ($Notifications as $key => $value) {
            $data = Notification::find($value->id);
            $data->title = $request->input('title');
            $data->description = $request->input('description');
            $data->save();
        }
        toastr()->success('Notification update successfully!');
        return redirect()->route('notifications.index');
    }
    public function destroy($notification_id)
    {
        $Notifications=Notification::where('notification_id',"$notification_id")->delete();    
        toastr()->success('Notification deleted successfully!');
        return redirect()->route('notifications.index');
    }
}
