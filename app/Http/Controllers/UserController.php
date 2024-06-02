<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
  public function register(Request $request)
  {
    if (auth()->check()) {
      return redirect('/home');
    }
    $incomingFields = $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => 'required|confirmed|min:8|max:200'
      // 'password_confirmation' => ['required', 'min:8', 'max: 200']
    ]);
    $incomingFields['password'] = bcrypt($incomingFields['password']);
    $user = User::create($incomingFields);
    if ($user->id == 1) {
      $user->assignRole('Admin');
    }else{
      $user->assignRole('Guest');
    }
    // auth()->login($user);
    session()->flash('message', 'You have been registered successfully!');
    return redirect('/login');
  }

  public function login(Request $request)
  {
    if (auth()->check()) {
      return redirect('/home');
    }
    $incomingFields = $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);
    if (auth()->attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])) {
      // session()->regenerate();
      return redirect('/home');
    }
    $email = $incomingFields['email']; // Extract email from validated fields
    // Check if email exists in database (assuming a User model)
    $user = User::where('email', $email)->first();
    // If no such email in the database, display invalid email msg
    if (is_null($user)) {
      $errors = ['email' => 'Invalid email address. Email not found.'];
      return back()->withErrors($errors);
    }
    // If email is correct but password is wrong
    return back()->withErrors([
      'password' => 'The provided credentials do not match our records.',
    ]);
  }

  public function logout(Request $request)
  {
    auth()->logout();
    return redirect('/');
  }

  public function index()
  {
    $users = User::all();
    return view('user.index', compact('users'));
  }

  public function create()
  {
    $roles = Role::pluck('name','id')->all();
    return view('user.create', compact('roles'));
  }

  public function store(Request $request)
  {
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $user->assignRole($request->input('Guest'));
    session()->flash('success', 'Added a new user!');
    return redirect('user');
  }

  public function destroy($id)
  {
    if ($id == 1) {
      return back()->withErrors(['error' => 'Cannot delete superadmin!']);
    }
    User::destroy($id);
    session()->flash('success', 'Deleted successfully!');
    return redirect('user');
  }

  public function edit($id)
  {
    if ($id == 1) {
      return back()->withErrors(['error' => 'Cannot edit superadmin!']);
    }
    $user = User::find($id);
    $roles = Role::all();
    return view('user.edit', compact('user', 'roles'));
  }

  public function update(Request $request, $id)
  {
    if ($id == 1) {
      return back()->withErrors(['error' => 'Cannot update superadmin!']);
    }
    $input = $request->all();
    $user = User::find($id);
    $user->update($input);
    $user->removeRole($user->getRoleNames()->first());
    $user->assignRole($request->input('role'));
    session()->flash('success', 'User updated!');
    return redirect('user');
  }

  public function show($id)
  {
    $user = User::find($id);
    return view('user.show')->with('user', $user);
  }
}
