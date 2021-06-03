<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstructorPosition;   

class InstructorPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'name' => 'Guru IT',
                'status' => 'available'
            ],
            [
                'name' => 'Guru Matematika',
                'status' => 'available'
            ],
            [
                'name' => 'Guru Biologi',
                'status' => 'available'
            ]
            
        ];

        foreach ($positions as $key => $value) {
            InstructorPosition::create($value);
        }
    }
}
