<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = new ContactUs;


        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $contacts = $contacts->orderBy('created_at', 'desc');
            } else {
                $contacts = $contacts->orderBy('created_at');
            }
        } else {
            $contacts = $contacts->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.contact-us.index', request()->except('search'));
                return redirect($url);
            } else {
                $contacts = $contacts->where('name', 'like', "%".$request->search."%");
            }
        }

        $contacts = $contacts->get();

        return view('admin/contact-us/index', compact('contacts'));
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
            'name'   => 'required',
            'email'       => 'required',
            'inquiry'       => 'required',
        ]);

        if($validated->fails()) 
            return redirect()->back()
                ->with('contact_us_error', 'Harap isi semua field')
                ->withErrors($validated)
                ->withInput($request->all());
        else 
            $validated = $validated->validate();

        $contact            = new ContactUs;
        $contact->name      = $validated['name'];
        $contact->email     = $validated['email'];
        $contact->inquiry   = $validated['inquiry'];
        $contact->save();
        $message = "Thank you for applying! We'll get back tou you as soon as possible";

        return redirect()->back()->with('contact_us_message', $message);
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
        $contact_us = ContactUs::findOrFail($id);
        $contact_us->delete();

        $message = 'Contact (' . $contact_us->name . ') has been deleted.';
        
        return redirect()->route('admin.contact-us.index')->with('message', $message);
    }
}
