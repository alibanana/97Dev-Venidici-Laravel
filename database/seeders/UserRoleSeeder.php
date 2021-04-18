<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_name' => 'user',
            ],
            [
                'role_name' => 'admin',
            ],
            [
                'role_name' => 'super-admin',
            ]
        ];

        foreach($roles as $key => $value) {
            UserRole::create($value);
        }
    }
}
