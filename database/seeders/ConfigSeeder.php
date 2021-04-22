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
                'value' => 'Anytime, anywhere.'
            ],
            [
                'key' => 'cms.homepage.top-section.sub-heading',
                'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla.'
            ],
            [
                'key' => 'cms.homepage.top-section.video',
                'value' => 'assets/videos/seeder/homepage-video.mp4'
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
