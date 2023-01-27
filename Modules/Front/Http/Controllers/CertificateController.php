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
use App\Models\{CertificateUser};

use Auth;

class CertificateController extends Controller
{
  public function store(Request $request)
    {
        $this->validate($request,[
           'price' => 'required',
           'certificate' => 'required',
        ]);
        $certificate_name=$request->certificate;
        $totalprice=$request->price;
        $certificate_id=$request->certificate_id;
        $billplz = Client::make('289ad88c-ca09-42a3-a6e3-46ad93b96fe4');
        $billplz->useSandbox();
        $bill = $billplz->bill();
        $email=Auth::user()->email;
        $full_name=Auth::user()->full_name ? Auth::user()->full_name : 'Guest' ;
        CertificateUser::create([
          'user_name'      =>Auth::user()->full_name,
          'amount'         => $totalprice,
          'user_id'        => Auth::id(),
          'txn_id'         => rand(),
          'certificate_id'   =>$certificate_id,
          'certificate_name' => $certificate_name
      ]);
      alert()->success('Successfull', 'You have successfully apply for certificate')->autoclose(3000);
      return redirect()->back();   
    }
}
