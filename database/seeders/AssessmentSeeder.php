<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Assessment;
use App\Models\AssessmentRequirement;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assessments = [
            [
                'title' => 'Assessment Template',
                'duration' => 99,
                'description' => 'This is an example of what an assessment would look like.' 
            ],
            [
                'course_id' => 1,
                'title' => 'Assessment for Emotional Intelligence Course',
                'duration' => 15,
                'description' => 'This assessment is for testing purposes only, for the Emotional Intelligence Course.' 
            ],
            [
                'course_id' => 2,
                'title' => 'Assessment for Path to Winning Business Competition Course',
                'duration' => 60,
                'description' => 'This assessment is for testing purposes only, for the Path to Winning Business Competition Course.' 
            ],
        ];

        foreach ($assessments as $key => $value) {
            Assessment::create($value);
        }

        $assessment_requirements = [
            [
                'assessment_id' => 1,
                'requirement' => 'This is the first requirements for the assessment.'
            ],
            [
                'assessment_id' => 1,
                'requirement' => 'This is the second requirements for the assessment.'
            ],
            [
                'assessment_id' => 2,
                'requirement' => 'Max Essay Length: 500 words'
            ],
            [
                'assessment_id' => 2,
                'requirement' => 'English only!'
            ],
            [
                'assessment_id' => 3,
                'requirement' => 'Max Essay Length: 3000 words.'
            ],
            [
                'assessment_id' => 3,
                'requirement' => 'Indonesian / English languages only!'
            ],
        ];

        foreach ($assessment_requirements as $key => $value) {
            AssessmentRequirement::create($value);
        }
    }
}
