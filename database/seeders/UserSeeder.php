<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Full Access user with all permissions
        User::create([
            'name' => 'Nandhini',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => '4', // Assuming 'Full Access' has role_id 4
            'phone' => '456-789-0123', // Add a phone number
            'address' => '321 Admin Rd, City, Country',
            'user_role' => 'developer' // Add an address
        ]);
    }
}