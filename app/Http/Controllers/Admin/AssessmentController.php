<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Assessment;
use App\Models\AssessmentRequirement;

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
            $newRequirement = AssessmentRequirement::create([
                'assessment_id' => $assessment->id,
                'requirement' => $requirement
            ]);
        }

        $message = 'New Assessment has been added to the database!';

        return redirect()->route('admin.assessments.index')->with('message', $message);
    }

    // Delete existing Assessment (by ID) from the database.
    public function destroy($id) {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();
        $message = 'Assessment (' . $assessment->id . ') has been deleted from the database!';
        return redirect()->route('admin.assessments.index')->with('message', $message);
    }
}
