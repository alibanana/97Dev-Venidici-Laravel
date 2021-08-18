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
                'course_id' => '1',
                'meeting_link' => 'zoom.com/5hqo34',
                'syllabus' => 'assets/documents/seeder/content-attachment-2.pdf',
                'date_start' => '2021-09-20',
                'date_end' => '2022-01-29',
                'trial_date_end' => '2021-09-27',
                'what_will_be_taught' => 'Setelah lulus dari bootcamp kami, kamu akan dapat bereksperimen growth hacking berdasarkan data, paham berbagai konsep growth hacking dan marketing, sampai melatih softskill teamwork, communication, dan mempersiapkan karir',
                'bootcamp_full_price' => '9500000',
                'bootcamp_trial_price' => '1500000',
            ]
        ];

        $abouts = [
            [
                'course_id' => '1',
                'title' => 'Growth Hacking Overview',
                'image' => 'assets/images/seeder/Skill_Penunjang_Karir.png',
                'description' => 'Growth Hacking memadukan marketing, teknologi, dan penggunaan data untuk memaksimalkan resource. Dengan me-reveal strategi terbaik melalui eksperimen dan analisis berdasarkan data, pertumbuhan perusahaan yang cepat dapat tercapai.
                
                Karakternya yang cepat dan efisien bikin Growth Hacking juga cocok untuk startup atau bisnis kecil yang pada umumnya minim sumber daya. Tidak seperti Digital Marketing yang hanya fokus dalam mencari pelanggan, Growth Hacking merambah semua aspek dan departemen dengan satu tujuan utama yakni pertumbuhan perusahaan.'
            ],
            [
                'course_id' => '1',
                'title' => 'Opportunity in The Field',
                'image' => 'assets/images/seeder/Skill_Penunjang_Karir.png',
                'description' => 'Keberadaan Growth Hacking di Indonesia masih sangat langka. Kompetisinya minim! Tapi peluang di waktu dekat sangat besar berkat banyaknya startup dan bisnis-bisnis baru yang kian bermunculan. 

                Sebagai Bootcamp Growth Hacking pertama di Indonesia, Venidici adalah jalur terbaik kamu untuk jadi yang terdepan dibanding yang lain di industri ini.
                ​'
            ],
            [
                'course_id' => '1',
                'title' => 'Real PAID PROJECT',
                'image' => 'assets/images/seeder/Skill_Penunjang_Karir.png',
                'description' => 'Semua project yang akan dijalankan diracik semirip mungkin dengan keadaan yang terjadi di lingkungan kerja nyata demi memaksimalkan persiapan setiap peserta untuk masa kerja nanti. Beberapa project bahkan disalurkan langsung dari perusahaan partner Venidici sehingga peserta bisa mendapat pengalaman otentik dengan benar-benar langsung berkontribusi di perusahaan. Sama seperti di lingkungan aslinya, peserta juga berkesempatan mendapatkan bayaran atas project yang dikerjakan.'
            ],
            [
                'course_id' => '1',
                'title' => 'Wide Range of Expertise',
                'image' => 'assets/images/seeder/Skill_Penunjang_Karir.png',
                'description' => 'Growth Hacking punya scope yang luas sehingga pilihan karirnya pun beragam. Dengan belajar Growth Hacking, secara tidak langsung kamu sudah mempelajari materi seperti experimentation, content marketing, UI/UX, copywriting, data analytics, dan berbagai marketing hack yang bisa memiliki jalur karir tersendiri secara individual selain pilihan karir rekomendasi utama Venidici seperti Growth Hacker, Digital Marketer, Product Manager, Performance Marketer. Menjadikan perjalanan karir kamu ke depan akan jauh lebih terjamin.'
            ],
        ];

        $schedules = [
            [
                'course_id' => '1',
                'date_start' => '2021-08-06',
                'date_end' => '2021-08-13',
                'title' => 'Week 1',
                'subtitle' => 'Growth Fundamentals',
            ],
            [
                'course_id' => '1',
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
                'course_id' => '1',
                'title' => 'After-hours Online Live Class with Expert Instructors',
                'description' => 'Kelas live interaktif 3 kali dalam seminggu untuk membantumu menyerap ilmu yang dibutuhkan di industri
                
                Dapatkan modul lengkap untuk setiap kelas!
                ',
            ],
            [
                'course_id' => '1',
                'title' => 'Group and individual project',
                'description' => 'Praktekin apa yang dipelajari di kelas, mulai dari ilmu baru sampai tools terkini
                
                Kuasai materi mingguan dengan praktek yang telah kami desain
                
                Mengerjakan real PAID project untuk pengalaman bekerja bagi perusahaan yang lebih nyata
                ',
            ],
            [
                'course_id' => '1',
                'title' => 'Personalized Coaching',
                'description' => 'Nikmati fasilitas one on one session dengan para mentor berpengalaman untuk mendapatkan saran, kritik, ataupun sekadar berbagi experience seputar bidang karir',
            ],
            [
                'course_id' => '1',
                'title' => 'Career Lab',
                'description' => 'Dapatkan kelas workshop persiapan karir mulai dari pembuatan CV, mock-up interview, sampai konsultasi karir
                
                Dapatkan personalized career coach untuk membantumu menata rencana karir dan akhirnya menggapai pekerjaan impianmu
                ',
            ],
            [
                'course_id' => '1',
                'title' => 'Student assistance via Slack',
                'description' => 'Bebas tanya mentor terkait tugas dan materi yang masih belum dipahami
                
                Bekerja kolaboratif dan juga saling bertukar pendapat bersama peserta bootcamp lainnya
                ',
            ],
        ];

        $candidates = [
            [
                'course_id' => '1',
                'title' => 'Career First Timer',
                'description' => 'Baru lulus atau sebentar lagi? Bootcamp ini akan menjadi batu loncatan terbaik kamu dalam menggaet pengalaman baru dan mengawali karir di dunia Growth Hacking dan Marketing.',
            ],
            [
                'course_id' => '1',
                'title' => 'Career Shifter',
                'description' => 'Meninggalkan karir lama adalah keputusan yang besar, make it count! Imbangi lembaran baru kamu di industri yang berkembang sangat cepat ini dengan materi komplit bersama instruktur expert kami.',
            ],
            [
                'course_id' => '1',
                'title' => 'Business Owners',
                'description' => 'Tak hanya efektif untuk startup besar, sifat alami Growth Hacking yang memaksimalkan resource minim menjadi pertumbuhan yang impactful juga sangat cocok untuk bisnis-bisnis kecil. Tumbuhkan sendiri bisnis kamu bersama Venidici!',
            ],
            [
                'course_id' => '1',
                'title' => 'Professionals and Employees',
                'description' => 'Sudah cukup familiar dengan industri Growth Hacking? Lucky for you! Berkat scope Growth Hacking yang amat luas, akan masih banyak yang bisa kamu pelajari sehingga kesempatan upskilling masih amat besar sekalipun kamu sudah cukup familiar dengan industri tetangga seperti Marketing. Ajukan program upskilling melalui perusahaan tempat kamu bekerja untuk kemungkinan penawaran yang bahkan lebih menarik lagi.',
            ],
        ];

        $future_careers = [
            [
                'course_id' => '1',
                'thumbnail' => 'assets/images/seeder/Growth_Hacker_Icon.png',
                'title' => 'Growth Hacker',
                'description' => 'The man of the show. Growth Hacking menggunakan sistem eksperimen berbasis data yang dilakukan menyeluruh di setiap aspek perusahaan untuk tujuan utama pertumbuhan perusahaan dengan resource seminimal mungkin.',
            ],
            [
                'course_id' => '1',
                'thumbnail' => 'assets/images/seeder/Digital_Marketer.png',
                'title' => 'Digital Marketer’ & ‘Performance Marketer',
                'description' => 'Mempromosikan brand melalui berbagai saluran atau channel digital. Diperlukan hubungan yang kuat antara brand dan pelanggan untuk peningkatan konversi yang maksimal.’',
            ],
            [
                'course_id' => '1',
                'thumbnail' => 'assets/images/seeder/Various_Marketing.png',
                'title' => 'Various Marketing Specialization',
                'description' => 'Berkat scope Growth Hacking yang luas, tersedia berbagai pilihan karir yang berangkat dari topik-topik materi secara individu. Ada copywriter, SEO & SEM specialist, Social Media Manager, Content Creator, dan lain sebagainya.',
            ],
        ];

        $hiring_partners= [
            [
                'course_id' => '1',
                'image' => 'assets/images/seeder/Bootcamp_Hiring_Partner_1.png',
            ],
            [
                'course_id' => '1',
                'image' => 'assets/images/seeder/Group 1109.png',
            ],
            [
                'course_id' => '1',
                'image' => 'assets/images/seeder/Group 1110.png',
            ],
            [
                'course_id' => '1',
                'image' => 'assets/images/seeder/Group 1115.png',
            ],
            [
                'course_id' => '1',
                'image' => 'assets/images/seeder/Group 1111.png',
            ],
            [
                'course_id' => '1',
                'image' => 'assets/images/seeder/Group 1113.png',
            ],
        ];

        $batches = [
            [
                'course_id' => '1',
                'date' => '2021-09-20'
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
