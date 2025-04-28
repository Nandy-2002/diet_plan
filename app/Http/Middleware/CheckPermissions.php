<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Ensure the user is authenticated and has the required permission
        if (!$user instanceof User || !$this->hasPermission($user, $permission)) {
            return redirect('/'); // Redirect to the home page if no permission
        }

        return $next($request);
    }

    /**
     * Check if the user has the given permission.
     *
     * @param  \App\Models\User  $user
     * @param  string  $permission
     * @return bool
     */
    protected function hasPermission(User $user, $permission)
    {
        // Get the user's role
        $role = $user->role;

        // If the role exists, decode the permission array and check if the required permission is present
        if ($role) {
            $permissions = json_decode($role->permission_array, true);
            return is_array($permissions) && in_array($permission, $permissions);
        }

        return false;
    }
}