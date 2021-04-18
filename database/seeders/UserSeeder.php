<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
    public function run()
    {
        $users = [
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

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
