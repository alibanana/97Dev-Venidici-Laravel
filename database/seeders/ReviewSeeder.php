<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            [
                'user_id' => 1,
                'course_id' => 1,
                'review' => 5,
                'description' => 'Course ini bagus, sangat informatif!'
            ],
            [
                'user_id' => 1,
                'course_id' => 1,
                'review' => 2,
                'description' => 'Coursenya kurang lengkap nih'
            ],
            [
                'user_id' => 1,
                'course_id' => 2,
                'review' => 5,
                'description' => 'Course ini bagus, sangat informatif!'
            ],
            [
                'user_id' => 1,
                'course_id' => 2,
                'review' => 2,
                'description' => 'Coursenya kurang lengkap nih'
            ],
        ];

        foreach ($promotions as $key => $value) {
            Review::create($value);
        }
    }
}
