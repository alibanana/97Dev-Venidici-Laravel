<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'name' => 'Teacher Example',
                'description' => 'This teacher is just an example, please ignore him.',
                'image' => 'assets/images/seeder/teacher-example.jpg'
            ],
            [
                'name' => 'Alifio Rasyid',
                'description' => 'Alifio is currently in his 6th semester in Binus International University. While studying, he is also freelancing as a Web Developer together with his friends.',
                'image' => 'assets/images/seeder/teacher-alifio.jpg'
            ],
            [
                'name' => 'Fernandha Dzaky',
                'description' => 'Dzaky is currently in his 6th semester in Binus International University. While studying, he is also freelancing as a Web Developer together with his friends.',
                'image' => 'assets/images/seeder/teacher-dzaky.jpg'
            ],
            [
                'name' => 'Welby Nazhari',
                'description' => 'Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​',
                'image' => 'assets/images/seeder/Teacher_Bootcamp.png',
                'company_logo' => 'assets/images/seeder/Teacher_Company_Logo.png',
                'occupancy' => 'Growth Marketer'
            ],
        ];

        foreach ($teachers as $key => $value) {
            Teacher::create($value);
        }
    }
}
