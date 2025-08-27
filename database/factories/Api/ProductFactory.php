<?php

namespace Database\Factories\Api;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productName = [
            'Certified A2 Cow Milk',
            'Certified A2 Cow Milk',
            'Desi Gir Cow A2 Vedic Ghee',
            'Buttermilk',
            'Light Cream'
        ];
        $units = [
            '1000 ml refundable glass bottle',
            '500 ml refundable glass bottle',
            '250 ml refundable glass bottle',
        ];
        return [
            'name' => $this->faker->randomElement($productName),
            'description' => $this->faker->randomElement($productName),
            'unit' => $this->faker->randomElement($units),
            'mrp' => $this->faker->randomFloat(2, 10, 1000),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sort' => $this->faker->numberBetween(1,9),
        ];
    }
}
