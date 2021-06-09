<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Hashtag;

class HashtagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $tags = [
        //     [
        //         'hashtag' => 'Beginner'
        //     ],
        //     [
        //         'hashtag' => 'Intermediate'
        //     ],
        //     [
        //         'hashtag' => 'Advanced'
        //     ],
        //     [
        //         'hashtag' => 'Web Development'
        //     ],
        //     [
        //         'hashtag' => 'Mobile Development'
        //     ],
        //     [
        //         'hashtag' => 'Programming Languages'
        //     ],
        //     [
        //         'hashtag' => 'Game Development'
        //     ],
        //     [
        //         'hashtag' => 'Database Design & Development'
        //     ],
        //     [
        //         'hashtag' => 'Software Testing'
        //     ],
        //     [
        //         'hashtag' => 'Entrepreneurship'
        //     ],
        //     [
        //         'hashtag' => 'Communications'
        //     ],
        //     [
        //         'hashtag' => 'Management'
        //     ],
        //     [
        //         'hashtag' => 'Sales'
        //     ],
        //     [
        //         'hashtag' => 'Business Strategy'
        //     ],
        //     [
        //         'hashtag' => 'Accounting & Bookeeping'
        //     ],
        //     [
        //         'hashtag' => 'Cryptocurrency & Blockchain'
        //     ],
        //     [
        //         'hashtag' => 'Finance'
        //     ],
        //     [
        //         'hashtag' => 'Financial Modelling & Analysis'
        //     ],
        //     [
        //         'hashtag' => 'Investing & Trading'
        //     ],
        //     [
        //         'hashtag' => 'IT Certification'
        //     ],
        //     [
        //         'hashtag' => 'Network & Security'
        //     ],
        //     [
        //         'hashtag' => 'Hardware'
        //     ],
        //     [
        //         'hashtag' => 'Operating Systems'
        //     ],
        //     [
        //         'hashtag' => 'Microsoft Office'
        //     ],
        //     [
        //         'hashtag' => 'Amazon Cloud Services'
        //     ],
        //     [
        //         'hashtag' => 'SAP'
        //     ],
        //     [
        //         'hashtag' => 'Personal Transformation'
        //     ],
        //     [
        //         'hashtag' => 'Personal Productivity'
        //     ],
        //     [
        //         'hashtag' => 'Leadership'
        //     ],
        //     [
        //         'hashtag' => 'Career Development'
        //     ],
        //     [
        //         'hashtag' => 'Parenting & Relationships'
        //     ],
        //     [
        //         'hashtag' => 'Web Design'
        //     ],
        //     [
        //         'hashtag' => 'Graphic Design'
        //     ],
        //     [
        //         'hashtag' => 'Design Tools'
        //     ],
        //     [
        //         'hashtag' => 'UX Design'
        //     ],
        //     [
        //         'hashtag' => 'Game Design'
        //     ],
        //     [
        //         'hashtag' => 'Design Thinking'
        //     ],
        //     [
        //         'hashtag' => 'Digital Marketing'
        //     ],
        //     [
        //         'hashtag' => 'Search Engine Optimization'
        //     ],
        // ];
        
        // foreach ($tags as $key => $value) {
        //     Hashtag::create($value);
        // }

        for ($i = 0; $i < 12; $i++) { 
            Hashtag::create([
                'hashtag' => $faker->unique()->word,
                'image' => 'assets/images/seeder/hashtag-dummy-image.png',
                'color' => '#' . substr(md5(rand()), 0, 6)
            ]);
        }
    }
}
