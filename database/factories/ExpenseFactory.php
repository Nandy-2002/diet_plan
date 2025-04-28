<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Constants\PaymentConstants;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(), // Random name
            'payment_method' => $this->faker->randomElement(array_keys(PaymentConstants::INCOME_METHODS)), // Random income method from constants
            'entry_date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'amount' => $this->faker->randomFloat(2, 50, 2000), // Random amount between 50 and 2000
            'description' => $this->faker->sentence(),
            'mobile_number' => $this->faker->numerify('##########'), // Random 10-digit number
            'pan_number' => strtoupper($this->faker->bothify('?????#####')), // Random PAN format
            'area' => $this->faker->city(),
            'expense_category_id' => $this->faker->numberBetween(1, 3), // Assume 3 categories exist
            'created_by_id' => 1, // Replace with a valid user ID if needed
        ];
    }
}