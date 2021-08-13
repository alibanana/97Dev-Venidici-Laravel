<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BootcampCourseDetail;
use App\Models\BootcampDescription;
use App\Models\BootcampSchedule;
use App\Models\BootcampScheduleDetail;
use App\Models\BootcampBenefit;
use App\Models\BootcampCandidate;
use App\Models\BootcampFutureCareer;
use App\Models\BootcampHiringPartner;
use App\Models\BootcampBatch;

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
                'date_start' => '2021-08-15',
                'date_end' => '2021-08-20',
                'trial_date_end' => '2021-08-19',
                'what_will_be_taught' => 'Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.',
                'bootcamp_full_price' => '300000',
                'bootcamp_trial_price' => '150000',
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
                'image' => 'assets/images/seeder/bootcamp-kedua.jpg',
                'description' => 'Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.
                
                Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​'
            ],
            [
                'course_id' => '5',
                'title' => 'Poin penjelasan Growth Hacking',
                'image' => 'assets/images/seeder/homepage_background.png',
                'description' => 'Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​

                Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.'
            ],
            [
                'course_id' => '5',
                'title' => 'Poin penjelasan Growth Hacking',
                'image' => 'assets/images/seeder/Bootcamp-About-Seeder.png',
                'description' => 'Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.
                
                Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​'
            ],
        ];

        $schedules = [
            [
                'course_id' => '5',
                'date_start' => '2021-08-06',
                'date_end' => '2021-08-13',
                'title' => 'Week 1',
                'subtitle' => 'Growth Fundamentals',
            ],
            [
                'course_id' => '5',
                'date_start' => '2021-08-13',
                'date_end' => '2021-08-20',
                'title' => 'Week 2',
                'subtitle' => 'Growth Fundamentals Week 2',
            ],
        ];
        
        $schedule_details = [
            [
                'bootcamp_schedule_id' => '1',
                'description' => 'Pirate funneling'
            ],
            [
                'bootcamp_schedule_id' => '1',
                'description' => 'Growth hacking mindset & skills'
            ],
            [
                'bootcamp_schedule_id' => '1',
                'description' => 'Growth hacking vs Digital Marketing and others'
            ],
            [
                'bootcamp_schedule_id' => '1',
                'description' => 'A career in growth hacking '
            ],
            [
                'bootcamp_schedule_id' => '2',
                'description' => 'Growth hacking mindset & skills'
            ],
            [
                'bootcamp_schedule_id' => '2',
                
                'description' => 'Pirate funneling'
            ],
            [
                'bootcamp_schedule_id' => '2',
                'description' => 'A career in growth hacking'
            ],
            [
                'bootcamp_schedule_id' => '2',
                'description' => 'Growth hacking vs Digital Marketing and others'
            ],
        ];

        $benefits = [
            [
                'course_id' => '5',
                'title' => 'Materi yang padat dan jelas',
                'description' => 'This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.',
            ],
            [
                'course_id' => '5',
                'title' => 'Fitur Assesment untuk pemantapan materi',
                'description' => 'This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.',
            ],
            [
                'course_id' => '5',
                'title' => 'Materi yang padat dan jelas',
                'description' => 'This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.',
            ],
            [
                'course_id' => '5',
                'title' => 'Fitur Assesment untuk pemantapan materi',
                'description' => 'This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.',
            ],
        ];

        $candidates = [
            [
                'course_id' => '5',
                'title' => 'Product Managers',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ],
            [
                'course_id' => '5',
                'title' => 'Mobile Developers',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ],
            [
                'course_id' => '5',
                'title' => 'UI Designers',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ],
            [
                'course_id' => '5',
                'title' => 'UX Researches',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ],
        ];

        $future_careers = [
            [
                'course_id' => '5',
                'thumbnail' => 'assets/images/seeder/Career_Seeder_1.png',
                'title' => 'Product Manager',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla ',
            ],
            [
                'course_id' => '5',
                'thumbnail' => 'assets/images/seeder/Career_Seeder_2.png',
                'title' => 'Accountant',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla ',
            ],
            [
                'course_id' => '5',
                'thumbnail' => 'assets/images/seeder/Career_Seeder_1.png',
                'title' => 'Product Manager',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla ',
            ],
        ];

        $hiring_partners= [
            [
                'course_id' => '5',
                'image' => 'assets/images/seeder/Bootcamp_Hiring_Partner_1.png',
            ],
            [
                'course_id' => '5',
                'image' => 'assets/images/seeder/Group 1109.png',
            ],
            [
                'course_id' => '5',
                'image' => 'assets/images/seeder/Group 1110.png',
            ],
            [
                'course_id' => '5',
                'image' => 'assets/images/seeder/Group 1115.png',
            ],
            [
                'course_id' => '5',
                'image' => 'assets/images/seeder/Group 1111.png',
            ],
            [
                'course_id' => '5',
                'image' => 'assets/images/seeder/Group 1113.png',
            ],
        ];

        $batches = [
            [
                'course_id' => '5',
                'date' => '2021-08-06'
            ],
            [
                'course_id' => '5',
                'date' => '2021-08-13'
            ],
        ];

        foreach ($details as $key => $value) {
            BootcampCourseDetail::create($value);
        }
        foreach ($abouts as $key => $value) {
            BootcampDescription::create($value);
        }
        foreach ($schedules as $key => $value) {
            BootcampSchedule::create($value);
        }
        foreach ($schedule_details as $key => $value) {
            BootcampScheduleDetail::create($value);
        }
        foreach ($benefits as $key => $value) {
            BootcampBenefit::create($value);
        }
        foreach ($candidates as $key => $value) {
            BootcampCandidate::create($value);
        }
        foreach ($future_careers as $key => $value) {
            BootcampFutureCareer::create($value);
        }
        foreach ($hiring_partners as $key => $value) {
            BootcampHiringPartner::create($value);
        }
        foreach ($batches as $key => $value) {
            BootcampBatch::create($value);
        }
    }
}
