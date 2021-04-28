<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    // Store new category to the database
    public function store(Request $request) {

    }

    // Update existing category in the database.
    public function update(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'category-' . $id => 'required',
            'image-' . $id => 'mimes:jpeg,jpg,png'
        ])->setAttributeNames([
            'category-' . $id => 'category',
            'image-' . $id => 'image'
        ])->validate();
            
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
