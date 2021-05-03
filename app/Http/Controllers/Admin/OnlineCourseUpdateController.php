<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Hashtag;

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
        $tags = Hashtag::all();

        return view('admin/online-course/update', compact('course', 'course_categories', 'tags'));
    }

    // Update existing Online-Course in the database.
    public function update(Request $request, $id) {
        $course = Course::findOrFail($id);

        return redirect()->route('admin.online-courses.edit', $id)->with('message', 'Online Course (name) has been updated!');
    }
}
