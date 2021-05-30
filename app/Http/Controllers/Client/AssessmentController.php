<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Assessment;
use App\Models\Notification;

class AssessmentController extends Controller
{
    public function show($course_id) {
        $assessment = auth()->user()->assessments()->where('course_id', $course_id)->firstOrFail();
        $assessment_pivot = $assessment->pivot;
        
        $assessment_pivot->status = "on-going";
        $assessment_pivot->save();
        
        return view('client/online-course/assessment', compact('assessment', 'assessment_pivot'));
    }

    public function updateAssessmentTimer(Request $request, $id) {
        $assessment = auth()->user()->assessments()->where('assessments.id', $id)->firstOrFail();
        $assessment->pivot->time_taken =  $assessment->duration - $request->duration;
        $assessment->pivot->save();

        return json_encode(array('statusCode' => 200));
    }
}
