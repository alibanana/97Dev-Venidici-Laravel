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
use App\Models\Teacher;

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
    public function edit(Request $request, $id) {
        $course = Course::findOrFail($id);
        $course_categories = CourseCategory::select('id', 'category')->get();
        $available_assessments = Assessment::doesntHave('course')->get();
        $tags = Hashtag::all();

        $teachers = new Teacher;
        
        if ($request->has('search_teacher')) {
            if ($request->search_teacher == "") {
                return redirect()->route('admin.online-courses.edit', $course->id)
                    ->with('page-option', 'teacher');
            } else {
                $teachers = $teachers->where('name', 'like', "%".$request->search_teacher."%");
            }
            
            $request->session()->flash('page-option', 'teacher');
        }

        $teachers = $teachers->get();
        
        return view('admin/online-course/update', compact('course', 'course_categories', 'available_assessments', 'tags', 'teachers'));
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

    // Updates Course's Pricing & Enrollment Status.
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

    // Updates Publish Status
    public function updatePublishStatus(Request $request, $id) {
        $validated = $request->validate([
            'publish_status' => 'required'
        ]);

        $course = Course::findOrFail($id);
        $course->publish_status = $validated['publish_status'];
        $course->save();

        if ($course->wasChanged()) {
            $message = 'Online Course (' . $course->title . '), "Publish Status" has been updated';
        } else {
            $message = 'No changes was made to Online Course (' . $course->title . ')';
        }

        return redirect()->route('admin.online-courses.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'publish-status');
    }

    // Attach teacher to a specific course.
    public function attachTeacher(Request $request, $course_id) {
        $validated = $request->validate([
            'teacher_id' => 'required'
        ]);

        $teacher = Teacher::findOrFail($validated['teacher_id']);

        $course = Course::findOrFail($course_id);
        $course->teachers()->attach($validated['teacher_id']);

        $message = $teacher->name . ' has been added to the course.';

        return redirect()->route('admin.online-courses.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'teacher');
    }

    // Detach teacher to a specific course.
    public function detachTeacher(Request $request, $course_id) {
        $validated = $request->validate([
            'teacher_id' => 'required'
        ]);

        $teacher = Teacher::findOrFail($validated['teacher_id']);

        $course = Course::findOrFail($course_id);
        $course->teachers()->detach($validated['teacher_id']);

        $message = $teacher->name . ' has been removed from the course.';

        return redirect()->route('admin.online-courses.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'teacher');
    }
}
