<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validated = Validator::make($request->all(), [
            'section_id' => 'bail|required|integer',
            'section-' . $request->section_id . '-newContentTitle' => 'required'
        ])->setAttributeNames([
            'section-' . $request->section_id . '-newContentTitle' => 'content-title'
        ])->validate();

        // Validates if section exists
        $section = Section::findOrFail($validated['section_id']);

        $content = new SectionContent;
        $content->section_id = $validated['section_id'];
        $content->title = $validated['section-' . $validated['section_id'] . '-newContentTitle'];
        $content->save();

        $message = 'Section (' . $section->title  . ') has been added to the database';

        return redirect()->route('admin.online-courses.edit', $section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }

    // Shows the Add Content (update content) page.
    public function edit($id) {
        $content = SectionContent::findOrFail($id);

        return view('admin/online-course/create-video', compact('content'));
    }

    // Update a specific content (based on its id) in the database.
    public function update(Request $request, $id) {
        $validated = $request->validate([
            // Add validations here
        ]);

        $content = SectionContent::findOrFail($id);

        if ($content->wasChanged()) {
            $message = "Section's Content (" . $content->title  . ') has been updated';
        } else {
            $message = "No changes detected to Section's Content(" . $content->title . ")";
        }

        return redirect()->route('admin.online-courses.edit', $content->section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }

    // Deletes a specific content (based on its id).
    public function destroy($id) {
        $content = SectionContent::findOrFail($id);

        if (!is_null($content->attachment)) { unlink($content->attachment); }
        $content->delete();

        $message = 'Content (' . $content->title  . ') has been deleted from the database';

        return redirect()->route('admin.online-courses.edit', $content->section->course->id)
            ->with('message', $message)
            ->with('page-option', 'manage-curriculum');
    }
}
