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
                'thumbnail' => 'assets/images/seeder/fake-testimony-dummy-1.png',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                'rating' => 5,
                'name' =>  'Gabrielle Amilaeno',
                'occupancy' => 'Copy Writer'
            ],
            [
                'thumbnail' => 'assets/images/seeder/fake-testimony-dummy-2.png',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                'rating' => 5,
                'name' =>  'Fernandha Dzaky',
                'occupancy' => 'Developer'
            ],
            [
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'rating' => 4.9
            ],
            [
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'rating' => 4.9
            ]
        ];

        foreach ($testimonies as $key => $value) {
            FakeTestimony::create($value);
        }
    }
}
