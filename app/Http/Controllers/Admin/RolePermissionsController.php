<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        // return Role::with('users')->where('name',"user")->first();
        $roles = Role::with('permissions')->get();
        return view('admin.role.list',compact('roles'));
    }

    public function create()
    {
        $allPermissions = Permission::all();
        return view('admin.role.create',compact('allPermissions'));
    }

    public function store(RolePermissionsRequest $request)
    {
        $role = Role::create(["name" => $request->name]);
        $role->givePermissionTo($request->permissions);
        return redirect(route('admin.role.index'))->with('success','Role created successfully...');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $allPermissions = Permission::all();
        $permissions = $role->permissions->pluck('name')->toArray();
        return view('admin.role.edit',compact('role','permissions','allPermissions'));
    }

    public function update(RolePermissionsRequest $request)
    {
        $role = Role::find($request->id);
        $role->permissions()->detach();
        $role->name = $request->name;
        $role->givePermissionTo($request->permissions);
        $is_save = $role->save();

        if ($is_save) {
            return redirect(route('admin.role.index'))->with('success','Role updated successfully...');
        } else {
            return back()->with('error','Opps, Something went wrong...');
        }
    }

    public function destroy(Request $request)
    {
        $role = Role::find($request->id);
        $user = $role->users->toArray();
        if($user == null)
        {
            $role->permissions()->detach();
            $role->delete();
            return response()->json('success');
        }
        else{
            return response()->json('error');
        }
    }


    public function createPermission(Request $request)
    {
        // http://127.0.0.1:8000/Admin/role/create_permission?name=your permission name
        Permission::create(['name' => $request->name]);
        // Artisan::call('optimize:clear');
        dd('created');
    }
}
