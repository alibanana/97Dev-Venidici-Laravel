<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Krest;

class KrestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $number_of_applicants = 10; $list_of_applicant_status = ['Pending', 'Contacted', 'Rejected'];

        for ($i = 0; $i < $number_of_applicants; $i++) {
            Krest::create([
                'krest_program_id' => rand(1, 4),
                'name' => $faker->name,
                'email' => $faker->email,
                'telephone' => $faker->e164PhoneNumber,
                'company' => $faker->company,
                'tahu_dari_mana' => $faker->unique()->word,
                'message' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus similique reprehenderit dolore quam recusandae? Minima aperiam tempora qui rerum, non nostrum itaque saepe sunt ea magni corporis modi, dolorem sint.',
                'status' => $list_of_applicant_status[rand(0, 2)]
            ]);
        }
    }
}
