<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\UserDetail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $admins = [
            [
                'name' => env('SUPER_ADMIN_NAME'),
                'email' => env('SUPER_ADMIN_EMAIL'),
                'email_verified_at' => now(),
                'password' => bcrypt(env('SUPER_ADMIN_PASSWORD')),
                'is_admin' => true,
                'user_role_id' => 3,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_EMAIL'),
                'email_verified_at' => now(),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'is_admin' => true,
                'user_role_id' => 2,
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($admins as $key => $value) {
            User::create($value);
        }

        $genders = ['Male', 'Female'];
        $interests = ['Photography', 'Technologies', 'Automotives', 'Martial Arts', 'Football'];

        for ($i = 0; $i < 20; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'is_admin' => false,
                'remember_token' => Str::random(10),
            ]);

            $user->detail()->create([
                'telephone' => $faker->e164PhoneNumber,
                'referral_code' => Str::random(6),
                'birthdate' => $faker->date($format = 'Y-m-d', $max = '-16 years'),
                'gender' => $genders[rand(0, count($genders) - 1)],
                'address' => $faker->address,
                'company' => $faker->company,
                'interest' => $interests[rand(0, count($interests) - 1)],
            ]);
        }
    }
}
