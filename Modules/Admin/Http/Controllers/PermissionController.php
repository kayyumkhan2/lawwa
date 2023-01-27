<?php

namespace Modules\Admin\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->is('admin/subscriptionplan/*')) {
            $permissions = Permission::where('type','1')->orderBy('permission_for')->get()->groupBy(function($data) {
                return $data->permission_for;
            });
        }
        $permissions = Permission::orderBy('permission_for')->get()->groupBy(function($data) {
                return $data->permission_for;
            });

      return view('admin::Roles.Permissions.index',compact('permissions')); 
    }

    
    public function create()
    {
        return view('admin::Roles.Permissions.create');

    }

    
    public function store(Request $request)
    {
         $this->validate($request, 
                [
                'name' => 'required|unique:permissions,name',
            ]);
        $permission = Permission::create(['name' => $request->input('name'),'type'=>'1','permission_for'=>"Subscription"]);
        return redirect()->route('Permissions.index')->with('success','Permissions created successfully');
        //For Role mangemnet    
        // $permission = Permission::create(['name' => $request->input('name')]);
        // return redirect()->route('Permissions.index')->with('success','Role created successfully');
    }

    
    public function show($id)
    {
       $Permission = Permission::find($id);
       return view('admin::Roles.Permissions.show',compact('Permission'));

    }

    
    public function edit($id)
    {
        $Permission = Permission::find($id);
        return view('admin::Roles.Permissions.edit',compact('Permission'));

    }

    
    public function update(Request $request, $id)
    {  

        $this->validate($request, 
            [
             'name'  =>  'required|max:100|unique:permissions,name,'.$id, 
            ]);

         $Permission = Permission::find($id);        
         $Permission->update(['name' => $request->input('name')]);

    return redirect()->route('Permissions.index')->with('success','Permission updated successfully');
    }

   
    public function destroy($id)
    {
        Permission::findorfail($id)->delete();
        toastr()->success('Permission deleted Successfully!');
        return redirect()->route('Permissions.index');
    }
}
