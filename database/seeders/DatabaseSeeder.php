<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(20)->create();

        $this->call([
            UserRoleSeeder::class,
            UserSeeder::class,
            FakeTestimonySeeder::class,
            TrustedCompanySeeder::class,
            ConfigSeeder::class,
            CourseTypeSeeder::class,
            CourseCategorySeeder::class,
            HashtagSeeder::class,
            CourseSeeder::class,
            CourseRequirementSeeder::class,
            CourseFeatureSeeder::class, // Kamu akan dapat? section
            LocationSeeder::class
        ]);
    }
}
