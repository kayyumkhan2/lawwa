<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Models\BankDetail;
use App\Models\Bank;
use Illuminate\Http\Request;
use Auth;
use Exception;
class BankDetailController extends Controller
{
    
    public function index()
    {
        $BankDetails = BankDetail::where('user_id',Auth::id())->get();
        $Banks       = Bank::where('status','1')->get();
        return view('beautician::bankdetails.index',compact('BankDetails','Banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();
        $validator = $request->validate([
            'bank_name'              => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'account_name'           => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'account_number'         => 'required|not_regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'user_id'                => 'required',
            'account_number' => 'min:6|required_with:confirm_account_number|same:confirm_account_number',
            'confirm_account_number' => 'min:6'
        ]);
        $data = request()->all();
        try {
            BankDetail::firstOrCreate(['user_id' => Auth::id()],$data);      
            alert()->Success('Thank you', 'You Have Successfully Added Bank Detail')->autoclose(4000);
            return redirect()->back();     
        } 
        catch (Exception $e) {
            alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
        }
        
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function show(BankDetail $bankDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($bankDetail)
    {
        $BankDetail=  BankDetail::where('user_id',Auth::id())->findorfail($bankDetail);
        $BankDetails = BankDetail::where('user_id',Auth::id())->get();
        $Banks       = Bank::where('status','1')->get();
        return view('beautician::bankdetails.edit',compact('BankDetails','BankDetail','Banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bankDetail)
    {
        $request['user_id'] = Auth::id();
        $validator = $request->validate([
            'bank_name'              => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'account_name'           => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'account_number'         => 'required|not_regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'code'                   => 'required',
            'user_id'                => 'required',
            'account_number' => 'min:6|required_with:confirm_account_number|same:confirm_account_number',
            'confirm_account_number' => 'min:6'
        ]);
        $data = request()->all();
        try {
            BankDetail::where('user_id',Auth::id())->findorfail($bankDetail)->update($data);        
            alert()->Success('Thank you', 'You have successfully added bank detail')->autoclose(4000);
            return redirect()->route('beautician.bankdetail.index');     
        } catch (Exception $e) {
            alert()->error('error', 'Something is wrong with you please try after some time')->autoclose(2000);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankDetail $bankDetail)
    {
        //
    }
}
