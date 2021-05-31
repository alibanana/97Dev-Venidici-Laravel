<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Krest;

class KrestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applicants = new Krest;

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
                $url = route('admin.krest.index', request()->except('search'));
                return redirect($url);
            } else {
                $applicants = $applicants->where('name', 'like', "%".$request->search."%");
            }
        }

        $applicants = $applicants->get();
        return view('admin/krest/applicant/index', compact('applicants'));

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
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);
        
        $applicant = Krest::findOrFail($id);
        $applicant->status = $validated['status'];
        $applicant->save();

        if ($applicant->wasChanged()) {
            $message = 'Applicant Status  (' . $applicant->name . ') has been updated!';
        } else {
            $message = 'No changes was made to Applicant (' . $applicant->name . ')';
        }

        return redirect()->route('admin.krest.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
