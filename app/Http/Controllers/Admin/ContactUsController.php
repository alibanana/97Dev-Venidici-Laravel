<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ContactUs;

class ContactUsController extends Controller
{
    // Shows the Contact-Us applications list admin page.
    public function index(Request $request) {
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

    // Deletes a Contact-Us Application data in the database.
    public function destroy($id) {
        $contact_us = ContactUs::findOrFail($id);
        $contact_us->delete();
        $message = 'Contact (' . $contact_us->name . ') has been deleted.';
        return redirect()->route('admin.contact-us.index')->with('message', $message);
    }
}
