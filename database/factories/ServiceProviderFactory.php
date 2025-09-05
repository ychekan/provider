<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceProviderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'short_description' => $this->faker->sentence(8),
        ];
    }
}
