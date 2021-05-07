<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Admin AssessmentController Class.
|
| Description:
| This controller is responsible in handling the admin's assessments pages
| and methods related to it.
|--------------------------------------------------------------------------
*/
class AssessmentController extends Controller
{
    // Shows the Admin Assestments Page
    public function index() {
        return view('admin/assessment/index');
    }
}
