<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\TrustedCompany;

class TrustedCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'image' => 'assets/images/seeder/trusted-company-itb.png'
            ],
            [
                'image' => 'assets/images/seeder/trusted-company-bca.png'
            ],
            [
                'image' => 'assets/images/seeder/trusted-company-flick.png'
            ],
            [
                'image' => 'assets/images/seeder/trusted-company-silvi.png'
            ]
        ];

        foreach ($companies as $key => $value) {
            TrustedCompany::create($value);
        }
    }
}
