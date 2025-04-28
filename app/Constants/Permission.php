<?php

namespace App\Constants;

class Permission
{
    // Admin permissions
    const ADMIN_PERMISSIONS = [
        'manage_roles',
        'manage_user',
        'prdections',
        // 'catergories',
        // 'catergories_crud',
        // 'enroll_amount',
        // 'enroll_amount_crud',
        // 'monthly_report',
        // 'events',
        // 'events_crud',
        // 'developer_control',
        // 'Anoucement'
    ];

    // User permissions
    const USER_PERMISSIONS = [
        'view_dashboard',
    ];
    
    // Method to get permissions based on role
    public static function getPermissions(string $role): array
    {
        return match ($role) {
            'admin' => self::ADMIN_PERMISSIONS,
            'user' => self::USER_PERMISSIONS,
            default => [],
        };
    }
}