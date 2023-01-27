<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\Wallet;
use Auth;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
     $pagename="Lawwa Wallet";
     $wallethistory = Wallet::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
     $totalwallet = Wallet::where('user_id',Auth::id())->where('type','Credit')->sum('amount');
     return view('beautician::wallet.index',compact('wallethistory','pagename','totalwallet'));
    }   
}
