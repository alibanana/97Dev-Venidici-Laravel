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
        $validated = $request->validate([
            'category' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $category = new CourseCategory;
        $category->category = $validated['category'];
        $category->image = Helper::storeImage($request->file('image'), 'storage/images/course-categories/');
        $category->save();

        return redirect()->route('admin.course-categories.index')->with('message', 'New Category has been added!');
    }

    // Update existing category in the database.
    public function update(Request $request, $id) {
        $attributes = [
            'category' => 'category-' . $id,
            'image' => 'image-' . $id
        ];

        $validated = Validator::make($request->all(), [
            $attributes['category'] => 'required',
            $attributes['image'] => 'mimes:jpeg,jpg,png'
        ])->setAttributeNames([
            $attributes['category'] => 'category',
            $attributes['image'] => 'image'
        ])->validate();
            
        $category = CourseCategory::findOrFail($id);
        $category->category = $validated[$attributes['category']];
        
        if ($request->has($attributes['image'])) {
            $filepath = Helper::storeImage($request->file($attributes['image']), 'storage/images/course-categories/');
            unlink($category->image);
            $category->image = $filepath;
        }

        $category->save();

        if ($category->wasChanged()) {
            $message = 'Category (' . $category->category . ') has been updated';
        } else {
            $message = 'No changes was made to Category (' . $category->category . ')';
        }
        
        return redirect()->route('admin.course-categories.index')->with('message', $message);
    }

    // Deletes category (by id) from the database.
    public function destroy($id) {
        $category = CourseCategory::findOrFail($id);

        unlink($category->image);
        $category->delete();
        
        $message = 'Category (' . $category->category . ') has been deleted.';
        return redirect()->route('admin.course-categories.index')->with('message', $message);
    }
}
