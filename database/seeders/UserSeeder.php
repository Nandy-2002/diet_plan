<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Viewer user with limited permissions
        User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'password' => Hash::make('password'),
            'role_id' => '1', // Assuming 'Viewer' has role_id 1
            'phone' => '123-456-7890', // Add a phone number
            'address' => '123 Viewer St, City, Country', // Add an address
        ]);

        // Create Editor user with CRUD and announcement permissions
        User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('password123'),
            'role_id' => '2', // Assuming 'Editor' has role_id 2
            'phone' => '234-567-8901', // Add a phone number
            'address' => '456 Editor Ave, City, Country', // Add an address
        ]);

        // Create Manager user with enrollment and report permissions
        User::create([
            'name' => 'Manager User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role_id' => '3', // Assuming 'Manager' has role_id 3
            'phone' => '345-678-9012', // Add a phone number
            'address' => '789 Manager Blvd, City, Country', // Add an address
        ]);

        // Create Full Access user with all permissions
        User::create([
            'name' => 'Santhosh Developer',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => '4', // Assuming 'Full Access' has role_id 4
            'phone' => '456-789-0123', // Add a phone number
            'address' => '321 Admin Rd, City, Country',
            'user_role' => 'developer' // Add an address
        ]);
    }
}