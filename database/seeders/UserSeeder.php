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

        $number_of_users = 80;

        for ($i = 0; $i < $number_of_users; $i++) {
            
            if ($i < $number_of_users / 2) {
                $status = "active";
            } else {
                $status = "suspended";
            }

            $timestamp = $faker
                ->dateTimeBetween($startDate = '-1 months', $endDate = 'now');

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'is_admin' => false,
                'status' => $status,
                'remember_token' => Str::random(10),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);

            $user->userDetail()->create([
                'telephone' => $faker->e164PhoneNumber,
                'referral_code' => Str::random(6),
                'birthdate' => $faker->date($format = 'Y-m-d', $max = '-16 years'),
                'gender' => $genders[rand(0, count($genders) - 1)],
                'address' => $faker->address,
                'company' => $faker->company,
                'occupancy' => $faker->jobTitle,
                'interest' => $interests[rand(0, count($interests) - 1)],
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);

            $user->save();
        }
    }
}
