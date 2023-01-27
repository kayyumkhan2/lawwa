<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RealRashid\SweetAlert\Facades\Alert;
class CourseController extends Controller
{
   function __construct() {
      $this->middleware('permission:Courses-list',['only' => ['index']]);
   }
   public function index(Request $request)
    {

      $Courseuser = CourseUser::where('payment_status','SUCCESS')->get();
         if($request->has('id') ) {
            $txn_id= $request->query('id');
            $Courseuser = CourseUser::where('txn_id',$txn_id)->get();   
         }
          if($request->has('user-id') ) {
            $user_id= $request->query('user-id');
            $Courseuser = CourseUser::where('user_id',$user_id)->where('payment_status','SUCCESS')->get();   
        }
      return view('admin::courses.index',compact('Courseuser'));
    }
}
