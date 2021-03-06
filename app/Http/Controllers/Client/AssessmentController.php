<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Assessment;
use App\Models\Review;
use App\Models\Notification;

use App\Models\Cart;

use App\Helper\Helper;
use Jenssegers\Agent\Agent;

use Illuminate\Support\Facades\Mail;
use App\Mail\FinishCourseMail;



/*
|--------------------------------------------------------------------------
| Client AssessmentController Class.
|
| Description:
| This controller is responsible in handling the client assessment pages,
| assessment-completed page and additional functions needed. This controller
| also handles ajax function required in the course's assessment page.
|--------------------------------------------------------------------------
*/ 
class AssessmentController extends Controller
{
    private $notifications; // Stores combined notifications data.
    private $informations; // Stores notification (isInformation == true) data.
    private $transactions; // Stores notification (isInformation == false) data for a particular user.
    private $cart_count; // Stores cart data for a particular user.

    private function resetNavbarData() {
        $navbarData = Helper::getNavbarData();
        $this->notifications = $navbarData['notifications'];
        $this->informations = $navbarData['informations'];
        $this->transactions = $navbarData['transactions'];
        $this->cart_count = $navbarData['cart_count'];
    }
    // Shows the Assessment Completed page.
    public function completedIndex(Request $request, $course_id) {
        $agent = new Agent();
        // if($agent->isPhone()){
        //     return view('client/mobile/under-construction');
        // }
        $this->resetNavbarData();

        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $course = auth()->user()->courses()->where('course_id', $course_id)->firstOrFail();
        $assessment_pivot = auth()->user()->assessments()->where('course_id', $course_id)->firstOrFail()->pivot;

        if ($assessment_pivot->status != "finished") abort(404);
        
        // $cart_count = Cart::with('course')
        //     ->where('user_id', auth()->user()->id)
        //     ->count();
        // $transactions = Notification::where(
        //     [   
        //         ['user_id', '=', auth()->user()->id],
        //         ['isInformation', '=', 0],
                
        //     ]
        //     )->orderBy('created_at', 'desc')->get();
        // $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        // $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        
        //change user_course status to completed
        $user_course = auth()->user()->courses()->where('course_id', $course_id)->firstOrFail();
        $link = route('customer.dashboard');

        if($user_course->pivot->status != 'completed') {
            Mail::to(auth()->user()->email)->send(new FinishCourseMail($course,$link));
            Helper::addStars(auth()->user(), 15, 'Penyelesaian course '.$course->title);
        }

        $user_course->pivot->status = 'completed';
        $user_course->pivot->save();

        $reviews = Review::where([   
            ['user_id', '=', auth()->user()->id],
            ['course_id', '=', $request->course_id],    
        ])->get();

        $userHasReviewed = null;
        if (count($reviews) != 0)
            $userHasReviewed = TRUE;
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/online-course/completed', compact('cart_count','transactions','informations','notifications','course', 'assessment_pivot','userHasReviewed','footer_reviews'));
    }

    // Shows the Assessment page itself.
    public function show($course_id) {
        $agent = new Agent();
        // if($agent->isPhone()){
        //     return view('client/mobile/under-construction');
        // }
        $assessment = auth()->user()->assessments()->where('course_id', $course_id)->firstOrFail();
        $assessment_pivot = $assessment->pivot;

        if ($assessment_pivot->status == "finished")
            return redirect()->route('online-course-assessment.completed-index', $assessment->course_id)
                ->with('message', 'You have already completed this assessment.');
        
        $assessment_pivot->status = "on-going";
        $assessment_pivot->save();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/online-course/assessment', compact('assessment', 'assessment_pivot','footer_reviews'));
    }

    // Updates the User-Assessment mapping pivot data in the database.
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'questions' => 'array'
        ]);

        $assessment = auth()->user()->assessments()->where('assessments.id', $id)->firstOrFail();
        
        $question_answer_data = ""; $correct_answers_count = 0;

        if ($request->has('questions')) {
            foreach ($validated['questions'] as $question_id => $answer_id) {
                $question = $assessment->assessmentQuestions()->where('id', $question_id)->firstOrFail();
                $answer = $question->assessmentQuestionAnswers()->where('id', $answer_id)->firstOrFail();
                $question_answer_data = $question_answer_data . $question_id . '#' . $answer_id . ',';
                if ($answer->is_correct) $correct_answers_count++; 
            }
    
            $question_answer_data = substr($question_answer_data, 0, -1);
        }

        $assessment_pivot = $assessment->pivot;
        $assessment_pivot->user_data = $question_answer_data;
        $assessment_pivot->status = 'finished';
        $assessment_pivot->score = round($correct_answers_count / count($assessment->assessmentQuestions) * 100);
        $assessment_pivot->save();

        return redirect()->route('online-course-assessment.completed-index', $assessment->course_id)
            ->with('message', 'Conratulations, you have completed this assessment.');
    }

    // Reset the User-Assessment mapping pivot data "status" to pending.
    public function resetUserAssessment(Request $request, $id) {
        $validated = $request->validate([
            'redirectURL' => 'required'
        ]);

        $assessment = auth()->user()->assessments()->where('assessments.id', $id)->firstOrFail();
        $assessment_pivot = $assessment->pivot;
        
        $assessment_pivot->user_data = null;
        $assessment_pivot->status = "pending";
        $assessment_pivot->time_taken = 0;
        $assessment_pivot->score = null;
        $assessment_pivot->save();

        return redirect($validated['redirectURL']);
    }

    // Updates the time_taken value of Users & Assessment mapping.
    public function updateAssessmentTimer(Request $request, $id) {
        $assessment = auth()->user()->assessments()->where('assessments.id', $id)->firstOrFail();
        $assessment->pivot->time_taken =  ($assessment->duration * 60) - $request->duration;
        $assessment->pivot->save();

        return json_encode(array('statusCode' => 200));
    }
}
