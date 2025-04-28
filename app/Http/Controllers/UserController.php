<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Constants\Permission;
use App\Services\LogService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function showUsers()
    {
        // Fetch users where role_user is null
        $users = User::whereNull('user_role')->get(); // Eager load the role if necessary
        $roles = Role::all(); // Fetch all roles

        return view('admin.users.index', compact('users', 'roles')); // Pass both users and roles to the view
    }

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|digits:10',
            'address' => 'nullable|string|max:500',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        if ($validator->fails()) {
            $this->logService->logError('Failed to add user: ' . $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the permissions based on the selected role
        $permissions = Permission::getPermissions($request->role);

        // Create the role with permissions
        $role = Role::create([
            'permission_array' => json_encode($permissions),
        ]);

        // Create the user and assign the role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ]);

        $this->logService->logSuccess('User added successfully: ' . $user->name . ' - Role: ' . $request->role);
        return redirect()->route('admin.users')->with('success', 'User added successfully.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function editUser(User $user)
    {
        // Fetch all roles for the edit form
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateuser(Request $request, User $user)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|digits:10',
            'address' => 'nullable|string|max:255',
            'role' => 'nullable|string|in:0,1', // Role can be either '1' for Admin or '0' for User
        ]);

        if ($validator->fails()) {
            $this->logService->logError('Failed to update user: ' . $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; // Update phone number
        $user->address = $request->address; // Update address

        // Update password only if it's provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Check and update role if provided
        $roleInput = $request->role;
        if ($roleInput !== null) {
            if ($roleInput == '1') {
                $permissions = Permission::getPermissions('admin'); // Admin role
            } elseif ($roleInput == '0') {
                $permissions = Permission::getPermissions('user'); // User role
            }

            // Update the user's role_id
            $user->role_id = ($roleInput == '1') ? 1 : 2; // Assuming 1 is Admin, 2 is User

            // Update permissions dynamically for the user's current role
            if ($user->role_id) {
                $role = Role::find($user->role_id);

                if ($role) {
                    $role->permission_array = json_encode($permissions);
                    $role->save();
                }
            }
        }

        // Save user data
        $user->save();

        $this->logService->logSuccess('User updated successfully: ' . $user->name . ' - Role: ' . $request->role);
        
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user && $user->trashed()) {
            $user->restore();
            return redirect()->back()->with('success', 'User restored successfully.');
        }
        return redirect()->back()->with('error', 'User not found or not deleted.');
    }

    public function forceDeleteUser($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user && $user->trashed()) {
            $user->forceDelete();
            return redirect()->back()->with('success', 'User deleted permanently.');
        }
        return redirect()->back()->with('error', 'User not found or not deleted.');
    }   

}