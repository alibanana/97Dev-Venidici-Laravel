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
                'value' => "“Veni, vidi, vici.” Saya datang, saya lihat, saya\ntaklukkan."
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
