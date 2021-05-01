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

/*
|--------------------------------------------------------------------------
| Admin OnlineCourseController Class.
|
| Description:
| This controller is responsible in handling the admin's online course pages
| and methods related to it.
|--------------------------------------------------------------------------
*/
class OnlineCourseController extends Controller
{
    // Shows the Admin Online Course Page
    public function index(Request $request) {

        $course_categories = CourseCategory::select('id', 'category')->get();
        $course_categories_category_flatten = $course_categories->map
            ->only(['category'])
            ->flatten()->toArray();

        $courses = new Course;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $courses = $courses->orderBy('created_at', 'desc');
            } else {
                $courses = $courses->orderBy('created_at');
            }
        } else {
            $courses = $courses->orderBy('created_at', 'desc');
        }

        if ($request->has('filter')) {
            if (!in_array($request->filter, $course_categories_category_flatten)) {
                $url = route('admin.online-courses.index', request()->except('filter'));
                return redirect($url);
            }

            $filter = $request->filter;

            $courses = $courses->joinSub(CourseCategory::select('id', 'category'), 'course_categories', function ($join) use ($filter) {
                $join->on('courses.course_category_id', '=', 'course_categories.id')
                ->where('course_categories.category', 'like', "%".$filter."%");
            });
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.online-courses.index', request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;

                $courses = $courses->where(function ($query) use ($search) {
                    $query->where([['title', 'like', "%".$search."%"]])
                    ->orWhere([['subtitle', 'like', "%".$search."%"]]);
                });
            }
        }

        $show_options = [10, 25, 50, 100, "All"];

        if ($request->has('show')) {
            if (!in_array($request->show, $show_options)) {
                return redirect(route('admin.online-courses.index', request()->except(['search', 'page'])));
            }

            if ($request->show == "All") {
                if ($request->has('page')) {
                    return redirect(
                        route('admin.online-courses.index', request()->except(['search', 'page'])));
                }

                $courses = $courses->get();
                $courses_data_flag = 0;
            } else {
                $courses = $courses->paginate($request->show);
                $courses_data_flag = 1;
            }
        } else {
            $courses = $courses->paginate($show_options[0]);
            $courses_data_flag = 1;
        }

        if ($courses_data_flag == 0) {
            $courses_from = 1;
            $courses_count = $courses->count();
            $courses_to = $courses_count;
        } else {
            $courses_to_array = $courses->toArray();
            $courses_from = $courses_to_array['from'];
            $courses_to = $courses_to_array['to'];
            $courses_count = $courses_to_array['total'];
        }

        $show_options_without_all = array_splice($show_options, 0, count($show_options) - 1);
        $show_options_without_all_count = count($show_options_without_all);
        
        $courses_per_page_options = [$show_options_without_all[0]];

        $counter = 0;
        while ($counter < $show_options_without_all_count - 1) {
            $option = $show_options_without_all[$counter];
            if ($courses_count > $option) {
                $courses_per_page_options[] = $show_options_without_all[$counter + 1];
            }
            $counter++;
        }

        $courses_per_page_options[] = "All";

        $courses_data = [
            'per_page_options' => $courses_per_page_options,
            'from' => $courses_from,
            'to' => $courses_to,
            'total' => $courses_count
        ];

        return view('admin/online-course/index', compact('course_categories', 'courses', 'courses_data'));
    }

    // Show Admin -> Create New Online Page
    public function create() {
        $course_categories = CourseCategory::select('id', 'category')->get();

        return view('admin/online-course/create', compact('course_categories'));
    }

    // Store New Online Course on the database.
    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
            'subtitle' => 'required',
            'course_category_id' => 'required',
            'preview_video_link' => 'required|starts_with:https://www.youtube.com/embed/',
            'description' => 'required'
        ])->setAttributeNames([
            'course_category_id' => 'category',
            'preview_video_link' => 'video link'
        ])->validate();

        $course = new Course;
        $course->course_type_id = 1;
        $course->course_category_id = $validated['course_category_id'];
        $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/online-courses/');
        $course->preview_video = $validated['preview_video_link'];
        $course->title = $validated['title'];
        $course->subtitle = $validated['subtitle'];
        $course->description = $validated['description'];
        $course->save();

        if ($request->has('requirements')) {
            foreach ($request->requirements as $requirement_value) {
                if ($requirement_value != "") {
                    $new_requirement = new CourseRequirement;
                    $new_requirement->course_id = $course->id;
                    $new_requirement->requirement = $requirement_value;
                    $new_requirement->save();
                }
            }
        }

        if ($request->has('features')) {
            foreach ($request->features as $feature_value) {
                if ($feature_value != "") {
                    $new_feature = new CourseFeature;
                    $new_feature->course_id = $course->id;
                    $new_feature->feature = $feature_value;
                    $new_feature->save();
                }
            }
        }

        return redirect()->route('admin.online-courses.index')->with('message', 'New Online Course has been added!');
    }

    // Delete Online Course from the database.
    public function destroy($id) {
        $course = Course::findOrFail($id);
        unlink($course->thumbnail);
        $course->delete();
        $message = 'Online Course (' . $course->title . ') has been deleted.';
        return redirect()->route('admin.online-courses.index')->with('message', $message);
    }

    // Change the public status of the chosen Online Course to Draft.
    public function setPublishStatusToDraft(Request $request, $id) {
        $course = Course::findOrFail($id);

        $course->publish_status = 'Draft';
        $course->save();

        $message = 'Online Course (' . $course->title . ') publish_status updated to Draft';
        return redirect()->route('admin.online-courses.index')->with('message', $message);
    }
}
