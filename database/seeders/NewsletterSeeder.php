<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Newsletter;

class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            [
                'email' => 'fernandhadzaky@hotmail.com'
            ],
            [
                'email' => 'testing@hotmail.com'
            ],
            [
                'email' => 'ninetyseven@hotmail.com'
            ]
        ];

        foreach ($promotions as $key => $value) {
            Newsletter::create($value);
        }
    }
}
