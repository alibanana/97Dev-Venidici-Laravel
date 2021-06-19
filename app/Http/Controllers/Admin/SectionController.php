<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Course;
use App\Models\Section;

/*
|--------------------------------------------------------------------------
| Admin SectionController Class.
|
| Description:
| This controller is responsible in handling functions / methods related to
| the Section model.
|--------------------------------------------------------------------------
*/
class SectionController extends Controller
{
    // Store a new Section (of a curricullum) in the database.
    public function store(Request $request) {
        $validated = $request->validate([
            'course_id' => 'required|integer',
            'section-title' => 'required'
        ]);
        
        $course = Course::findOrFail($validated['course_id']);

        $section = new Section;
        $section->course_id = $course->id;
        $section->title = $validated['section-title'];
        $section->save();

        if ($course->courseType->type == 'Course') {
            $route = 'admin.online-courses.edit';
            $message = 'Section (' . $section->title  . ') has been added to Online Course (' . $course->title . ')';
        } elseif ($course->courseType->type == 'Woki') {
            $route = 'admin.woki-courses.edit';
            $message = 'Section (' . $section->title  . ') has been added to Woki Course (' . $course->title . ')';
        }

        return redirect()->route($route, $course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }

    // Update a specific section in the database.
    public function update(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'section-title-' . $id => 'required'
        ])->setAttributeNames([
            'section-title-' . $id => 'section-title'
        ])->validate();

        $section = Section::findOrFail($id);
        $section->title = $validated['section-title-' . $id];
        $section->save();

        if ($section->wasChanged()) {
            $message = 'Section (' . $section->title  . ') has been updated';
        } else {
            $message = 'No changes was made here.';
        }

        if ($section->course->courseType->type == 'Course')
            $route = 'admin.online-courses.edit';
        elseif ($section->course->courseType->type == 'Woki')
            $route = 'admin.woki-courses.edit';

        return redirect()->route($route, $section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }

    // Delete a specific section of a course.
    public function destroy($id) {
        $section = Section::findOrFail($id);

        foreach ($section->sectionContents as $content) {
            if (!is_null($content->attachment)) {
                unlink($content->attachment);
            }
        }

        $section->delete();

        if ($section->course->courseType->type == 'Course') {
            $route = 'admin.online-courses.edit';
            $message = 'Section (' . $section->title  . ') has been deleted from Online Course (' . $section->course->title . ')';
        } elseif ($section->course->courseType->type == 'Woki') {
            $route = 'admin.woki-courses.edit';
            $message = 'Section (' . $section->title  . ') has been deleted from Woki Course (' . $section->course->title . ')';
        }

        return redirect()->route($route, $section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }
}
