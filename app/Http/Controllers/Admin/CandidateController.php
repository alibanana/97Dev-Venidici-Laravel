<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    // Shows the admin job portal's candidates list page.
    public function index() {
        return view('admin/job-portal/candidates');
    }

    // Shows the candidate's detail page.
    public function showCandidate(){
        return view('admin/job-portal/candidate-profile');
    }

    // Shows the candidate's changes detail page.
    public function showCandidateChange(){
        return view('admin/job-portal/candidate-profile');
    }
}
