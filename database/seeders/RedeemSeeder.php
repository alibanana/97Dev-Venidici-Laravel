<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redeem;

class RedeemSeeder extends Seeder
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
                'stars' => '120',
                'type' => 'nominal',
                'discount' => '10000',
                'promo_for' => 'price'
            ],
            [
                'stars' => '180',
                'type' => 'nominal',
                'discount' => '15000',
                'promo_for' => 'price'

            ],
            [
                'stars' => '250',
                'type' => 'nominal',
                'discount' => '20000',
                'promo_for' => 'price'

            ],
            [
                'stars' => '100',
                'type' => 'nominal',
                'discount' => '10000',
                'promo_for' => 'charity'
            ],
            [
                'stars' => '160',
                'type' => 'nominal',
                'discount' => '15000',
                'promo_for' => 'charity'
            ],
        ];

        foreach ($promotions as $key => $value) {
            Redeem::create($value);
        }
    }
}
