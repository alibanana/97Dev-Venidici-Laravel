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
        $benefits = new BootcampBenefit;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $benefits = $benefits->orderBy('created_at', 'desc');
            } else {
                $benefits = $benefits->orderBy('created_at');
            }
        } else {
            $benefits = $benefits->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.benefits.index', request()->except('search'));
                return redirect($url);
            } else {
                $benefits = $benefits->where('name', 'like', "%".$request->search."%");
            }
        }

        $benefits = $benefits->get();

        return view('admin/bootcampbenefit/index', compact('benefits'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
        ]);

        $benefit = new BootcampBenefit();
        $benefit->course_id     = $id;
        $benefit->title         = $validated['title'];
        $benefit->description   = $validated['description'];
        $benefit->save();

        $message = 'New benefit (' . $benefit->title . ') has been added to the database.';

        return redirect()->route('admin.bootcamp.edit', $id)
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

        return redirect()->route('admin.bootcamp.edit', $benefit->course->id)
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
        $benefit = BootcampBenefit::where('course_id',$id)->first();
        $benefit->delete();

        $message = 'benefit (' . $benefit->title . ') has been deleted.';
        
        return redirect()->route('admin.bootcamp.edit', $id)
            ->with('message', $message)
            ->with('page-option', 'benefit-page');
    }
}
