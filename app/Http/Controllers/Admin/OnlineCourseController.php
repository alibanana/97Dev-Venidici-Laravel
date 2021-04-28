<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CourseCategory;
use App\Models\Course;

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

        $courses = $courses->get();

        return view('admin/online-course/index', compact('course_categories', 'courses'));
    }
}
