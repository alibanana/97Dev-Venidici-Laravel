<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\CourseCategory;

/*
|--------------------------------------------------------------------------
| Admin CourseCategoryController Class.
|
| Description:
| This controller is responsible in handling the admin's course categories
| pages and methods related to it.
|--------------------------------------------------------------------------
*/ 
class CourseCategoryController extends Controller
{
    // Show the Admin -> Online Courses -> Course Category Page.
    public function index() {
        $course_categories = CourseCategory::all();

        return view('admin/course-category/index', compact('course_categories'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'category' => 'required',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        $category = CourseCategory::findOrFail($id);
        $category->category = $validated['category'];
        
        if ($request->has('image')) {
            $filepath = Helper::storeImage($request->file('image'), 'storage/images/course-categories/');
            unlink($category->image);
            $category->image = $filepath;
        }

        $category->save();

        return redirect()->route('admin.course-categories.index')->with('message', 'Course category has been updated!');
    }
}
