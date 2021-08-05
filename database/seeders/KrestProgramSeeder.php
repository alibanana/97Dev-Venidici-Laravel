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

        $programs = [
            [
                'program' => 'Effective Conflict Management with Negotiation Skills',
            ],
            [
                'program' => 'Complex Problem Solving Essentials',
            ],
            [
                'program' => 'Be More Effective with Leadership & Social Influencing Skills',
            ],
            [
                'program' => 'Creative Thinking Skills',
            ],
            [
                'program' => 'Persuasive Communication & Public Speaking',
            ],
            [
                'program' => 'Resiliency & Stress Management',
            ],
            [
                'program' => 'Managing People & Team',
            ],
            [
                'program' => 'Teamwork',
            ],
            [
                'program' => 'Objective and Key Result (OKR)',
            ],
            [
                'program' => 'Effective Time Management',
            ]
        ];

        foreach ($programs as $key => $value) {
            KrestProgram::create($value);

        }
        //for ($i = 0; $i < 4; $i++) { 
            //KrestProgram::create([
                //'program' => $faker->unique()->catchPhrase,
                //'category' => $faker->unique()->word,
                //'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus similique reprehenderit dolore quam recusandae? Minima aperiam tempora qui rerum, non nostrum itaque saepe sunt ea magni corporis modi, dolorem sint.',
            //]);
        //}
    }
}
