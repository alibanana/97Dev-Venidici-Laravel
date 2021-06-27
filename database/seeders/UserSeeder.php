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
                'user_role_id' => 3,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => env('ADMIN_NAME'),
                'email' => env('ADMIN_EMAIL'),
                'email_verified_at' => now(),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'user_role_id' => 2,
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($admins as $key => $value) {
            User::create($value);
        }

        $genders = ['Male', 'Female'];

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
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);

            $user->save();
        }

        // // Create Default Normal User
        // $defaultNormalUser = User::create([
        //     'name' => env('NORMAL_USER_NAME'),
        //     'email' => env('NORMAL_USER_EMAIL'),
        //     'email_verified_at' => now(),
        //     'password' => bcrypt(env('NORMAL_USER_PASSWORD')),
        //     'remember_token' => Str::random(10)
        // ]);

        // // General userDetail data for defaultNormalUser.
        // $defaultNormalUser->userDetail()->create([
        //     'telephone' => $faker->e164PhoneNumber,
        //     'referral_code' => Str::random(6),
        //     'birthdate' => $faker->date($format = 'Y-m-d', $max = '-16 years'),
        //     'gender' => $genders[rand(0, count($genders) - 1)],
        //     'address' => $faker->address,
        //     'company' => $faker->company,
        //     'occupancy' => $faker->jobTitle
        // ]);

    }
}
