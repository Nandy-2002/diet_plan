<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Permissions structure based on requirements
        
        // Viewer role with limited permissions
        Role::create([
            'permission_array' => json_encode([
                'view_dashboard',
                'prdections',
                'Anoucement'
            ]),
        ]);

        // Editor role with permissions for CRUD and gallery management
        Role::create([
            'permission_array' => json_encode([
                'view_dashboard',
                'prdections',
                'Anoucement'
            ]),
        ]);

        // Manager role with permissions for managing enrollments and reports
        Role::create([
            'permission_array' => json_encode([
                'view_dashboard',
                'prdections',
                'Anoucement'
            ]),
        ]);

        // Full Access role with all permissions
        Role::create([
            'permission_array' => json_encode([
                "manage_roles",
                "manage_user",
                'prdections',
                'Anoucement'
            ]),
        ]);
    }
}