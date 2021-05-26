<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use App\Models\Promotion;
class PromotionSeeder extends Seeder
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
                'code' => 'GRX45',
                'discount' => 10,
                'start_date' => '2021-05-26',
                'finish_date' => '2022-05-26'
            ],
            [
                'code' => 'GRX46',
                'discount' => 10,
                'start_date' => '2021-05-26',
                'finish_date' => '2021-05-27'
            ],
            [
                'code' => 'GRX47',
                'discount' => 10,
                'start_date' => '2021-05-23',
                'finish_date' => '2022-05-24'
            ],
        ];

        foreach ($promotions as $key => $value) {
            Promotion::create($value);
        }
    }
}
