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
use App\Models\BootcampCourseDetail;
use App\Models\CourseFeature;
use App\Models\BootcampDescription;

use App\Models\Teacher;
use App\Models\BootcampSchedule;
use App\Models\Hashtag;


class BootcampUpdateController extends Controller
{
    // Shows the Admin Bootcamp Update Page.
    public function edit(Request $request, $id) {
        $course = Course::findOrFail($id);
        if ($course->courseType->type == 'Woki') {
            return redirect()->route('admin.woki-courses.edit', $id);
        }
        elseif($course->courseType->type == 'Course') {
            return redirect()->route('admin.online-courses.edit', $id);
        }

        $course_categories = CourseCategory::select('id', 'category')->get();

        $teachers = new Teacher;
        $tags = Hashtag::all();

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
        $schedules = BootcampSchedule::where('course_id',$id)->get();

        return view('admin/bootcamp/update', compact('course', 'course_categories', 'teachers','schedules','tags'));
    }

    // Updates data as seen under the Update Online Course -> Basic Informations tab.
    public function updateBasicInfo(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png',
            'subtitle' => 'required',
            'course_category_id' => 'required',
            'what_will_be_taught' => '',
            'meeting_link' => '',
            'syllabus' => 'mimes:pps,ppt,pptx,xls,xlsm,xlsx,doc,docx,pdf',
            'description' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'trial_date_end' => 'required',
            'whatsapp' => 'required',
            'hashtags' => 'required|array|min:1'
        ])->setAttributeNames([
            'course_category_id'    => 'category',
        ]);
        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'basic-informations'])->withErrors($validator);
        
        $validated = $validator->validate();

        $course = Course::findOrFail($id);
        $course->course_category_id = $validated['course_category_id'];
        $course->title              = $validated['title'];
        $course->subtitle           = $validated['subtitle'];
        $course->description        = $validated['description'];

        if ($request->has('thumbnail')) {
            unlink($course->thumbnail);
            $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/bootcamp/');
        }

        $course->save();


        $course->hashtags()->detach();
        $added_hashtag_ids = [];
        foreach ($request->hashtags as $tag_id) {
            if (!in_array($tag_id, $added_hashtag_ids)) {
                $added_hashtag_ids[] = $tag_id;
            }
        }
        $course->hashtags()->attach($added_hashtag_ids);

        $bootcampCourseDetail                       = BootcampCourseDetail::where('course_id',$course->id)->first();
        $bootcampCourseDetail->what_will_be_taught  = $validated['what_will_be_taught'];
        $bootcampCourseDetail->meeting_link         = $validated['meeting_link'];
        $bootcampCourseDetail->date_start           = $validated['date_start'];
        $bootcampCourseDetail->date_end             = $validated['date_end'];
        $bootcampCourseDetail->trial_date_end       = $validated['trial_date_end'];
        $bootcampCourseDetail->whatsapp             = $validated['whatsapp'];

        if ($request->has('syllabus')) {
            if (!is_null($bootcampCourseDetail->syllabus)) unlink($bootcampCourseDetail->syllabus);
            $bootcampCourseDetail->syllabus = Helper::storeFile($request->file('syllabus'), 'storage/documents/bootcamp/syllabus/');
            $bootcampCourseDetail->save();
        }


        $bootcampCourseDetail->save();

        if ($course->wasChanged() || $bootcampCourseDetail->wasChanged()) {
            $message = 'Bootcamp (' . $course->title . ') -> Basic Information, has been updated';
        } else {
            $message = 'No changes was made to Bootcamp (' . $course->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'basic-informations');
    }

    // Updates Course's Pricing & Enrollment Status.
    public function updatePricingEnrollment(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'enrollment_status' => 'required',
            'bootcamp_full_price' => 'integer',
            'bootcamp_trial_price' => 'integer'
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'pricing-and-enrollment'])->withErrors($validator);

        $validated = $validator->validate();

        $course = Course::findOrFail($id);
        $course->enrollment_status = $validated['enrollment_status'];
        $course->save();

        $course_detail = $course->bootcampCourseDetail;
        $course_detail->bootcamp_full_price = $validated['bootcamp_full_price'];
        $course_detail->bootcamp_trial_price = $validated['bootcamp_trial_price'];
        $course_detail->save();

        if ($course->wasChanged() || $course_detail->wasChanged()) {
            $message = 'Bootcamp (' . $course->title . '), "Pricing & Enrollment Status" has been updated';
        } else {
            $message = 'No changes was made to Bootcamp (' . $course_detail->title . ')';
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


    public function editBootcampSchedules(){
        $view = 'admin/bootcamp/update-bootcamp-schedules';

        return view($view);
    }

    
    
}
