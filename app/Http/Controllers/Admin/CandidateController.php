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
}
