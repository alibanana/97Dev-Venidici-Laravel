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
        $features_old = [
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
            [
                'course_id' => 5,
                'title' => 'Expert Instructors',
                'feature' => 'Instruktur dan mentor berkualitas yang telah berpengalaman di bidangnya akan memastikan penyampaian materi terbaik serta mudah dipahami bagi semua peserta. Instruktur bootcamp Venidici berasal dari beragam perusahaan Startup besar dan ternama di Indonesia seperti Gojek, Tokopedia, Wagely, Kumparan, dan Grab.',
            ],
            [
                'course_id' => 5,
                'title' => 'Guaranteed Job Offer',
                'feature' => 'Semua peserta Bootcamp Growth Hacking Venidici memiliki fasilitas jaminan diterima kerja di berbagai hiring partner yang bekerjasama dengan kami. Membuktikan tingkat kepercayaan diri Venidici dalam masa depan Growth Hacking di Indonesia ataupun luar negri!',
            ],
            [
                'course_id' => 5,
                'title' => 'Payment Flexibility',
                'feature' => 'Pada akhirnya, karir kamulah yang terpenting! Sistem pembayaran fleksibel antara bayar penuh, atau bahkan dengan Income Share Agreement yang memungkinkan kamu untuk ikut bootcamp tanpa membayar terlebih dahulu! Jadwal kelas yang juga diadakan di luar jam kerja pada umumnya yang pastinya memudahkan kamu untuk mengikuti bootcamp sekalipun beriringan dengan kegiatan lain.',
            ],
        ];
        $features = [
            
            // Bootcamp Courses
            [
                'course_id' => 1,
                'title' => 'Expert Instructors',
                'feature' => 'Instruktur dan mentor berpengalaman dari beragam Startup besar dan ternama di Indonesia seperti Gojek, Tokopedia, Kumparan, dan Grab.',
            ],
            [
                'course_id' => 1,
                'title' => 'Guaranteed Job Offer',
                'feature' => 'Semua peserta Bootcamp Growth Hacking Venidici memiliki fasilitas jaminan diterima kerja di berbagai perusahaan. Venidici percaya diri akan masa depan Growth Hacking di Indonesia ataupun luar negri!',
            ],
            [
                'course_id' => 1,
                'title' => 'Payment Flexibility',
                'feature' => 'Pada akhirnya, karir kamulah yang terpenting! Sistem pembayaran kami fleksibel antara bayar langsung atau skema Income Share Agreement yang bikin kamu bisa bayar nanti setelah dapet kerja!',
            ],
        ];

        foreach ($features as $key => $value) {
            CourseFeature::create($value);
        }
    }
}
