<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\SectionContent;

class SectionContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            [
                'section_id' => 1,
                'title' => 'Introduction',
                'youtube_link' => 'https://www.youtube.com/embed/LgUCyWhJf6s',
                'description' => 'Many of humanity’s greatest problems stem not from a shortfall of technical or financial intelligence,  but what we term emotional intelligence. It is through the acquisition of Emotional Intelligence that we stand to become better lovers, workers, friends and citizens. We are rarely systematically taught Emotional Intelligence and pay a heavy price for this gap in learning. The School of Life is dedicated to fostering Emotional Intelligence.',
                'duration' => 328
            ],
            [
                'section_id' => 1,
                'title' => 'Chapter 1: Mastering Your Own Emotions',
                'youtube_link' => 'https://www.youtube.com/embed/QGQQ7pJQqHk',
                'attachment' => 'assets/documents/seeder/content-attachment-2.pdf',
                'description' => 'In this video, I talk about mastering the emotions and emotional intelligence (for lack of a better term).',
                'duration' => 494
            ],
            [
                'section_id' => 2,
                'title' => 'Part 1',
                'youtube_link' => 'https://www.youtube.com/embed/QGQQ7pJQqHk',
                'description' => 'This is the main QnA content, if there is one.',
                'duration' => 494
            ],
            [
                'section_id' => 3,
                'title' => 'Introduction - Benefits of Competition',
                'youtube_link' => 'https://www.youtube.com/embed/D1lvJeYsYL0',
                'description' => 'Competition among businesses plays a crucial role in creating and sustaining a healthy economy. This video explores the benefits that fair and healthy competition can provide to consumers, businesses, and governments.',
                'duration' => 125
            ],
            [
                'section_id' => 3,
                'title' => 'Chapter 1: Loving Your Competitors',
                'youtube_link' => 'https://www.youtube.com/embed/RZBfUkMhZdQ',
                'attachment' => 'assets/documents/seeder/content-attachment-5.pdf',
                'description' => 'What’s the secret to great business ideas, and successful business strategies? In this inspiring talk Alex M H Smith founder of Basic Arts reveals that it all starts with refusing to compete.',
                'duration' => 1058
            ]
        ];

        foreach ($contents as $key => $value) {
            SectionContent::create($value);
        }
    }
}
