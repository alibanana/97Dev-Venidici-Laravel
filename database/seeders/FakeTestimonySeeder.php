<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\FakeTestimony;

class FakeTestimonySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonies = [
            [
                'thumbnail' => 'assets/images/client/Default_Display_Picture.png',
                'content' => 'Sebenernya ga tau mau ngomong apa karna saking kerennya acara kemaren, I get many things, ilmu baru, wawasan baru, pengalaman baru, temen baru juga seru banget dan waktu 4 jam gak kerasa banget!',
                'rating' => 5,
                'name' =>  '@Reqihanifah',
                'occupancy' => ''
            ],
            [
                'thumbnail' => 'assets/images/client/Default_Display_Picture.png',
                'content' => 'In those 4 hours, I got a lot of insights about business case competition, all the details from the framework used to the way of deliver analysis & solution so that it can be presented well to the jury',
                'rating' => 5,
                'name' =>  '@wishnumurti',
                'occupancy' => ''
            ],
            [
                'content' => 'Great! Bisa belajar banyak hal sampai detail tentang copywriting, jadi dapat banyak insights juga buat copywriting nantinya :D',
                'rating' => 4.9
            ],
            [
                'content' => 'Interaktif banget!',
                'rating' => 4.9
            ]
        ];

        foreach ($testimonies as $key => $value) {
            FakeTestimony::create($value);
        }
    }
}
