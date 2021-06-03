<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Course Types: Course, Woki, Workshop
        // Course Category: Tech, Arts, Math, Personal Development, Business

        $courses = [
            [
                'course_type_id' => 1,
                'course_category_id' => 4,
                'thumbnail' => 'assets/images/seeder/course-emotional-intelligence.jpg',
                'preview_video' => 'https://www.youtube.com/embed/aLqZYlmzNCY',
                'title' => 'Emotional Intelligence',
                'subtitle' => 'Recorded Webinar',
                'description' => 'Pesatnya perkembangan teknologi saat ini sudah banyak menggeser manusia dari berbagai pekerjaan. Di masa yang akan datang, kemampuan dalam me-manage manusialah yang diprediksi akan terus eksis dan justru meningkat dalam permintaan. Era baru pekerjaan itu kini hampir di depan mata, sudah siapkah kamu?'
            ],
            [
                'course_type_id' => 1,
                'course_category_id' => 5,
                'thumbnail' => 'assets/images/seeder/course-business.jpg',
                'preview_video' => 'https://www.youtube.com/embed/_CTH2tddrJg',
                'title' => 'Path to Winning Business Competition',
                'subtitle' => 'Rekaman Virtual Workshop',
                'description' => '"Business Competition is a way to accelerate knowledge"

                Ada yang pernah dengar pepatah ini? Pepatah ini mungkin merupakan alasan bagi beberapa orang untuk mengikuti business competition. Kompetisi bisnis memiliki banyak sekali keuntungan seperti koneksi, ilmu, dan pengalaman. Bukan hanya itu, di beberapa business competition, kamu bahkan bisa mendapatkan uang yang cukup besar lho apabila kamu menang.
                
                Namun untuk memenangkan business competition ini bukanlah hal yang mudah. Kompetisi ini biasanya diisi oleh orang-orang dengan daya juang dan ilmu yang tinggi. Business competition tidak akan bisa dimenangkan tanpa persiapan yang baik.
                
                Oleh karena itu, kami menyediakan rekaman webinar dari "Path to winning Business Competition" yang diselenggarakan 20 December 2020 lalu. Acara ini akan diisi oleh 3 pembicara keren yaitu Kak Novika Endini yang akan membawakan topik "Business Plan", Kak Valda Izah yang akan membawakan topik "Marketing Plan", dan Kak Khairul Arifin yang akan membawakan topik "Business Case". Rekaman webinar ini akan dibagi menjadi 4 bagian, yaitu Overview, Room Business Case, Room Business Plan, dan Room Marketing Plan.
                
                Dengan mengikuti course ini, kamu akan lebih paham tentang bagaimana caranya untuk memenangi business competition!',
                'price' => 125000,
                'publish_status' => 'Published',
                'average_rating' => 4.3
            ]
        ];

        // foreach ($courses as $key => $value) {
        //     Course::create($value);
        // }

        $course1 = Course::create($courses[0]);
        // $course1->hashtags()->attach([27, 28, 30]);
        $course1->hashtags()->attach([1, 2, 3]);
        $course1->teachers()->attach([2, 3]);
        // $course1->users()->attach([3, 4, 5, 6, 7, 8, 9, 10]);

        $course2 = Course::create($courses[1]);
        // $course2->hashtags()->attach([10, 14, 29]);
        $course2->hashtags()->attach([5, 7, 2]);
        $course2->teachers()->attach([1]);
        // $course2->users()->attach([11, 12, 13, 14, 15, 16, 17]);
    }
}
