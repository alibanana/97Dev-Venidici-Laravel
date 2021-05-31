<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KrestProgram;
use Faker\Generator as Faker;

class KrestProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 4; $i++) { 
            KrestProgram::create([
                'program' => $faker->unique()->catchPhrase,
                'category' => $faker->unique()->word,
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus similique reprehenderit dolore quam recusandae? Minima aperiam tempora qui rerum, non nostrum itaque saepe sunt ea magni corporis modi, dolorem sint.',
            ]);
        }
    }
}
