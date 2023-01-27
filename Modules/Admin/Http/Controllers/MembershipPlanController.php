<?php
namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\{MembershipPlan,MembershipFeature,Service};
use DB;
class MembershipPlanController extends Controller
{
    function __construct() {
        $this->middleware('permission:membershipplan-list|membershipplan-create|membershipplan-edit|membershipplan-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:membershipplan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:membershipplan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:membershipplan-delete', ['only' => ['destroy']]);
        $this->middleware('permission:membershipplan-list', ['only' => ['index']]);
        $this->middleware('permission:membershipplan-show', ['only' => ['show']]);
    }
    public $page="Membership";
    public function index()
    {
      $pagename="Membership";
      $memberships = MembershipPlan::orderBy('id','DESC')->get();
      return view('admin::memberships.index',compact('memberships','pagename')); 
    }

    public function create()
    {   
        $pagename="Membership";
        $features = MembershipFeature::orderBy('id')->get();
        $services = Service::orderBy('id')->get();
        return view('admin::memberships.create',compact('features','pagename','services'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
           'name' => 'required|unique:membership_plans,name',
           'price' => 'required',
        ]);
        $MembershipPlan = MembershipPlan::create(['name' => $request->input('name'),'price'=>$request->price]);

        $MembershipPlan->MembershipFeatures()->sync($request->features);
        $MembershipPlan->MemberShipServices()->sync($request->services);
        toastr()->success("$this->page create Successfully!");
        return redirect()->route('membershipplan.index')->with('success','Membership plan created successfully');
    }
     
    public function show($id)
    {        
        $pagename="Membership";
        $membershipplan = MembershipPlan::find($id);
        $services = Service::orderBy('id')->get();
        $membershipfeatures = DB::table("membership_has_features")->where("membership_has_features.membership_plan_id",$id)->pluck('membership_has_features.membership_feature_id','membership_has_features.membership_feature_id')->all();
        return view('admin::memberships.show',compact('membershipplan','membershipfeatures','pagename','services'));

    }
   
    public function edit($id)
    {   
        $pagename    = "Membership";
        $membership        = MembershipPlan::find($id);
        $features = MembershipFeature::orderBy('id')->get();
        $services = Service::orderBy('id')->get();
        $membershipfeatures = DB::table("membership_has_features")->where("membership_has_features.membership_plan_id",$id)->pluck('membership_has_features.membership_feature_id','membership_has_features.membership_feature_id')->all();
        return view('admin::memberships.edit',compact('membership','features','membershipfeatures','pagename','services'));
  
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
          'name' => 'required',
          'price' => 'required'
        ]);
        $MembershipPlan = MembershipPlan::find($id);
        $MembershipPlan->name = $request->input('name');
        $MembershipPlan->price = $request->input('price');
        $MembershipPlan->save();
        $MembershipPlan->MembershipFeatures()->sync($request->features);
        $MembershipPlan->MemberShipServices()->sync($request->services);
        // $role->MembershipFeatures()->detach();
        //$role->delete();
        toastr()->success("$this->page updated Successfully!");
        return redirect()->back()->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        MembershipPlan::findorfail($id)->delete();
        toastr()->success("$this->page delete Successfully!");
        return redirect()->back()->with('success','Role updated successfully');
    }
}
