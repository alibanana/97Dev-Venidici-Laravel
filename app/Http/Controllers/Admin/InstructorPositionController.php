<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstructorPosition;   

class InstructorPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $positions = new InstructorPosition;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $positions = $positions->orderBy('created_at', 'desc');
            } else {
                $positions = $positions->orderBy('created_at');
            }
        } else {
            $positions = $positions->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.instructor-positions.index', request()->except('search'));
                return redirect($url);
            } else {
                $positions = $positions->where('name', 'like', "%".$request->search."%");
            }
        }

        $positions = $positions->get();

        return view('admin/instructor-positions/index', compact('positions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/instructor-positions/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $position = new InstructorPosition();
        $position->name            = $validated['name'];
        $position->status          = 'available';
        $position->save();

        $message = 'New position (' . $position->name . ') has been added to the database.';

        return redirect()->route('admin.instructor-positions.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = InstructorPosition::findOrFail($id);

        return view('admin/instructor-positions/update',compact('position'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $position = InstructorPosition::findOrFail($id);

        $position->name            = $validated['name'];

        
        $position->save();

        if ($position->wasChanged()) {
            $message = 'position (' . $position->name . ') has been updated.';
        } else {
            $message = 'No changes was made to position (' . $position->name . ')';
        }

        return redirect()->route('admin.instructor-positions.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // Updates the Position's Status in the database.
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);
        
        $position = InstructorPosition::findOrFail($id);
        $position->status = $validated['status'];
        $position->save();

        if ($position->wasChanged()) {
            $message = 'Applicant Status  (' . $position->name . ') has been updated!';
        } else {
            $message = 'No changes was made to Applicant (' . $position->name . ')';
        }

        return redirect()->route('admin.instructor-positions.index')->with('message', $message);
    }
}
