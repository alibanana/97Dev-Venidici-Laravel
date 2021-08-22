<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use App\Helper\CourseHelper;

use App\Models\Section;
use App\Models\SectionContent;

/*
|--------------------------------------------------------------------------
| Admin SectionContentController Class.
|
| Description:
| This controller is responsible in handling functions / methods related to
| the SectionContent model.
|--------------------------------------------------------------------------
*/
class SectionContentController extends Controller
{
    // Store a new Content (of a specific section) in the database.
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'section_id' => 'bail|required|integer',
            'section-' . $request->section_id . '-newContentTitle' => 'required|alpha_spaces'
        ])->setAttributeNames([
            'section-' . $request->section_id . '-newContentTitle' => 'content-title'
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'manage-curriculum'])->withErrors($validator);

        $validated = $validator->validate();

        // Validates if section exists
        $section = Section::findOrFail($validated['section_id']);

        // Get route for redirect.
        if ($section->course->courseType->type == 'Course')
            $route = 'admin.online-courses.edit';
        elseif ($section->course->courseType->type == 'Woki')
            $route = 'admin.woki-courses.edit';
        elseif ($section->course->courseType->type == 'Bootcamp')
            $route = 'admin.bootcamp.edit';

        $newContentTitle = $validated['section-' . $validated['section_id'] . '-newContentTitle'];

        // Checks if sectionContent is unique in course level.
        $isSectionContentTitleUnique = CourseHelper::isSectionContentTitleUniqueByCourseObjectAndTitle($section->course, $newContentTitle);
        if (!$isSectionContentTitleUnique)
            return redirect()->route($route, $section->course->id)->with(['page-option' => 'manage-curriculum'])->withErrors([
                'section-' . $validated['section_id'] . '-newContentTitle' => "Content's title already exists in the current course.."
            ]);

        $content = new SectionContent;
        $content->section_id = $validated['section_id'];
        $content->title = $validated['section-' . $validated['section_id'] . '-newContentTitle'];
        $content->save();

        $message = 'Section Content (' . $content->title  . ') has been added to the database';

        return redirect()->route($route, $section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }

    // Shows the Add Content (update content) page.
    public function edit($id) {
        $content = SectionContent::findOrFail($id);

        if ($content->section->course->courseType->type == 'Course')
            $view = 'admin/online-course/create-video';
        elseif ($content->section->course->courseType->type == 'Woki')
            $view = 'admin/woki/create-video';
        elseif ($content->section->course->courseType->type == 'Bootcamp')
            $view = 'admin/bootcamp/create-video';

        return view($view, compact('content'));
    }

    // Update a specific content (based on its id) in the database.
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'attachment' => 'mimes:pps,ppt,pptx,xls,xlsm,xlsx,doc,docx,pdf',
            'title' => 'required|alpha_spaces',
            'youtube_link' => 'required|starts_with:https://www.youtube.com/embed/',
            'description' => 'required',
            'duration' => 'required|integer|min:1'
        ]);

        $content = SectionContent::findOrFail($id);

        if ($content->section->course->courseType->type == 'Course')
            $route = 'admin.online-courses.edit';
        elseif ($content->section->course->courseType->type == 'Woki')
            $route = 'admin.woki-courses.edit';
        elseif ($content->section->course->courseType->type == 'Bootcamp')
            $route = 'admin.bootcamp.edit';

        // Checks if sectionContent is unique in course level.
        //$isSectionContentTitleUnique = CourseHelper::isSectionContentTitleUniqueByCourseObjectAndTitle($content->section->course, $validated['title']);
        //if (!$isSectionContentTitleUnique)
            //return redirect()->back()->withErrors([
                //'title' => "Content's title already exists in the current course.."
            //]);

        $content->title = $validated['title'];
        $content->youtube_link = $validated['youtube_link'];
        $content->description = $validated['description'];
        $content->duration = $validated['duration'];
        $content->save();

        if ($request->has('attachment')) {
            if (!is_null($content->attachment)) unlink($content->attachment);
            $content->attachment = Helper::storeFile($request->file('attachment'), 'storage/documents/section-contents/');
            $content->save();
        }

        $updateTotalDurationResults = CourseHelper::updateTotalDuration($content->section->course->id);

        if ($content->wasChanged()) {
            $message = "Section's Content (" . $content->title  . ') has been updated';
        } else {
            $message = "No changes detected to Section's Content(" . $content->title . ")";
        }

        return redirect()->route($route, $content->section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }

    // Deletes a specific content (based on its id).
    public function destroy($id) {
        $content = SectionContent::findOrFail($id);

        if (!is_null($content->attachment))
            unlink($content->attachment);
        
        $content->delete();

        $updateTotalDurationResults = CourseHelper::updateTotalDuration($content->section->course->id);

        $message = 'Content (' . $content->title  . ') has been deleted from the database';

        if ($content->section->course->courseType->type == 'Course')
            $route = 'admin.online-courses.edit';
        elseif ($content->section->course->courseType->type == 'Woki')
            $route = 'admin.woki-courses.edit';
        elseif ($content->section->course->courseType->type == 'Bootcamp')
            $route = 'admin.bootcamp.edit';

        return redirect()->route($route, $content->section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }

    // Remove an attachment from an existing Course's Section-Content.
    public function removeAttachment($id) {
        $content = SectionContent::findOrFail($id);

        if (!is_null($content->attachment)) {
            unlink($content->attachment);
            $content->attachment = null;
            $content->save();
        }

        $message = 'Attachment in Content (' . $content->title  . ') has been deleted from the database';

        return redirect()->route('admin.section-contents.edit', $content->id)
            ->with('message', $message);
    }
}
