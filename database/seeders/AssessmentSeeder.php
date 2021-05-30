<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Assessment;
use App\Models\AssessmentRequirement;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentQuestionAnswer;

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

        $questions = [
            // For "Assessment Template"
            [
                'assessment_id' => 1,
                'question' => 'Example, is this the first question?'
            ],
            [
                'assessment_id' => 1,
                'question' => 'Example, is this the last question?'
            ],
            [
                'assessment_id' => 1,
                'question' => 'Example, is this the third question?'
            ],
            // For "Assessment for Emotional Intelligence Course"
            [
                'assessment_id' => 2,
                'question' => 'Define "Emotional Intelligence"?'
            ],
            // For "Assessment for Path to Winning Business Competition Course"
            [
                'assessment_id' => 3,
                'question' => "Based on the teacher's lecture, what should you prepare upon entering a Business Competition?"
            ]
        ];

        foreach ($questions as $key => $value) {
            AssessmentQuestion::create($value);
        }

        $answers = [
            // For "Assessment Template" -> "Example, is this the first question?"
            [
                'assessment_question_id' => 1,
                'answer' => 'This is NOT the first question.',
                'is_correct' => false
            ],
            [
                'assessment_question_id' => 1,
                'answer' => 'This is the first question.',
                'is_correct' => true
            ],
            [
                'assessment_question_id' => 1,
                'answer' => "Don't choose this answer.",
                'is_correct' => false
            ],
            // For "Assessment Template" -> "Example, is this the last question?"
            [
                'assessment_question_id' => 2,
                'answer' => 'Yes, this is definitely the last content.',
                'is_correct' => false
            ],
            [
                'assessment_question_id' => 2,
                'answer' => 'This is actually the second question.',
                'is_correct' => true
            ],
            // For "Assessment Template" -> "Example, is this the third question?"
            [
                'assessment_question_id' => 3,
                'answer' => 'This is NOT the third question.',
                'is_correct' => false
            ],
            [
                'assessment_question_id' => 3,
                'answer' => 'This is the third question.',
                'is_correct' => true
            ],
            // For "Assessment for Emotional Intelligence Course" -> "Define "Emotional Intelligence"?"
            [
                'assessment_question_id' => 4,
                'answer' => 'Emotional intelligence, emotional quotient and emotional intelligence quotient, is the capability of individuals to recognize their own emotions and those of others.',
                'is_correct' => true
            ],
            [
                'assessment_question_id' => 4,
                'answer' => 'This is not the answer, this is just an example of a wrong question.',
                'is_correct' => false
            ],
            // For "Assessment for Path to Winning Business Competition Course" -> "Based on the teacher's lecture, what should you prepare upon entering a Business Competition?"
            [
                'assessment_question_id' => 5,
                'answer' => 'Prepare this thing #1',
                'is_correct' => true
            ],
            [
                'assessment_question_id' => 5,
                'answer' => 'Prepare this thing #2 (wrong answer)',
                'is_correct' => false
            ],
            [
                'assessment_question_id' => 5,
                'answer' => 'Prepare this thing #3',
                'is_correct' => true
            ],
            [
                'assessment_question_id' => 5,
                'answer' => 'Prepare this thing #4 (wrong answer)',
                'is_correct' => false
            ],
        ];

        foreach ($answers as $key => $value) {
            AssessmentQuestionAnswer::create($value);
        }

        // $assessment2 = Assessment::findOrFail(2);
        // $assessment2->users()->attach([3, 4, 5, 6, 7, 8, 9, 10]);

        // $assessment3 = Assessment::findOrFail(3);
        // $assessment3->users()->attach([11, 12, 13, 14, 15, 16, 17]);
    }
}