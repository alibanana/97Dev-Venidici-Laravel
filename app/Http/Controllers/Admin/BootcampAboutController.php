<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BootcampDescription;
use App\Helper\Helper;
use Illuminate\Support\Facades\Validator;

class BootcampAboutController extends Controller
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
        if(BootcampDescription::where('course_id',$course_id)->count() >= 5)
            return redirect()->back()
            ->with('message', 'Maksimum Quantity has been reached!')
            ->with('page-option', 'bootcamp-about-page');

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'image'         => 'required',
            'description'   => 'required',
        ]);
        

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'bootcamp-about-page'])->withErrors($validator);

        $validated = $validator->validate();

        $new_about              = new BootcampDescription;
        $new_about->course_id   = $course_id;
        $new_about->title       = $validated['title'];
        $new_about->image       = Helper::storeImage($request->file('image'), 'storage/images/bootcamp/about/');

        $new_about->description   = $validated['description'];
        $new_about->save();

        $message = 'New Schedule (' . $new_about->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'bootcamp-about-page');
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
    public function edit($about_id)
    {
        $about = BootcampDescription::findOrFail($about_id);

        $view = 'admin/bootcamp/update-bootcamp-about';

        return view($view, compact('about'));
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
            'image'         => 'mimes:jpeg,jpg,png',
        ]);

        $about                 = BootcampDescription::findOrFail($id);
        $about->title          = $validated['title'];
        $about->description    = $validated['description'];

        if ($request->has('image')) {
            unlink($about->image);
            $about->image = Helper::storeImage($request->file('image'), 'storage/images/bootcamp/about/');
        }

        $about->save();

        $message = 'Bootcamp About (' . $about->title . ') has been updated.';
        return redirect()->route('admin.bootcamp.edit', $about->course_id)
            ->with('message', $message)
            ->with('page-option', 'bootcamp-about-page');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = BootcampDescription::findOrFail($id);
        $about->delete();

        $message = 'Bootcamp About (' . $about->title . ') has been deleted.';
        return redirect()->route('admin.bootcamp.edit', $about->course_id)
            ->with('message', $message)
            ->with('page-option', 'bootcamp-about-page');   
    }
}
