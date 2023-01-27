<?php
namespace Modules\Beautician\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\WorkHistory;
use Auth;

use Illuminate\Http\Request;

class WorkHistoryController extends Controller
{
    public function index()
    {
     $pagename="My Work history";
     $workhistory = WorkHistory::where('user_id',Auth::id())->orderBy('id', 'DESC')->paginate(5);
     return view('beautician::workhistory.index',compact('workhistory','pagename'));
    
    }   
}
