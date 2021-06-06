<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Collaborator;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaborators = new Collaborator;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $collaborators = $collaborators->orderBy('created_at', 'desc');
            } else {
                $collaborators = $collaborators->orderBy('created_at');
            }
        } else {
            $collaborators = $collaborators->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.collaborators.index', request()->except('search'));
                return redirect($url);
            } else {
                $collaborators = $collaborators
                ->where('name', 'like', "%".$request->search."%")
                ->orWhere('email', 'like', "%".$request->search."%")
                ->orWhere('collaborator_partnership', 'like', "%".$request->search."%")
                ;
            }
        }

        $collaborators = $collaborators->get();

        return view('admin/', compact('collaborators'));
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
            'name'                          => 'required',
            'institution'                   => 'required|email',
            'collaborator_partnership'      => 'required',
            'email'                         => 'required',
            'whatsapp'                      => 'required',
            'notes'                         => 'required',
        ]);

        if($validated->fails()) return redirect('/#')->withErrors($validated);

        $collaborator = new Collaborator();
        $collaborator->name                         = $request->name;
        $collaborator->institution                  = $request->institution;
        if($input['institution_socmed'] != null)
        $collaborator->institution_socmed           = $request->institution_socmed;
        $collaborator->collaborator_partnership     = $request->collaborator_partnership;
        $collaborator->email                        = $request->email;
        $collaborator->whatsapp                     = $request->whatsapp;
        $collaborator->notes                        = $request->notes;
        
        $collaborator->save();

        $message = "Thank you for applying! We'll get back tou you as soon as possible";

        return redirect('/#')->with('message', $message);
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
        $collaborator = Collaborator::findOrFail($id);
        $collaborator->delete();

        $message = 'collaborator (' . $collaborator->name . ') has been deleted.';
        
        return redirect()->route('admin.collaborators.index')->with('message', $message);
    }
}
