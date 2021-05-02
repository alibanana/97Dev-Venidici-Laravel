<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CourseFeature;

class CourseFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            // Path to Winning Business Competition
            [
                'course_id' => 2,
                'feature' => 'Gambaran umum dari Business Plan',
            ],
            [
                'course_id' => 2,
                'feature' => 'Business Case dan Marketing Plan Competition',
            ],
            [
                'course_id' => 2,
                'feature' => 'Hal - hal yang perlu dipersiapkan sebelum mengikuti Business Competition',
            ],
            [
                'course_id' => 2,
                'feature' => 'Contoh makalah Business Plan.',
            ],
            [
                'course_id' => 2,
                'feature' => 'Latihan soal untuk Marketing Plan dan Business Case',
            ],
            [
                'course_id' => 2,
                'feature' => 'Langkah - langkah yang perlu diperhatikan sewaktu mengikuti Business Competition',
            ],
            [
                'course_id' => 2,
                'feature' => 'Masih banyak lagi :)',
            ],
        ];

        foreach ($features as $key => $value) {
            CourseFeature::create($value);
        }
    }
}
