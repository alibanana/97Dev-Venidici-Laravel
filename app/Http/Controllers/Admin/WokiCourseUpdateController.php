<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Helper\Helper;
use App\Helper\CourseHelper;

use App\Models\CourseCategory;
use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\CourseFeature;
use App\Models\Hashtag;
use App\Models\Teacher;
use App\Models\ArtSupply;

/*
|--------------------------------------------------------------------------
| Admin WokiCourseUpdateController Class.
|
| Description:
| This controller is responsible in handling the admin's woki course update
| pages and methods related to it. It has been separated from the 
| WokiCourseController as it would be too complex.
|--------------------------------------------------------------------------
*/
class WokiCourseUpdateController extends Controller
{
    // Shows the Admin Woki Course Update Page.
    public function edit(Request $request, $id) {
        $course = Course::findOrFail($id);

        if ($course->courseType->type == 'Bootcamp') {
            return redirect()->route('admin.bootcamp.edit', $id);
        }
        elseif($course->courseType->type == 'Course') {
            return redirect()->route('admin.online-courses.edit', $id);
        }

        $course_categories = CourseCategory::select('id', 'category')->get();
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

        $startTimeConverted = Carbon::createFromFormat('H:i:s', $course->wokiCourseDetail->start_time)->format('H:i');
        $endTimeConverted = Carbon::createFromFormat('H:i:s', $course->wokiCourseDetail->end_time)->format('H:i');

        $artSupplies = ArtSupply::all();
        
        return view('admin/woki/update', compact('course', 'course_categories', 'tags', 'teachers', 'startTimeConverted', 'endTimeConverted', 'artSupplies'));
    }

    // Updates data as seen under the Update Woki Course -> Basic Informations tab.
    public function updateBasicInfo(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|alpha_spaces',
            'thumbnail' => 'mimes:jpeg,jpg,png',
            'subtitle' => 'required',
            'course_category_id' => 'required',
            'preview_video_link' => 'required|starts_with:https://www.youtube.com/embed/',
            'meeting_link' => 'required|starts_with:https://',
            'event_date' => 'required|date_format:Y-m-d|after:now',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'required',
            'requirements' => 'required|array|min:1',
            'features' => 'required|array|min:1',
            'hashtags' => 'required|array|min:1'
        ])->setAttributeNames([
            'course_category_id' => 'category',
            'preview_video_link' => 'video link'
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'basic-informations'])->withErrors($validator);

        $validated = $validator->validate();

        $course = Course::findOrFail($id);
        $course->course_category_id = $validated['course_category_id'];
        $course->preview_video = $validated['preview_video_link'];
        $course->title = $validated['title'];
        $course->subtitle = $validated['subtitle'];
        $course->description = $validated['description'];

        if ($request->has('thumbnail')) {
            unlink($course->thumbnail);
            $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/woki-courses/');
        }

        $course->save();

        $wokiCourseDetail = $course->wokiCourseDetail;
        $wokiCourseDetail->meeting_link = $validated['meeting_link'];
        $wokiCourseDetail->event_date = $validated['event_date'];
        $wokiCourseDetail->start_time = $validated['start_time'];
        $wokiCourseDetail->end_time = $validated['end_time'];
        $eventDuration = Carbon::createFromFormat('H:i', $validated['start_time'])->diffInMinutes(Carbon::createFromFormat('H:i', $validated['end_time']));
        $wokiCourseDetail->event_duration = $eventDuration;
        $wokiCourseDetail->save();

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

        if ($course->wasChanged()) {
            $message = 'Woki Course (' . $course->title . ') -> Basic Information, has been updated';
        } else {
            $message = 'No changes was made to Woki Course (' . $course->title . ')';
        }

        return redirect()->route('admin.woki-courses.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'basic-informations');
    }

    // Updates Woki Course's Pricing & Enrollment Status.
    public function updatePricingEnrollment(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'enrollment_status' => 'required',
            'is_free' => 'required|boolean',
            'price' => 'integer',
            'priceWithArtKit' => 'integer'
        ]);

        if ($validator->fails())
            return redirect()->back()->with('page-option', 'pricing-and-enrollment')->withErrors($validator);

        $validated = $validator->validate();
        $course = Course::findOrFail($id);
        $course->enrollment_status = $validated['enrollment_status'];

        if ($validated['is_free'] == '1') {
            $course->price = 0;
        } else {
            $course->price = $validated['price'];
            if(array_key_exists('priceWithArtKit', $validated))
                $course->priceWithArtKit = $validated['priceWithArtKit'];
        }

        $course->save();

        if ($course->wasChanged()) {
            $message = 'Woki Course (' . $course->title . '), "Pricing & Enrollment Status" has been updated';
        } else {
            $message = 'No changes was made to Woki Course (' . $course->title . ')';
        }

        return redirect()->route('admin.woki-courses.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'pricing-and-enrollment');
    }

    // Updates Woki Course's Publish Status
    public function updatePublishStatus(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'publish_status' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->with('page-option', 'publish-status')->withErrors($validator);

        $validated = $validator->validate();

        $result = CourseHelper::updatePublishStatusById($id, $validated['publish_status']);

        return redirect()->route('admin.woki-courses.edit', $id)
            ->with('message', $result['message'])
            ->with('page-option', 'publish-status');
    }

    // Attach / Detach Art Supply from a Course.
    public function attachDetachArtSupply(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'art_supply_id' => 'required|integer'
        ]);

        if ($validator->fails())
            return redirect()->back()->with('page-option', 'art-supply')->withErrors($validator);

        $validated = $validator->validate();

        $course = Course::findOrFail($id);
        $artSupply = ArtSupply::findOrFail($validated['art_supply_id']);

        if ($course->artSupplies()->where('art_supply_id', $artSupply->id)->first()){
            $course->artSupplies()->detach($artSupply->id);

            // After detaching artSupply, if no more artSupply is attached to the course, update priceWithArtKit to null.
            if (!$course->artSupplies()->exists()) {
                $course->priceWithArtKit = null;
                $course->save();
            }
            $message = 'Art Supply (' . $artSupply->name . ') has been removed from this course.';
        } else {
            // If no artSupply has been attach to the course, update priceWithArtKit == price.
            if (!$course->artSupplies()->exists()) {
                $course->priceWithArtKit = $course->price;
                $course->save();
            }

            $course->artSupplies()->attach($artSupply->id);
            $message = 'Art Supply (' . $artSupply->name . ') has been added to this course.';
        }

        return redirect()->route('admin.woki-courses.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'art-supply');
    }

    // Attach teacher to a specific course.
    public function attachTeacher(Request $request, $course_id) {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->with('page-option', 'teacher')->withErrors($validator);

        $validated = $validator->validate();

        $result = CourseHelper::attachTeacher(
            Course::findOrFail($course_id),
            Teacher::findOrFail($validated['teacher_id']));

        return redirect()->route('admin.woki-courses.edit', $course_id)
            ->with('message', $result['message'])
            ->with('page-option', 'teacher');
    }

    // Detach teacher to a specific course.
    public function detachTeacher(Request $request, $course_id) {
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->with('page-option', 'teacher')->withErrors($validator);

        $validated = $validator->validate();

        $result = CourseHelper::detachTeacher(
            Course::findOrFail($course_id),
            Teacher::findOrFail($validated['teacher_id']));

        return redirect()->route('admin.woki-courses.edit', $course_id)
            ->with('message', $result['message'])
            ->with('page-option', 'teacher');
    }
}
