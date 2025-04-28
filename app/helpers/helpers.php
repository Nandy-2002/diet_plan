<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('hasPermission')) {
    /**
     * Check if the authenticated user has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    function hasPermission($permission)
    {
        $user = Auth::user();

        if ($user && $user->role) {
            $permissions = json_decode($user->role->permission_array, true);
            return is_array($permissions) && in_array($permission, $permissions);
        }

        return false;
    }
}