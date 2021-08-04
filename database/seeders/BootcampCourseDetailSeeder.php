<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BootcampCourseDetail;
use App\Models\BootcampDescription;

class BootcampCourseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $details = [
            [
                'course_id' => '5',
                'meeting_link' => 'zoom.com/5hqo34',
                'date_start' => '2021-07-29',
                'date_end' => '2021-08-20',
                'trial_date_end' => '2021-07-30',
                'what_will_be_taught' => 'Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.',
                'bootcamp_full_price' => '500000',
                'bootcamp_trial_price' => '250000',
            ]
        ];

        $abouts = [
            [
                'course_id' => '5',
                'title' => 'Poin penjelasan Growth Hacking',
                'image' => 'assets/images/seeder/Bootcamp-About-Seeder.png',
                'description' => 'Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​

                Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.'
            ],
            [
                'course_id' => '5',
                'title' => 'Bikin perusahaan jadi lebih kaya',
                'image' => 'assets/images/seeder/bootcamp-kedua.png',
                'description' => 'Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.
                
                Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​'
            ],
            [
                'title' => 'Poin penjelasan Growth Hacking',
                'image' => 'assets/images/seeder/homepage_background.png',
                'description' => 'Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​

                Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.'
            ],
            [
                'course_id' => '5',
                'title' => 'Poin penjelasan Growth Hacking',
                'image' => 'assets/images/seeder/Bootcamp-About-Seedera.png',
                'description' => 'Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.
                
                Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​'
            ],
        ];

        foreach ($details as $key => $value) {
            BootcampCourseDetail::create($value);
        }
        foreach ($abouts as $key => $value) {
            BootcampDescription::create($value);
        }
    }
}
