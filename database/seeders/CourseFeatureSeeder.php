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
            // Emotional Intelligence
            [
                'course_id' => 1,
                'feature' => 'Gambaran umum dari Emotional Intelligence',
            ],
            [
                'course_id' => 1,
                'feature' => 'Manage your own emotions',
            ],
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
            // WOKI Courses
            [
                'course_id' => 3,
                'feature' => 'Bisa membedakan bahan masakan dengan benar.',
            ],
            [
                'course_id' => 3,
                'feature' => 'Basic Skills untuk memasak.',
            ],
            [
                'course_id' => 4,
                'feature' => 'Basic skills water painting.',
            ],
            [
                'course_id' => 4,
                'feature' => 'Mixing colours with water paint.',
            ],
            // Bootcamp Courses
            // [
                // 'course_id' => 5,
                // 'feature' => 'Basic skills untuk public speaking',
            // ],
            // [
                // 'course_id' => 6,
                // 'feature' => 'Ini adalah skill yang akan didapatkan setelah anda join bootcamp ini.',
            // ],
        ];

        foreach ($features as $key => $value) {
            CourseFeature::create($value);
        }
    }
}
