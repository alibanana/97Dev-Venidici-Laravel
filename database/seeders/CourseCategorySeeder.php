<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CourseCategory;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category' => 'Tech',
                'image' => 'assets/images/seeder/category-tech.png'
            ],
            [
                'category' => 'Arts',
                'image' => 'assets/images/seeder/category-art.png'
            ],
            [
                'category' => 'Math',
                'image' => 'assets/images/seeder/category-math.png'
            ]
        ];

        foreach ($categories as $key => $value) {
            CourseCategory::create($value);
        }
    }
}
