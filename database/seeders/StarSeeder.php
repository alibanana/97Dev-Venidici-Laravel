<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Star;

class StarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $stars = [
            // Unusable points
            [
                'user_id' => 3,
                'stars' => 10,
                'valid_after' => $faker->dateTimeBetween($startDate = '-7 months', $endDate = '-5 months')->format('Y-m-d')
            ],
            // Unusable points
            [
                'user_id' => 3,
                'stars' => 25,
                'valid_after' => $faker->dateTimeBetween($startDate = '-7 months', $endDate = '-5 months')->format('Y-m-d')
            ],
            // Usable points
            [
                'user_id' => 3,
                'stars' => 30,
                'valid_after' => $faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now')->format('Y-m-d')
            ],
        ];

        foreach ($stars as $key => $value) {
            Star::create($value);
        }
    }
}
