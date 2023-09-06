<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class sampah_dataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->sentence(),
            'images'      => $this->faker->imageUrl(640,480),
            'url'         => $this->faker->text(),
            'description' => $this->faker->text(),
            'status'      => 1,
        ];
    }
}
