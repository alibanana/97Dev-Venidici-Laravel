<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KrestProgram;
use App\Helper\Helper;


class KrestProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $programs = new KrestProgram;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $programs = $programs->orderBy('created_at', 'desc');
            } else {
                $programs = $programs->orderBy('created_at');
            }
        } else {
            $programs = $programs->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.krest_programs.index', request()->except('search'));
                return redirect($url);
            } else {
                $programs = $programs->where('program', 'like', "%".$request->search."%");
            }
        }

        $programs = $programs->get();

        return view('admin/krest/krest-program/index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/krest/krest-program/create');
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
            'program' => 'required',
            'category' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
        ]);

        $program = new KrestProgram;
        $program->program = $validated['program'];
        $program->category = $validated['category'];
        $program->description = $validated['description'];
        $program->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/krest-programs/');
        $program->save();

        return redirect()->route('admin.krest_programs.index')->with('message', 'New Program has been added!');
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
        $program = KrestProgram::findOrFail($id);

        return view('admin/krest/krest-program/update', compact('program'));
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
            'program' => 'required',
            'category' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
        ]);
        
        $program = KrestProgram::findOrFail($id);
        $program->program = $validated['program'];
        $program->category = $validated['category'];
        $program->description = $validated['description'];
        
        if ($request->has('thumbnail')) {
            if($program->thumbnail)
                unlink($program->thumbnail);
            $program->thumbnail = Helper::storeImage($request->file('thumbnail'), 'storage/images/krest-programs/');
        }
        
        $program->save();

        if ($program->wasChanged()) {
            $message = 'Krest Program (' . $program->program . ') has been updated!';
        } else {
            $message = 'No changes was made to Hashtag (' . $program->program . ')';
        }

        return redirect()->route('admin.krest_programs.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = KrestProgram::findOrFail($id);
        if($program->thumbnail)
            unlink($program->thumbnail);

        $program->delete();

        return redirect()->route('admin.krest_programs.index')->with('message', 'Krest Program has been deleted from the database!');
    }
}
