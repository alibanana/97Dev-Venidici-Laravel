<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseFeature;

class BootcampFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'feature'   => 'required',
        ]);

        $new_feature = new CourseFeature;
        $new_feature->course_id = $course_id;
        $new_feature->title     = $validated['title'];
        $new_feature->feature   = $validated['feature'];
        $new_feature->save();

        $message = 'New Schedule (' . $new_feature->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'bootcamp-feature-page');
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
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required',
            'feature'               => 'required',
            'bootcamp_feature_id'   => 'required',
        ]);

        $feature            = CourseFeature::findOrFail($validated['bootcamp_feature_id']);
        $feature->title     = $validated['title'];
        $feature->feature   = $validated['feature'];
        $feature->save();

        $message = 'Bootcamp Feature (' . $feature->title . ') has been updated.';
        return redirect()->route('admin.bootcamp.edit', $feature->course_id)
            ->with('message', $message)
            ->with('page-option', 'bootcamp-feature-page');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature = CourseFeature::findOrFail($id);
        $feature->delete();

        $message = 'Bootcamp Feature (' . $feature->title . ') has been deleted.';
        return redirect()->route('admin.bootcamp.edit', $feature->course_id)
            ->with('message', $message)
            ->with('page-option', 'bootcamp-feature-page');        
    }
}
