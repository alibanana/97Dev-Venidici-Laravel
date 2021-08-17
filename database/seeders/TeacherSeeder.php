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
                'name' => 'Erwin Santoso',
                'description' => 'Berangkat dari penulis dokumenter yang pernah kesulitan bertahan hidup, Kak Erwin membuat keputusan cermat untuk perlahan shifting career mulai dari copywriter hingga sekarang jadi Digital Strategist bermindset Growth Hacking.',
                'image' => 'assets/images/seeder/Default_Display_Picture.png',
                'occupancy' => 'Digital Strategist at International NGO'
            ],
            [
                'name' => 'Ayusarita Satriani',
                'description' => 'Berperan sebagai ‘voice of truth’, di Gojek Kak Ayu terbiasa melakukan beragam eksperimen-eksperimen untuk pertumbuhan perusahaan berdasarkan situasi nyata yang terjadi di lapangan di setiap harinya.',
                'image' => 'assets/images/seeder/Default_Display_Picture.png',
                'occupancy' => 'Growth, Strategy & Planning Manager at Gojek'
            ],
            [
                'name' => 'Claudia Natasya Tambunan',
                'description' => 'Mengawali karir di Tokopedia sejak kelulusannya dari ITB, karirnya melesat mulus berkat banyak campaign besar yang berhasil dibuat dan dijalankannya semasa menjadi campaign specialist',
                'image' => 'assets/images/seeder/Default_Display_Picture.png',
                'occupancy' => 'Senior Insight & Growth, Sales & Marketing at Tokopedia'
            ],
            [
                'name' => 'Handito Aji Saroso',
                'description' => '13 tahun berkarir, udah banyak pengalaman yang dicicipi. Berawal dari tim production, sales, business development, hingga akhirnya berlabuh di Growth dan Marketing. Sejauh ini Kak Handi telah banyak berpengalaman di StartUp dengan berbagai stage.',
                'image' => 'assets/images/seeder/Default_Display_Picture.png',
                'occupancy' => 'Growth Lead at Wagely'
            ],
            [
                'name' => 'Mikael Dewabrata',
                'description' => 'Mengawali karir di bidang Social Media secara spesifik, Michael menemukan niche sesuai passionnya dalam SEO & SEM melalui BookMyShow, Modena, Zenius dan sering berinisiatif membuka kelas dikantornya!',
                'image' => 'assets/images/seeder/Default_Display_Picture.png',
                'occupancy' => 'SEO & SEM Specialist at MODENA'
            ],
            [
                'name' => 'Karina Yusanta Ayu',
                'description' => 'Jatuh cinta pada job roles yang bisa memberikan dampak nyata pada bisnis & menjangkau market secara inovatif menjadi alasan utama Karina untuk mendalami growth hacking.',
                'image' => 'assets/images/seeder/Default_Display_Picture.png',
                'occupancy' => 'City Growth Lead at Grab | Ex-Samsung Electronics'
            ],
            [
                'name' => 'Welby Nazhari',
                'description' => 'Memulai karir di IT dan Desain Grafis, namun beralih ke Growth Hacking. Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​',
                'image' => 'assets/images/seeder/Default_Display_Picture.png',
                'occupancy' => 'Channel Marketing Specialist at Kumparan'
            ],
        ];

        foreach ($teachers as $key => $value) {
            Teacher::create($value);
        }
    }
}
