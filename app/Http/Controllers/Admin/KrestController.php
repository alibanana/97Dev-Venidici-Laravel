<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Krest;

/*
|--------------------------------------------------------------------------
| Admin KrestController Class.
|
| Description:
| This controller is responsible in handling the admin's Krest Applicants
| page and any additional function related to it.
|--------------------------------------------------------------------------
*/
class KrestController extends Controller
{
    // Shows the Admin Krest Applicants page.
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

    // Updates the Applicant's Status in the database.
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
}
