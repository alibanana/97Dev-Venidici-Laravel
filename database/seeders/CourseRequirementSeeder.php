<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CourseRequirement;

class CourseRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requirements = [
            // Emotional Intelligence
            [
                'course_id' => 1,
                'requirement' => 'A Windows/Linux/MacOS based computer or laptop'
            ],
            [
                'course_id' => 1,
                'requirement' => 'A stable internet connection'
            ],
            [
                'course_id' => 1,
                'requirement' => 'High ambition for the future'
            ],
            // Path to Winning Business Competition
            [
                'course_id' => 2,
                'requirement' => 'PC atau laptop'
            ],
            [
                'course_id' => 2,
                'requirement' => 'Koneksi Internet'
            ],
            [
                'course_id' => 2,
                'requirement' => 'Rasa penasaran yang tinggi :)'
            ],
        ];

        foreach ($requirements as $key => $value) {
            CourseRequirement::create($value);
        }
    }
}
