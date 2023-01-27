<?php
namespace Modules\Front\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Billplz\Client;
use Illuminate\Http\Client\Response;
use App\Models\{CourseUser};

use Auth;

class CourseController extends Controller
{
  public function store(Request $request)
    {
        $this->validate($request,[
           'price' => 'required',
           'course' => 'required',
        ]);
        $course_name=$request->course;
        $totalprice=$request->price;
        $course_id=$request->course_id;
        $billplz = Client::make('289ad88c-ca09-42a3-a6e3-46ad93b96fe4');
        $billplz->useSandbox();
        $bill = $billplz->bill();
        $email=Auth::user()->email;
        $full_name=Auth::user()->full_name ? Auth::user()->full_name : 'Guest' ;
        $response = $bill->create(
          'lusclvw8',
          "$email",
           null,
          "$full_name",
          \Duit\MYR::given($totalprice*100),
          'https://lawwa.ezxdemo.com/admin',
          "$course_name",
          ['redirect_url' => url("course/payment")]
        );
        $data=$response->toArray();
        $url=$data['url'];
        $order = CourseUser::create([
          'user_name'      =>Auth::user()->full_name,
          'amount'         => $totalprice,
          'user_id'        => Auth::id(),
          'txn_id'         => $data['id'],
          'course_id'   =>$course_id,
          'course_name' => $course_name
      ]);
      
        if($response->getStatusCode() !== 200) {
          throw new SomethingHasGoneReallyBadException();
        }
        return redirect($url);
       return $request->input('plan');
        
    }
     
}
