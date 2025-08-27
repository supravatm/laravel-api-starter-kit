<?php

namespace Database\Factories\Api;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\OrderDelivery>
 */
class OrderDeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $delivery = [
            'order_id' =>$this->faker->numberBetween(1, 5),
            'user_id' =>$this->faker->numberBetween(1, 2),
            'date' =>$this->faker->date('Y-m-d'),
            'slot' =>$this->faker->randomElement(['Morning', 'Afternoon', 'Evening']),
            'status' =>$this->faker->randomElement(['Pending', 'In Transit', 'Delivered', 'Cancelled']),
            'bottle_collected' =>$this->faker->boolean(),
            'reason' =>$this->faker->optional()->sentence(3),
            'quantity' =>$this->faker->numberBetween(1, 10),
            'mode' =>$this->faker->randomElement(['Delivery', 'Pickup']),
            'bell' =>$this->faker->randomElement(['Ring Bell', 'Don\'t Ring Bell']),
            'instruction' =>$this->faker->optional()->text(100),
            'product_id' =>$this->faker->randomElement([1,2,3,4,5]),
            'price_id' =>$this->faker->numberBetween(1, 20),
            'invoice_id' =>$this->faker->unique()->numberBetween(1, 9),
            'address_id' =>$this->faker->numberBetween(1,10),
            'delivery_route_id' =>$this->faker->numberBetween(1, 10),
            'available_city_id' =>$this->faker->numberBetween(1, 5),
            'carrier_id' =>$this->faker->numberBetween(1, 9),
            'collected_at' =>$this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'action_at' =>$this->faker->dateTimeBetween('-1 week', 'now'),
            'comment' =>$this->faker->optional()->text(200),
            'cancel_reason' =>$this->faker->optional()->sentence(),
            'created_by' =>$this->faker->numberBetween(1, 10),
            'updated_by' =>$this->faker->optional()->numberBetween(1, 10),
            'cancelled_by' =>$this->faker->optional()->numberBetween(1, 10),
            'created_at' =>$this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' =>$this->faker->dateTimeBetween('-1 month', 'now'),
        ];

        return $delivery;
    }
}
