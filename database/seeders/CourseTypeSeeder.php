<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CourseType;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'type' => 'Course'
            ],
            [
                'type' => 'Woki'
            ],
            [
                'type' => 'Bootcamp'
            ]
        ];

        foreach ($types as $key => $value) {
            CourseType::create($value);
        }
    }
}
