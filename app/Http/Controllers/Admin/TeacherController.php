<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\Teacher;

/*
|--------------------------------------------------------------------------
| Admin TeacherController Class.
|
| Description:
| This controller is responsible in handling the admin's teachers pages
| and methods related to it.
|--------------------------------------------------------------------------
*/
class TeacherController extends Controller
{
    // Shows the Admin Teachers Page
    public function index(Request $request) {
        $teachers = new Teacher;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $teachers = $teachers->orderBy('created_at', 'desc');
            } else {
                $teachers = $teachers->orderBy('created_at');
            }
        } else {
            $teachers = $teachers->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.teachers.index', request()->except('search'));
                return redirect($url);
            } else {
                $teachers = $teachers->where('name', 'like', "%".$request->search."%");
            }
        }

        $teachers = $teachers->get();

        return view('admin/teacher/index', compact('teachers'));
    }

    // Shows the page to create new Teachers.
    public function create() {
        return view('admin/teacher/create');
    }

    // Store new teacher in the database.
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
            'company_logo' => 'mimes:jpeg,jpg,png',
            'occupancy' => '',
        ]);

        $teacher = new Teacher();
        $teacher->name = $validated['name'];
        $teacher->description = $validated['description'];
        $teacher->image = Helper::storeImage($request->file('image'), 'storage/images/teachers/');
        $teacher->occupancy = $validated['occupancy'];

        if ($request->has('company_logo')) 
            $teacher->company_logo = Helper::storeImage($request->file('company_logo'), 'storage/images/teachers/company_logo/');
        $teacher->save();

        $message = 'New Teacher (' . $teacher->name . ') has been added to the database.';

        return redirect()->route('admin.teachers.index')->with('message', $message);
    }

    // Shows the Admin Update Teacher Page
    public function edit($id) {
        $teacher = Teacher::findOrFail($id);

        return view('admin/teacher/update', compact('teacher'));
    }

    // Updates an existing teacher in the database.
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
            'company_logo' => 'mimes:jpeg,jpg,png',
            'occupancy' => '',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->name = $validated['name'];
        $teacher->description = $validated['description'];
        $teacher->occupancy = $validated['occupancy'];


        if ($request->has('image')) {
            if($teacher->image != null)
                unlink($teacher->image);
            $teacher->image = Helper::storeImage($request->file('image'), 'storage/images/teachers/');
        }
        if ($request->has('company_logo')) {
            if($teacher->company_logo != null)
                unlink($teacher->company_logo);
            $teacher->company_logo = Helper::storeImage($request->file('company_logo'), 'storage/images/teachers/company_logo/');
        }
        
        $teacher->save();

        if ($teacher->wasChanged()) {
            $message = 'Teacher (' . $teacher->name . ') has been updated.';
        } else {
            $message = 'No changes was made to Teacher (' . $teacher->name . ')';
        }

        return redirect()->route('admin.teachers.index')->with('message', $message);
    }

    // Delete an existing teacher by ID.
    public function destroy($id) {
        $teacher = Teacher::findOrFail($id);
        unlink($teacher->image);
        $teacher->delete();

        $message = 'Teacher (' . $teacher->name . ') has been deleted.';
        
        return redirect()->route('admin.teachers.index')->with('message', $message);
    }
}
