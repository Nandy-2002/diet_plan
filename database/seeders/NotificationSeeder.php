<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        // Create 20 fake notification records using the Notification factory
        Notification::factory()->count(15)->create();
    }
}