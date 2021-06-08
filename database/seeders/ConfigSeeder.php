<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            [
                'key' => 'cms.homepage.top-section.heading',
                'value' => "Selamat datang di\nVenidici"
            ],
            [
                'key' => 'cms.homepage.top-section.sub-heading',
                'value' => "Platform anak kekinian buat naklukin\nkarir impian!"
            ],
            [
                'key' => 'cms.homepage.top-section.background',
                'value' => 'assets/images/seeder/homepage_background.png'
            ],
            [
                'key' => 'cms.homepage.trusted-company-section.trusted-company-count',
                'value' => '10'
            ]
        ];

        foreach ($configs as $key => $value) {
            Config::create($value);
        }
    }
}
