<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FakeTestimony;

/*
|--------------------------------------------------------------------------
| Admin FakeTestimonyController Class.
|
| Description:
| This controller is responsible in handling the admin's fake testimonies pages.
|--------------------------------------------------------------------------
*/ 
class FakeTestimonyController extends Controller
{
    // Shows the Admin Fake Testimonies Page.
    public function index() {

        $fake_testimonies = FakeTestimony::all();

        return view('admin/testimony/index', compact('fake_testimonies'));
    }
}
