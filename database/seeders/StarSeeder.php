<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

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
        // Unusable Points Added
        for ($i = 0; $i < 3; $i++) {
            $date = $faker->dateTimeBetween($startDate = '-10 months', $endDate = '-5 months')->format('Y-m-d');
            Star::create([
                'user_id' => 1,
                'stars' => rand(10, 50),
                'valid_until' => Carbon::createFromFormat('Y-m-d', $date)->addMonths(4),
                //'type' => 'Add',
                'created_at' => Carbon::createFromFormat('Y-m-d', $date)
            ]);
        }

        // Usable Points Added
        for ($i = 0; $i < 5; $i++) {
            $date = $faker->dateTimeBetween($startDate = '-4 months', $endDate = 'now')->format('Y-m-d');
            Star::create([
                'user_id' => 1,
                'stars' => rand(10, 50),
                'valid_until' => Carbon::createFromFormat('Y-m-d', $date)->addMonths(4),
                //'type' => 'Add',
                'created_at' => Carbon::createFromFormat('Y-m-d', $date)
            ]);
        }

        // Points Subtracted
        for ($i = 0; $i < 3; $i++) {
            $date = $faker->dateTimeBetween($startDate = '-10 months', $endDate = 'now')->format('Y-m-d');
            Star::create([
                'user_id' => 1,
                'stars' => rand(10, 50),
                //'type' => 'Subtract',
                'created_at' => Carbon::createFromFormat('Y-m-d', $date)
            ]);
        }
    }
}
