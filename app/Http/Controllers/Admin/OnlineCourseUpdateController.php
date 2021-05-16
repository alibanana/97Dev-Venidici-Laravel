<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

use App\Models\CourseCategory;
use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\CourseFeature;
use App\Models\Hashtag;
use App\Models\Assessment;

/*
|--------------------------------------------------------------------------
| Admin OnlineCourseUpdateController Class.
|
| Description:
| This controller is responsible in handling the admin's online course update
| pages and methods related to it. It has been separated from the 
| OnlineCourseController as it would be too complex.
|--------------------------------------------------------------------------
*/
class OnlineCourseUpdateController extends Controller
{
    // Shows the Admin Online Course Update Page.
    public function edit($id) {
        $course = Course::findOrFail($id);
        $course_categories = CourseCategory::select('id', 'category')->get();
        $available_assessments = Assessment::doesntHave('course')->get();
        $tags = Hashtag::all();

        return view('admin/online-course/update', compact('course', 'course_categories', 'available_assessments', 'tags'));
    }

    // Updates data as seen under the Update Online Course -> Basic Informations tab.
    public function updateBasicInfo(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png',
            'subtitle' => 'required',
            'course_category_id' => 'required',
            'preview_video_link' => 'required|starts_with:https://www.youtube.com/embed/',
            'assessment_id' => 'required|integer',
            'description' => 'required',
        'requirements' => 'required|array|min:1',
            'features' => 'required|array|min:1',
            'hashtags' => 'required|array|min:1'
        ])->setAttributeNames([
            'course_category_id' => 'category',
            'preview_video_link' => 'video link',
            'assessment_id' => 'assessment',
        ])->validate();

        $course = Course::findOrFail($id);
        $course->course_type_id = 1;
        $course->course_category_id = $validated['course_category_id'];
        $course->preview_video = $validated['preview_video_link'];
        $course->title = $validated['title'];
        $course->subtitle = $validated['subtitle'];
        $course->description = $validated['description'];

        if ($request->has('thumbnail')) {
            unlink($course->thumbnail);
            $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/online-courses/');
        }

        $course->save();

        $wasAssessmentChanged = false;

        if ($course->assessment) {
            if ($course->assessment->id != $validated['assessment_id']) {
                $assessment = $course->assessment; 
                $assessment->course_id = null;
                $assessment->save();
                if (!$wasAssessmentChanged) $wasAssessmentChanged = true;
            }
        }

        if ($validated['assessment_id'] != '0') {
            $assessment = Assessment::find($validated['assessment_id']);
            $assessment->course_id = $course->id;
            $assessment->save();
            if (!$wasAssessmentChanged) $wasAssessmentChanged = true;
        }

        $course->courseRequirements()->delete();
        foreach ($request->requirements as $requirement_value) {
            if ($requirement_value != "") {
                $new_requirement = new CourseRequirement;
                $new_requirement->course_id = $course->id;
                $new_requirement->requirement = $requirement_value;
                $new_requirement->save();
            }
        }

        $course->courseFeatures()->delete();
        foreach ($request->features as $feature_value) {
            if ($feature_value != "") {
                $new_feature = new CourseFeature;
                $new_feature->course_id = $course->id;
                $new_feature->feature = $feature_value;
                $new_feature->save();
            }
        }

        $course->hashtags()->detach();
        $added_hashtag_ids = [];
        foreach ($request->hashtags as $tag_id) {
            if (!in_array($tag_id, $added_hashtag_ids)) {
                $added_hashtag_ids[] = $tag_id;
            }
        }
        $course->hashtags()->attach($added_hashtag_ids);

        if ($course->wasChanged() || $wasAssessmentChanged) {
            $message = 'Online Course (' . $course->title . ') -> Basic Information, has been updated';
        } else {
            $message = 'No changes was made to Online Course (' . $course->title . ')';
        }

        return redirect()->route('admin.online-courses.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'basic-informations');
    }

    // Updates data as seen under the Update Online Course -> Pricing & Enrollment Scenario tab.
    public function updatePricingEnrollment(Request $request, $id) {
        $validated = $request->validate([
            'enrollment_status' => 'required',
            'is_free' => 'required|boolean',
            'price' => 'integer|min:10000'
        ]);

        $course = Course::findOrFail($id);
        $course->enrollment_status = $validated['enrollment_status'];

        if ($validated['is_free'] == '1') {
            $course->price = 0;
        } else {
            $course->price = $validated['price'];
        }

        $course->save();

        if ($course->wasChanged()) {
            $message = 'Online Course (' . $course->title . '), "Pricing & Enrollment Status" has been updated';
        } else {
            $message = 'No changes was made to Online Course (' . $course->title . ')';
        }

        return redirect()->route('admin.online-courses.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'pricing-and-enrollment');
    }
}
