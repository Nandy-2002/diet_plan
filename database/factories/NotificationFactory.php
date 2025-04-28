<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        // Define an array of custom messages
        $messages = [
            'User permanently deleted successfully.',
            'Website user maintenance on Friday.',
            'Event has been successfully added on the date this November on 12th. Make sure everyone can participate.',
            'New user registration completed.',
            'Password reset request has been received.',
            'Monthly report has been generated.',
        ];

        // Specify the user IDs to choose from
        $userIds = [3, 4];

        return [
            'user_id' => $this->faker->randomElement($userIds), // Randomly select 3 or 4
            'message' => $this->faker->randomElement($messages), // Randomly select a message from the array
            'is_read' => $this->faker->boolean(), // Randomly set as read or unread
        ];
    }
}