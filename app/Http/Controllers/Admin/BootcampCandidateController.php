<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampCandidate;

class BootcampBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = new BootcampCandidate;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $candidates = $candidates->orderBy('created_at', 'desc');
            } else {
                $candidates = $candidates->orderBy('created_at');
            }
        } else {
            $candidates = $candidates->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.candidates.index', request()->except('search'));
                return redirect($url);
            } else {
                $candidates = $candidates->where('name', 'like', "%".$request->search."%");
            }
        }

        $candidates = $candidates->get();

        return view('admin/bootcampcandidate/index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/bootcampcandidate/create');
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
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $candidate = new BootcampCandidate();
        $candidate->course_id     = $id;
        $candidate->title         = $validated['title'];
        $candidate->description   = $validated['description'];
        $candidate->save();

        $message = 'New candidate (' . $candidate->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $id)
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
        $validated = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
        ]);
        $candidate = BootcampCandidate::findOrFail($id);
        $candidate->title        = $validated['title'];
        $candidate->description  = $validated['description'];
        
        $candidate->save();

        if ($candidate->wasChanged()) {
            $message = 'Schedule (' . $candidate->title . ') has been updated.';
        } else {
            $message = 'No changes was made to Schedule (' . $candidate->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $candidate->course->id)
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
        $candidate = BootcampCandidate::where('course_id',$id)->first();
        $candidate->delete();

        $message = 'candidate (' . $candidate->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'candidate-page');
    }
}
