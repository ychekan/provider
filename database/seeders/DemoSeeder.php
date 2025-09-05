<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ServiceProvider;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $categories = Category::factory()->count(10)->create();

        foreach (range(1, 10) as $index) {
            foreach (range(1, 20) as $_index) {
                $provider = ServiceProvider::factory()->create();
                $provider->logo()->create([
                    'path' => (int)$faker->numberBetween(1, 3) . '.png',
                    'collection' => 'logo',
                    'original_name' => $faker->word() . '.png',
                    'mime_type' => $faker->mimeType('image/png'),
                    'size' => $faker->numberBetween(1000, 5000),
                ]);
                $provider->categories()->attach($categories->random()->id);
            }
        }
    }
}
