<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $titles = [
            'Free Bootcamp for Beginners',
            'Trust Works: Building Reliable Communities',
            'Education: Empowering Future Leaders',
            'Free Coding Bootcamp: Enroll Now',
            'Trust in Education: The Key to Success',
            'Bootcamp: Skills for the Modern Workforce',
            'Join Our Free Trust Works Bootcamp',
            'Educational Programs for Career Advancement',
            'Free Workshops for Personal Development',
            'Empowering Communities Through Education',
        ];
        // Generate a start date within the next three months
        $startDate = $this->faker->dateTimeBetween('now', '+3 months');
        
        // Generate an end date that is 3 days after the start date
        $endDate = (clone $startDate)->modify('+3 days');

        // Generate requirements as an array of associative arrays
        $requirementsArray = [];
        for ($i = 0; $i < 10; $i++) {
            $requirementsArray[] = [
                'requirement_name' => $this->faker->word, // Random word as requirement name
                'cost' => $this->faker->numberBetween(100, 10000), // Random cost
                'quantity' => $this->faker->numberBetween(1, 100), // Random quantity
            ];
        }

        return [
            'title' => $this->faker->randomElement($titles),
            'description' => $this->faker->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'image_path' => 'images/LkXJ5DOAkajDmfDpDJ7a1efIplCUwfFUJxCcj1NE.webp', // Default image path
            'view' => $this->faker->randomElement(['Event', 'gallery', 'event_and_gallery']),
            'location' => $this->faker->address(),
            'requirements' => json_encode($requirementsArray), // Encode array to JSON
            'event_status' => $this->faker->randomElement(['upcoming', 'finished']),
        ];
    }
}