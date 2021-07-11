<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;   
use App\Helper\Helper;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applicants = new Instructor;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $applicants = $applicants->orderBy('created_at', 'desc');
            } else {
                $applicants = $applicants->orderBy('created_at');
            }
        } else {
            $applicants = $applicants->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.instructors.index', request()->except('search'));
                return redirect($url);
            } else {
                $applicants = $applicants
                ->where('name', 'like', "%".$request->search."%")
                ->orWhere('email', 'like', "%".$request->search."%")
                ->orWhere('company', 'like', "%".$request->search."%")
                ;
            }
        }

        $applicants = $applicants->get();

        return view('admin/menjadi_pengajar', compact('applicants'));
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
    public function store(Request $request)
    {
        $input = $request->all();
        $validated = Validator::make($input,[
            'name'                      => 'required',
            'email'                     => 'required|email',
            'phone'                     => 'required',
            'linkedIn'                  => 'required',
            'address'                   => 'required',
            'education'                 => 'required',
            'university'                => 'required',
            'instructor_position_id'    => 'required',
            'salary'                    => 'required',
        ]);

        if($validated->fails()) return redirect('/#menjadi-pengajar')->withErrors($validated);

        $instructor = new Instructor();
        $instructor->name                       = $request->name;
        $instructor->email                      = $request->email;
        $instructor->phone                      = $request->phone;
        $instructor->linkedIn                   = $request->linkedIn;
        $instructor->address                    = $request->address;

        if($input['company'] != null)
            $instructor->company                = $request->company;

        $instructor->education                  = $request->education;
        $instructor->university                 = $request->university;
        
        if($input['job'] != null)
        $instructor->job                        = $request->job;
        
        $instructor->instructor_position_id     = $request->instructor_position_id;
        $instructor->salary                     = $request->salary;
        $instructor->cv                         = Helper::storeFile($request->file('cv'), 'storage/pengajar-cv/');
        $instructor->save();

        $message = "Thank you for applying! We'll get back tou you as soon as possible";
        return redirect('/#menjadi-pengajar')->with('menjadi_pengajar_message', $message);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        $message = 'instructor (' . $instructor->name . ') has been deleted.';
        
        return redirect()->route('admin.instructors.index')->with('message', $message);
    }
}
