<?php

namespace Modules\Admin\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
function __construct() {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-show', ['only' => ['show']]);
    }
    public function index()
    {
      // $permissions = Permission::pluck('id','id')->all();
      // Role::first()->syncPermissions($permissions);
      $roles = Role::orderBy('id','DESC')->get();
      return view('admin::Roles.index',compact('roles')); 
    }

    public function create()
    {
        $permissions = Permission::orderBy('permission_for')->get()->groupBy(function($item) {
            return $item->permission_for;
        });
        return view('admin::Roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
            [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $request->input('permission');
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('Roles.index')->with('success','Role created successfully');
    }
     
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")->where("role_has_permissions.role_id",$id)->get();
        return view('admin::Roles.show',compact('role','rolePermissions'));

    }
   
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('permission_for')->get()->groupBy(function($item) 
            {
            return $item->permission_for;
        });

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        return view('admin::Roles.edit',compact('role','permissions','rolePermissions'));
  
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
        ['name' => 'required']);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->back()->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        Role::findorfail($id)->delete();
        toastr()->success('Role deleted Successfully!');
        return redirect()->route('Roles.index');
    }
}
