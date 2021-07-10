<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use App\Helper\CourseHelper;

use App\Models\CourseCategory;
use App\Models\CourseType;
use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\CourseFeature;

class BootcampUpdateController extends Controller
{
    // Shows the Admin Bootcamp Update Page.
    public function edit(Request $request, $id) {
        $course = Course::findOrFail($id);

        if ($course->courseType->type != 'Course') {
            return redirect()->route('admin.woki-courses.edit', $id);
        }

        $course_categories = CourseCategory::select('id', 'category')->get();

        $teachers = new Teacher;
        
        if ($request->has('search_teacher')) {
            if ($request->search_teacher == "") {
                return redirect()->route('admin.bootcamp.edit', $course->id)
                    ->with('page-option', 'teacher');
            } else {
                $teachers = $teachers->where('name', 'like', "%".$request->search_teacher."%");
            }
            
            $request->session()->flash('page-option', 'teacher');
        }

        $teachers = $teachers->get();
        
        return view('admin/bootcamp/update', compact('course', 'course_categories', 'teachers'));
    }

    // Updates data as seen under the Update Online Course -> Basic Informations tab.
    public function updateBasicInfo(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'title'                 => 'required',
            'thumbnail'             => 'mimes:jpeg,jpg,png',
            'subtitle'              => 'required',
            'course_category_id'    => 'required',
            'preview_video_link'    => 'required|starts_with:https://www.youtube.com/embed/',
            'assessment_id'         => 'required|integer',
            'description'           => 'required',
            'requirements'          => 'required|array|min:1',
        ])->setAttributeNames([
            'course_category_id'    => 'category',
            'preview_video_link'    => 'video link',
            'assessment_id'         => 'assessment',
        ])->validate();

        $course = Course::findOrFail($id);
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

        $course->courseRequirements()->delete();
        foreach ($request->requirements as $requirement_value) {
            if ($requirement_value != "") {
                $new_requirement = new CourseRequirement;
                $new_requirement->course_id = $course->id;
                $new_requirement->requirement = $requirement_value;
                $new_requirement->save();
            }
        }

        if ($course->wasChanged()) {
            $message = 'Online Course (' . $course->title . ') -> Basic Information, has been updated';
        } else {
            $message = 'No changes was made to Online Course (' . $course->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'basic-informations');
    }

    // Updates Course's Pricing & Enrollment Status.
    public function updatePricingEnrollment(Request $request, $id) {
        $validated = $request->validate([
            'enrollment_status' => 'required',
            'is_free' => 'required|boolean',
            'price' => 'integer'
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

        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'pricing-and-enrollment');
    }

    // Updates Online Course's Publish Status
    public function updatePublishStatus(Request $request, $id) {
        $validated = $request->validate([
            'publish_status' => 'required'
        ]);

        $result = CourseHelper::updatePublishStatusById($id, $validated['publish_status']);

        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $result['message'])
            ->with('page-option', 'publish-status');
    }

    // Attach teacher to a specific course.
    public function attachTeacher(Request $request, $course_id) {
        $validated = $request->validate([
            'teacher_id' => 'required'
        ]);

        $result = CourseHelper::attachTeacher(
            Course::findOrFail($course_id),
            Teacher::findOrFail($validated['teacher_id']));

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $result['message'])
            ->with('page-option', 'teacher');
    }

    // Detach teacher to a specific course.
    public function detachTeacher(Request $request, $course_id) {
        $validated = $request->validate([
            'teacher_id' => 'required'
        ]);

        $result = CourseHelper::detachTeacher(
            Course::findOrFail($course_id),
            Teacher::findOrFail($validated['teacher_id']));

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $result['message'])
            ->with('page-option', 'teacher');
    }
}
