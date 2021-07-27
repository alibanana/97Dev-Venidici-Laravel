<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampBenefit;

class BootcampBenefitController extends Controller
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
        return view('admin/bootcampbenefit/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $benefit = new BootcampBenefit();
        $benefit->course_id     = $course_id;
        $benefit->title         = $validated['title'];
        $benefit->description   = $validated['description'];
        $benefit->save();

        $message = 'New benefit (' . $benefit->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'benefit-page');
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
        $benefit = BootcampBenefit::findOrFail($id);
        $benefit->title        = $validated['title'];
        $benefit->description  = $validated['description'];
        
        $benefit->save();

        if ($benefit->wasChanged()) {
            $message = 'Schedule (' . $benefit->title . ') has been updated.';
        } else {
            $message = 'No changes was made to Schedule (' . $benefit->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $benefit->course_id)
            ->with('message', $message)
            ->with('page-option', 'benefit-page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $benefit = BootcampBenefit::findOrFail($id);
        $benefit->delete();

        $message = 'benefit (' . $benefit->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $benefit->course_id)
            ->with('message', $message)
            ->with('page-option', 'benefit-page');
    }
}
