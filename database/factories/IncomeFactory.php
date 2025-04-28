<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Constants\PaymentConstants;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(), // Random name
            'payment_method' => $this->faker->randomElement(array_keys(PaymentConstants::INCOME_METHODS)), // Random income method from constants
            'entry_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'amount' => $this->faker->randomFloat(2, 100, 5000), // Random amount between 100 and 5000
            'description' => $this->faker->sentence(),
            'mobile_number' => $this->faker->numerify('##########'),
            'pan_number' => strtoupper($this->faker->bothify('?????#####')),
            'area' => $this->faker->city(),
            'income_category_id' => $this->faker->randomElement([1, 2, 3]), // Randomly pick one of the three category IDs
            'created_by_id' => 1, // Replace with a valid user ID if needed
        ];
    }
}