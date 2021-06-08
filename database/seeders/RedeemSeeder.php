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
                'title' => 'Diskon Hallelujah!',
                'description' => 'Potongan Rp10,000 untuk pembelian course.',
                'stars' => '120',
                'type' => 'nominal',
                'discount' => '10000',
                'promo_for' => 'price'
            ],
            [
                'title' => 'Diskon Hallelujah!',
                'description' => 'Potongan Rp15,000 untuk pembelian course.',
                'stars' => '180',
                'type' => 'nominal',
                'discount' => '15000',
                'promo_for' => 'price'

            ],
            [
                'title' => 'Diskon Hallelujah!',
                'description' => 'Potongan Rp20,000 untuk pembelian course.',
                'stars' => '250',
                'type' => 'nominal',
                'discount' => '20000',
                'promo_for' => 'price'

            ],
            [
                'title' => 'Charity yuk!',
                'description' => 'Sumbang Rp10,000 ke Jalin Mimpi!',
                'stars' => '100',
                'type' => 'nominal',
                'discount' => '10000',
                'promo_for' => 'charity'
            ],
            [
                'title' => 'Charity yuk!',
                'description' => 'Sumbang Rp15,000 ke Jalin Mimpi!',
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
