<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Models\WokiCourseDetail;

class WokiCourseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event_dates = []; $start_times = []; $end_times = [];

        // Save random event dates.
        $event_dates[] = Carbon::now()->addWeeks(rand(1, 52));
        $event_dates[] = Carbon::now()->addWeeks(rand(1, 52));
        
        // Save random start times.
        $start_times[] = Carbon::now()->addHours(rand(1, 5));
        $start_times[] = Carbon::now()->addHours(rand(1, 5));

        // Save random end times.
        $end_times[] = Carbon::now()->addHours(rand(6, 12));
        $end_times[] = Carbon::now()->addHours(rand(6, 12));

        $course_details = [
            [
                'course_id' => 3,
                'meeting_link' => 'https://meet.google.com/mnd-tpqm-gbb',
                'event_date' => $event_dates[0]->format('Y-m-d'),
                'start_time' => $start_times[0]->format('H:i:s'),
                'end_time' => $end_times[0]->format('H:i:s'),
                'event_duration' => $start_times[0]->diffInMinutes($end_times[0])
            ],
            [
                'course_id' => 4,
                'meeting_link'=> 'https://meet.google.com/mnd-tpqm-gbb',
                'event_date' => $event_dates[1]->format('Y-m-d'),
                'start_time' => $start_times[1]->format('H:i:s'),
                'end_time' => $end_times[1]->format('H:i:s'),
                'event_duration' => $start_times[1]->diffInMinutes($end_times[1])
            ],
        ];

        foreach ($course_details as $key => $value) {
            WokiCourseDetail::create($value);
        }
    }
}
