<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'course_id' => '1',
                'title' => 'Materials',
            ],
            [
                'course_id' => '1',
                'title' => 'QnA Section',
            ],
            [
                'course_id' => '2',
                'title' => 'Materials',
            ]
        ];

        foreach ($sections as $key => $value) {
            Section::create($value);
        }
    }
}
