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

        if ($course->courseType->type != 'Woki') {
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
        
        return view('admin/woki/update', compact('course', 'course_categories', 'tags', 'teachers', 'startTimeConverted', 'endTimeConverted'));
    }

    // Updates data as seen under the Update Woki Course -> Basic Informations tab.
    public function updateBasicInfo(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
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
        $validated = $request->validate([
            'enrollment_status' => 'required',
            'is_free' => 'required|boolean',
            'price' => 'integer',
            'priceWithArtKit' => 'integer'
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
        $validated = $request->validate([
            'publish_status' => 'required'
        ]);

        $result = CourseHelper::updatePublishStatusById($id, $validated['publish_status']);

        return redirect()->route('admin.woki-courses.edit', $id)
            ->with('message', $result['message'])
            ->with('page-option', 'publish-status');
    }
}
