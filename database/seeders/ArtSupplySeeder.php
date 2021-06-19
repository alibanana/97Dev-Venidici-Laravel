<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ArtSupply;

class ArtSupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $art_supplies = [
            [
                'image' => 'assets/images/seeder/faber-castell-colour-pencils.jpg',
                'name' => 'Faber Castell - 48 Colour Pencils',
                'description' => 'This colour pencil set has 48 different colours.'
            ],
            [
                'image' => 'assets/images/seeder/origami-paper.jpg',
                'name' => 'Set of Origami Papers',
                'description' => 'This set consists of 20 pieces of randomly coloured origami papers.'
            ]
        ];

        $colourPencils = ArtSupply::create($art_supplies[0]);
        $colourPencils->courses()->attach(3);

        $colourPencils = ArtSupply::create($art_supplies[1]);
        $colourPencils->courses()->attach(3);
    }
}
