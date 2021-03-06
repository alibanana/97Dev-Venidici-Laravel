<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseFeature;
use App\Helper\Helper;

use Illuminate\Support\Facades\Validator;

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
        if(CourseFeature::where('course_id',$course_id)->count() >= 3)
            return redirect()->back()
            ->with('message', 'Maksimum Quantity has been reached!')
            ->with('page-option', 'bootcamp-feature-page');
            
        $validator = Validator::make($request->all(), [
            'icon'          => 'required',
            'title'         => 'required',
            'feature'       => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'bootcamp-feature-page'])->withErrors($validator);

        $validated = $validator->validate();

        $new_feature = new CourseFeature;
        $new_feature->course_id = $course_id;
        if ($request->has('icon')) 
            $new_feature->icon = Helper::storeImage($request->file('icon'), 'storage/images/bootcamp/icons/');
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
        if ($request->has('icon')) {
            if($feature->icon != null)
                unlink($feature->icon);
            $feature->icon = Helper::storeImage($request->file('icon'), 'storage/images/bootcamp/icons/');
        }
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
