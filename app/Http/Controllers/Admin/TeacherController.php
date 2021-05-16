<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Shows the Admin Teachers Page
    public function index() {
        return view('admin/teacher/index');
    }
}
