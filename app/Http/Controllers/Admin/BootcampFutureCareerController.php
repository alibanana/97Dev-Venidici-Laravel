<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Models\BootcampFutureCareer;

class BootcampFutureCareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = new BootcampFutureCareer;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $careers = $careers->orderBy('created_at', 'desc');
            } else {
                $careers = $careers->orderBy('created_at');
            }
        } else {
            $careers = $careers->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.careers.index', request()->except('search'));
                return redirect($url);
            } else {
                $careers = $careers->where('name', 'like', "%".$request->search."%");
            }
        }

        $careers = $careers->get();

        return view('admin/bootcampfuturecareer/index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/bootcampfuturecareer/create');
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
            'thumbnail'     => 'required|image|mimes:jpeg,jpg,png|max:5000',
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $career = new BootcampFutureCareer();
        $career->course_id     = $id;
        $career->thumbnail     = Helper::storeImage($request->file('thumbnail'), 'storage/images/future-careers/');
        $career->title         = $validated['title'];
        $career->description   = $validated['description'];
        $career->save();

        $message = 'New career (' . $career->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $id)
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
        $validated = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
        ]);
        if ($request->has('thumbnail')) {
            unlink($course->thumbnail);
            $course->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/bootcamp/');
        }

        $career = BootcampFutureCareer::findOrFail($id);
        $career->thumbnail    = $validated['thumbnail'];
        $career->title        = $validated['title'];
        $career->description  = $validated['description'];
        
        $course->save();

        if ($career->wasChanged()) {
            $message = 'career (' . $career->title . ') has been updated.';
        } else {
            $message = 'No changes was made to career (' . $career->title . ')';
        }

        return redirect()->route('admin.bootcamp.edit', $career->course->id)
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
        $career = BootcampFutureCareer::where('course_id',$id)->first();
        unlink($career->thumbnail);
        $career->delete();

        $message = 'career (' . $career->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'future-career-page');
    }
    
}
