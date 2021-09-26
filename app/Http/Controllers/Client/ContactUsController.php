<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactUs;

class ContactUsController extends Controller
{
    // Stores new Contact-Us applications in the database.
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
}
