<?php

namespace Database\Factories\Api;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $delivery_instructions = [
            'Leave at front door.',
            'Ring bell and wait.',
            'Text me when you arrive.',
            'Please deliver to the back porch.',
            'Place package in the shaded area.',
            'Do not ring the doorbell, baby is sleeping.'
        ];
        $delivery_modes = ['automated', 'manual', 'in-hand'];
        $subscription_types = ['daily', 'weekly', 'monthly'];
        $statuses = ['active', 'delivered', 'cancelled', 'processing'];
        $delivery_bell = ['yes', 'no'];
        $type = ['subscription', 'perpetual'];

        $order = [
            'user_id' => $this->faker->randomElement([1, 3]),
            'available_city_id' => $this->faker->numberBetween(1,5),
            'invoice_id' => $this->faker->numberBetween(0, 9),
            'product_id' => $this->faker->randomElement([1,2,3,4,5]),
            'quantity' => $this->faker->randomElement([1, 2]),
            'mrp' => $this->faker->randomFloat(2, 10, 1000),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'type' => $this->faker->randomElement($type),
            'subscription_plan_id' => $this->faker->numberBetween(10, 99),
            'subscription_type' => $this->faker->randomElement($subscription_types),
            'subscription_start' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'subscription_end' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'subscription_interval' => $this->faker->numberBetween(1,9),
            'delivery_remaining' => $this->faker->numberBetween(0,30),
            'delivery_total' => $this->faker->numberBetween(0,30),
            'status' => $this->faker->randomElement($statuses),
            'delivery_mode' => $this->faker->randomElement($delivery_modes),
            'delivery_bell' => $this->faker->randomElement($delivery_bell),
            'delivery_instruction' => $this->faker->randomElement($delivery_instructions),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];

        return $order;
    }
}
