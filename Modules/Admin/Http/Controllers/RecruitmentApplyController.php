<?php

namespace Modules\Admin\Http\Controllers;
use Illuminate\Routing\Controller;

use App\Models\{RecruitmentApply};
use Illuminate\Http\Request;
use Mail;
class RecruitmentApplyController extends Controller
{
   function __construct() {
        $this->middleware('permission:recruitmentapplies-list|recruitmentapplies-create|recruitmentapplies-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:recruitmentapplies-list', ['only' => ['index']]);
        $this->middleware('permission:recruitmentapplies-show', ['only' => ['show']]);
    }
    public function index()
    {
        $applies = RecruitmentApply::all()->sortByDesc("id");
        return view('admin::recruitmentapplies.index')->with('applies', $applies);
    }
    public function show($id)
    {
       $apply = RecruitmentApply::find($id);
       return view('admin::recruitmentapplies.show',compact('apply'));
    }
}
