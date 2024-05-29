<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{

  public function index()
  {
    $roles = Role::all();
    return view('roleAndPermission.index', compact('roles'));
  }

  public function create(Request $request)
  {
    $permissions = Permission::all();
    // $users = User::select('name', 'id')->get();
    return view('roleAndPermission.create', compact('permissions'));
  }

  public function store(Request $request)
  {
    // $role = Role::create(['name' => $request->input('name')]);

    $input = $request->all();
    $role = Role::create($input);
    foreach($request->input('permissions') as $permission) {
      $role->givePermissionTo($permission);
    }
    session()->flash('success', 'Added a new role!');
    return redirect('roleAndPermission');
  }

  public function destroy($id)
  {
    Role::destroy($id);
    session()->flash('success', 'Deleted successfully!');
    return redirect('roleAndPermission');
  }

  public function edit($id)
  {
    $role = Role::find($id);
    $permissions = Permission::all();
    return view('roleAndPermission.edit', compact('role', 'permissions'));
  }

  public function update(Request $request, $id)
  {
    $input = $request->all();
    $role = Role::find($id);
    $role->name = $input['name'];
    $role->syncPermissions($request->input('permissions'));
    $role->save();
    session()->flash('success', 'Role updated!');
    return redirect('roleAndPermission');
  }

  public function show($id)
  {
    $role = Role::find($id);
    return view('roleAndPermission.show')->with('role', $role);
  }

}
