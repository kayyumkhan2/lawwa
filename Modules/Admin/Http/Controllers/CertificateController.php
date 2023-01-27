<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use App\Models\CertificateUser;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RealRashid\SweetAlert\Facades\Alert;

class CertificateController extends Controller
{
    function __construct() {
      $this->middleware('permission:Certificates-list',['only' => ['index']]);
      $this->middleware('permission:Certificates-update-change',['only' => ['updatestatus']]);
    }
    public function index(Request $request)
    {   
        $certificates = CertificateUser::orderBy('id', 'DESC')->get();
        if($request->has('id') ) {
            $txn_id= $request->query('id');
            $certificates = CertificateUser::where('txn_id',$txn_id)->get();   
        }
        if($request->has('user-id') ) {
            $user_id= $request->query('user-id');
            $certificates = CertificateUser::where('user_id',$user_id)->get();   
        }
        return view('admin::certificates.index',compact('certificates'));
    }
    public function updatestatus(Request $request)
    {
        $certificate = CertificateUser::findOrFail($request->id);
        alert()->Success('Success', 'status update successfully')->autoclose(4000);
        CertificateUser::where('id',$request->id)->update(['status'=>$request->status]);
        return response()->json(['message' => "Status updated Successfully",'status' => 'ok','currentstatus'=>$request->status]);     
    }
   
}
