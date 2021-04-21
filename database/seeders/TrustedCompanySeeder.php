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
                'company' => 'Institut Teknologi Bandung',
                'image' => 'assets/images/seeder/trusted-company-itb.png'
            ],
            [
                'company' => 'Bank BCA',
                'image' => 'assets/images/seeder/trusted-company-bca.png'
            ],
            [
                'company' => 'Flick Software',
                'image' => 'assets/images/seeder/trusted-company-flick.png'
            ],
            [
                'company' => 'Silvi',
                'image' => 'assets/images/seeder/trusted-company-silvi.png'
            ]
        ];

        foreach ($companies as $key => $value) {
            TrustedCompany::create($value);
        }
    }
}
