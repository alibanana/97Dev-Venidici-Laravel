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
                // 'preview_video' => '',
                'title' => 'Emotional Intelligence',
                'sub_title' => 'Recorded Webinar',
                'description' => '<p><span style="color: rgb(38, 38, 38);">Pesatnya perkembangan teknologi saat ini sudah banyak menggeser manusia dari berbagai pekerjaan. Di masa yang akan datang, kemampuan dalam me-</span><em style="color: rgb(38, 38, 38);">manage </em><span style="color: rgb(38, 38, 38);">manusialah yang diprediksi akan terus eksis dan justru meningkat dalam permintaan. Era baru pekerjaan itu kini hampir di depan mata, sudah siapkah kamu?</span></p>'
            ],
            [
                'course_type_id' => 1,
                'course_category_id' => 5,
                'thumbnail' => 'assets/images/seeder/course-business.jpg',
                // 'preview_video' => '',
                'title' => 'Path to Winning Business Competition',
                'sub_title' => 'Rekaman Virtual Workshop',
                'description' => '<p><em>"Business Competition is a way to accelerate knowledge</em>"</p><p><br></p><p>Ada yang pernah dengar pepatah ini? Pepatah ini mungkin merupakan alasan bagi beberapa orang untuk mengikuti <em>business competition</em>. Kompetisi bisnis memiliki banyak sekali keuntungan seperti koneksi, ilmu, dan pengalaman. Bukan hanya itu, di beberapa <em>business competition</em>, kamu bahkan bisa mendapatkan uang yang cukup besar lho apabila kamu menang.</p><p><br></p><p>Namun untuk memenangkan <em>business competition </em>ini bukanlah hal yang mudah. Kompetisi ini biasanya diisi oleh orang-orang dengan daya juang dan ilmu yang tinggi. B<em>usiness competition</em> tidak akan bisa dimenangkan tanpa persiapan yang baik.</p><p><br></p><p>Oleh karena itu, kami menyediakan rekaman webinar dari "<em>Path to winning Business Competition</em>" yang diselenggarakan 20 December 2020 lalu. Acara ini akan diisi oleh 3 pembicara keren yaitu Kak Novika Endini yang akan membawakan topik "<em>Business Plan</em>", Kak Valda Izah yang akan membawakan topik "<em>Marketing Plan</em>", dan Kak Khairul Arifin yang akan membawakan topik "Business Case". Rekaman webinar ini akan dibagi menjadi 4 bagian, yaitu Overview, Room Business Case, Room Business Plan, dan Room Marketing Plan.</p><p><br></p><p>Dengan mengikuti <em>course</em> ini, kamu akan lebih paham tentang bagaimana caranya untuk memenangi <em>business competition</em>!</p><p><br></p><p><strong><u>Profil Pembicara</u></strong></p><p><em>Novika Endini </em></p><p><br></p><p>Kak Novika Endini adalah seorang konsultan manajemen di MITS. Ia merupakan alumni dari teknik industri Institut Teknologi Bandung. Selama masa perkuliahanya, ia sudah berkali-kali mengikuti lomba bisnis. Beberapa penghargaan yang pernah ia raih adalah</p><ul><li>International Best Application of Design Thinking Techniques Award in Social Innovation+ Business Model Competition 2019 (Hongkong)&nbsp;</li><li>Best Pitcher of Student Pitch First Competition Prasetya Mulya University 2019&nbsp;</li><li>Awardee of Ganesha Karsa Award 2019</li></ul><p>Berikut adalah <a href="https://www.linkedin.com/in/vikaendini/" target="_blank">LinkedIn dari Kak Novika Endini</a></p><p><br></p><p><em>Valda Izah</em></p><p><br></p><p>Kak Valda Izah adalah seorang Assistant Account Manager Cash &amp; Carry bagi Unilever Indonesia. Ia merupakan seorang lulusan manajemen dari Sekolah Bisnis dan Manajemen Institut Teknologi Bandung. Beberapa penghargaan yang pernah ia raih adalah</p><ul><li>National Team 1st Runner Up Unilever Future Leaders League 2018</li><li>Winner of Nutrifood Master Challenge 2018</li><li>Most Outstanding Student of School of Business and Management 2019</li></ul><p>Berikut adalah <a href="https://www.linkedin.com/in/valdaizah/" target="_blank">LinkedIn dari Kak Valda Izah</a></p><p><br></p><p><em>Khairul Arifin</em></p><p><br></p><p>Kak Khairul Arifin adalah seorang Global Graduate Programme (Brand Management) di BAT (British American Tobacco). Ia merupakan seorang lulusan manajemen dari Sekolah Bisnis dan Manajemen Institut Teknologi Bandung. Beberapa penghargaan yang pernah ia raih adalah</p><ul><li>The 1st Winner of Pop Up Ideas Competition - Generasi Berkreasi Business Plan Competition by Martha Tilaar Group</li><li>The 1st Winner of Diponegoro National Business Case Competition</li><li>The National Team 2nd Runner Up of Unilever Future Leader League 2018 - National Business Case Competition&nbsp;</li></ul><p>Berikut adalah <a href="https://www.linkedin.com/in/khairul-arifin/" target="_blank">LinkedIn dari Kak Khairul Arifin</a></p><p><br></p><p><strong><u>Apa kata orang tentang webinar ini?</u></strong></p><p><strong>Rata-rata rating : 5.18 dari 6</strong></p><p><em>"Overall impressive. Venidici did a great job!."</em></p><p><br></p><p><em>"Sudah sangat baik materi dan manajemen waktunya, serta fasilitator juga sangat transparan dan menginspirasi, terimakasih Venidici!"</em></p><p><br></p><p><em>"Tema udah oke dan termasuk yang jarang ditemukan di webinar lain. Pematerinya juga okeoke banget. Terima kasih!"</em></p>',
                'price' => 125000,
                'publish_status' => 'Published',
                'average_rating' => 4.3
            ]
        ];

        foreach ($courses as $key => $value) {
            Course::create($value);
        }
    }
}
