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
                'user_id' => '1',
                'code' => 'GRX45',
                'type' => 'nominal',
                'promo_for' => 'price',
                'discount' => 15000,
                'isActive' => 1,
                'start_date' => '2021-06-04',
                'finish_date' => '2022-07-04'
            ],
            [
                'code' => 'GRX46',
                'type' => 'percent',
                'promo_for' => 'price',
                'discount' => 10,
                'isActive' => 1,
                'start_date' => '2021-06-04',
                'finish_date' => '2022-07-04'
            ],
            [
                'code' => 'GRX47',
                'type' => 'nominal',
                'promo_for' => 'price',
                'discount' => 15000,
                'isActive' => 1,
                'start_date' => '2021-06-04',
                'finish_date' => '2022-07-04'
            ],
            [
                'code' => 'GRX48',
                'type' => 'percent',
                'promo_for' => 'shipping',
                'discount' => 100,
                'isActive' => 1,
                'start_date' => '2021-06-04',
                'finish_date' => '2022-07-04'
            ],
        ];

        foreach ($promotions as $key => $value) {
            Promotion::create($value);
        }
    }
}
