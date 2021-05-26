<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Assessment;
use App\Models\AssessmentRequirement;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentQuestionAnswer;

/*
|--------------------------------------------------------------------------
| Admin AssessmentController Class.
|
| Description:
| This controller is responsible in handling the admin's assessments pages
| and methods related to it.
|--------------------------------------------------------------------------
*/
class AssessmentController extends Controller
{
    // Shows the Admin Assestments Page
    public function index() {
        $assessments = Assessment::all();

        return view('admin/assessment/index', compact('assessments'));
    }

    // Shows the Create Assessment Page
    public function create() {
        return view('admin/assessment/create');
    }

    // Store new Assestment in the database
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'duration' => 'required|min:1',
            'description' => 'required',
            'requirements' => 'required|array'
        ]);

        $assessment = Assessment::create([
            'title' => $validated['title'],
            'duration' => $validated['duration'],
            'description' => $validated['description']
        ]);

        foreach ($validated['requirements'] as $requirement) {
            if ($requirement != '') {
                $newRequirement = AssessmentRequirement::create([
                    'assessment_id' => $assessment->id,
                    'requirement' => $requirement
                ]);
            }
        }

        $message = 'New Assessment has been added to the database!';

        return redirect()->route('admin.assessments.index')->with('message', $message);
    }

    // Stores new Question in the database.
    public function storeQuestion(Request $request, $id) {
        $assessment = Assessment::findOrFail($id);
        
        $validated = $request->validate([
            'question' => 'required',
            'answers' => 'array|min:1',
            'answers.*.answer' => 'required',
            'answers.*.is_correct' => 'required|boolean'
        ]);

        $question = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'question' => $validated['question']
        ]);

        foreach ($validated['answers'] as $answer) {
            $newAnswer = AssessmentQuestionAnswer::create([
                'assessment_question_id' => $question->id,
                'answer' => $answer['answer'],
                'is_correct' => $answer['is_correct']
            ]);
        }

        $message = "New Question has been added to the database!";

        return redirect()->route('admin.assessments.edit', $id)
            ->with('message', $message)
            ->with('flag', 'questions');
    }

    // Shows the Update Assessment Page.
    public function edit($id) {
        $assessment = Assessment::findOrFail($id);
        return view('admin/assessment/update', compact('assessment'));
    }

    // Updates Assessment's Basic Information
    public function updateBasicInfo(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required',
            'duration' => 'required|min:1',
            'description' => 'required',
            'requirements' => 'required|array'
        ]);

        $assessment = Assessment::findOrFail($id);
        $assessment->title = $validated['title'];
        $assessment->duration = $validated['duration'];
        $assessment->description = $validated['description'];
        $assessment->save();

        $assessment->assessmentRequirements()->delete();
        foreach ($validated['requirements'] as $requirement) {
            if ($requirement != '') {
                $newRequirement = AssessmentRequirement::create([
                    'assessment_id' => $assessment->id,
                    'requirement' => $requirement
                ]);
            }
        }

        if ($assessment->wasChanged()) {
            $message = 'Assessment (' . $assessment->title . ') has been updated!';
        } else {
            $message = 'No changes was made to Assessment (' . $assessment->title . ')';
        }

        return redirect()->route('admin.assessments.edit', $id)
            ->with('message', $message)
            ->with('flag', 'basic-informations');
    }

    // Update a specific question.
    public function updateQuestion(Request $request, $assessment_id, $question_id) {
        $assessment = Assessment::findOrFail($assessment_id);
        $question = $assessment->assessmentQuestions()->where('id', $question_id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'question_' . $question_id => 'required',
            'answers' => 'required|array|min:1',
            'answers.*.id' => 'numeric',
            'answers.*.answer' => 'required',
            'answers.*.is_correct' => 'required|boolean'
        ])->setAttributeNames([
            'question_' . $question_id => 'question'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.assessments.edit', $assessment->id)
                ->with('flag', 'questions')
                ->withErrors($validated->errors());
        }

        $validated = $validator->validate();

        $question->question = $validated['question_'. $question_id];
        $question->save();

        $answers_ids = $question->assessmentQuestionAnswers()->select('id')->get()->map
            ->only('id')->flatten()->toArray();

        $wasAnswersChanged = false;
        foreach ($validated['answers'] as $answer) {
            if ($answer['id']) {  // Updates existing answer.
                if (in_array($answer['id'], $answers_ids)) {
                    $answerToBeUpdated = $question->assessmentQuestionAnswers()
                        ->where('id', $answer['id'])->first();
                    $answerToBeUpdated->answer = $answer['answer'];
                    $answerToBeUpdated->is_correct = $answer['is_correct'];
                    $answerToBeUpdated->save();
                    if (!$wasAnswersChanged && $answerToBeUpdated->wasChanged()) {
                        $wasAnswersChanged = true;
                    }
                }
            } else { // Create new answer.
                AssessmentQuestionAnswer::create([
                    'assessment_question_id' => $question_id,
                    'answer' => $answer['answer'],
                    'is_correct' => $answer['is_correct']
                ]);
                if (!$wasAnswersChanged) $wasAnswersChanged = true;
            }
        }

        if ($question->wasChanged() || $wasAnswersChanged) {
            $message = 'Question (' . $question->id . ') has been updated in the database.';
        } else {
            $message = 'No changes was made to Question (' . $question->id . ')';
        }

        return redirect()->route('admin.assessments.edit', $assessment->id)
            ->with('message', $message)
            ->with('flag', 'questions');
    }

    // Delete existing Assessment (by ID) from the database.
    public function destroy($id) {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();
        $message = 'Assessment (' . $assessment->id . ') has been deleted from the database!';
        return redirect()->route('admin.assessments.index')->with('message', $message);
    }

    // Delete a specific question from the database.
    public function destroyQuestion($assessment_id, $question_id) {
        $assessment = Assessment::findOrFail($assessment_id);
        $question = $assessment->assessmentQuestions()->where('id', $question_id)->firstOrFail();
        $question->delete();

        $message = 'Question (' . $question->id . ') has been deleted from the database!';
        
        return redirect()->route('admin.assessments.edit', $assessment->id)
            ->with('message', $message)
            ->with('flag', 'questions');
    }
    
    public function showResult($assessment_id, $user_id)
    {
        return view('admin/assessment/result');
    }
}
