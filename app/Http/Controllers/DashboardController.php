<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    // public function showUsers()
    // {
    //     $users = User::all(); // Fetch users without role relationship
    //     $roles = Role::all(); // Get all roles for dropdown in the view
    //     return view('admin.users', compact('users', 'roles'));
    // }

    // public function addUser(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:8|confirmed',
    //         'role' => 'required|exists:roles,id', // Validate that the role exists in the roles table
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // Attach the role to the user
    //     $user->roles()->attach($request->role);

    //     return redirect()->route('admin.users')->with('success', 'User added successfully.');
    // }

    // public function deleteUser(User $user)
    // {
    //     $user->delete();
    //     return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    // }

    // public function showRoles()
    // {
    //     $roles = Role::all();
    //     return view('admin.roles', compact('roles'));
    // }

    // public function addRole(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255|unique:roles,name',
    //     ]);

    //     Role::create([
    //         'name' => $request->name,
    //     ]);

    //     return redirect()->route('admin.roles')->with('success', 'Role added successfully.');
    // }
}