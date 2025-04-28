<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User; // Import the User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\LogService;

class RoleController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    public function showRoles()
    {
        $roles = Role::all();
        $users = User::whereNull('user_role')->get(); // Fetch users with their roles
        return view('admin.roles.index', compact('roles', 'users'));
    }

    // Method to update user permissions
    public function editUserRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'permission_array' => 'nullable|array', // Expect an array of permissions
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Convert the permission array to a JSON string and save it
        $user->role->permission_array = json_encode($request->permission_array);
        $user->role->save();

        $this->logService->logSuccess('User Premission Updated successfully: ' . $user->name);
        return redirect()->route('admin.roles')->with('success', 'User Role updated successfully.');
    }
}