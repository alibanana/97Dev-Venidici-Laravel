<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BootcampCourseDetail;

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
                'bootcamp_full_price' => '500000',
                'bootcamp_trial_price' => '250000',
            ],
            [
                'course_id' => '6',
                'meeting_link' => 'zoom.com/fa79dajk',
                'date_start' => '2021-08-05',
                'date_end' => '2021-08-27',
                'trial_date_end' => '2021-08-06',
                'bootcamp_full_price' => '300000',
                'bootcamp_trial_price' => '150000',
            ],
        ];

        foreach ($details as $key => $value) {
            BootcampCourseDetail::create($value);
        }
    }
}
