<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampFutureCareer;
use Illuminate\Support\Facades\Validator;

class BootcampFutureCareerController extends Controller
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
        if(BootcampFutureCareer::where('course_id',$course_id)->count() >= 3)
            return redirect()->back()
            ->with('message', 'Maksimum Quantity has been reached!')
            ->with('page-option', 'future-career-page');
            
        $validator = Validator::make($request->all(), [
            'thumbnail'     => 'required|mimes:jpeg,jpg,png|max:5000',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'future-career-page'])->withErrors($validator);

        $validated = $validator->validate();

        $career = new BootcampFutureCareer();
        $career->course_id     = $course_id;
        $career->thumbnail     = Helper::storeImage($request->file('thumbnail'), 'storage/images/bootcamp/future-careers/');
        $career->title         = $validated['title'];
        $career->description   = $validated['description'];
        $career->save();

        $message = 'New career (' . $career->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'future-career-page');
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
            'thumbnail'     => 'mimes:jpeg,jpg,png|max:5000',

        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'future-career-page'])->withErrors($validator);

        $validated = $validator->validate();

        $career = BootcampFutureCareer::findOrFail($id);
        $career->title        = $validated['title'];
        $career->description  = $validated['description'];


        if ($request->has('thumbnail')) {
            unlink($career->thumbnail);
            $career->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/bootcamp/future-careers/');
        }
        
        $career->save();


        if ($career->wasChanged()) {
            $message = 'Career (' . $career->title . ') has been updated.';
        } else {
            $message = 'No changes was made to Career (' . $career->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $career->course_id)
            ->with('message', $message)
            ->with('page-option', 'future-career-page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = BootcampFutureCareer::findOrFail($id);
        unlink($career->thumbnail);
        $career->delete();

        $message = 'Career (' . $career->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $career->course_id)
            ->with('message', $message)
            ->with('page-option', 'future-career-page');
    }
    
}
