<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampCandidate;
use Illuminate\Support\Facades\Validator;

class BootcampCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'candidate-page'])->withErrors($validator);

        $validated = $validator->validate();


        $candidate = new BootcampCandidate();
        $candidate->course_id     = $course_id;
        $candidate->title         = $validated['title'];
        $candidate->description   = $validated['description'];
        $candidate->save();

        $message = 'New candidate (' . $candidate->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'candidate-page');
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
        //
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
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'candidate-page'])->withErrors($validator);

        $validated = $validator->validate();

        $candidate = BootcampCandidate::findOrFail($id);
        $candidate->title        = $validated['title'];
        $candidate->description  = $validated['description'];
        
        $candidate->save();

        if ($candidate->wasChanged()) {
            $message = 'Future Candidate (' . $candidate->title . ') has been updated.';
        } else {
            $message = 'No changes was made to Schedule (' . $candidate->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $candidate->course_id)
            ->with('message', $message)
            ->with('page-option', 'candidate-page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = BootcampCandidate::findOrFail($id);
        $candidate->delete();

        $message = 'Future Candidate (' . $candidate->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $candidate->course_id)
            ->with('message', $message)
            ->with('page-option', 'candidate-page');
    }
}
