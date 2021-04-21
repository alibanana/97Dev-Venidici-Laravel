<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TrustedCompany;
use App\Models\FakeTestimony;

/*
|--------------------------------------------------------------------------
| Admin HomepageController Class.
|
| Description:
| This controller is responsible in handling the admin's CMS homepage pages.
|--------------------------------------------------------------------------
*/ 
class HomepageController extends Controller
{
    // Shows the Admin CMS Homepage Page.
    public function index() {
        $trusted_companies = TrustedCompany::all();

        $fake_testimonies = FakeTestimony::orderByRaw('CHAR_LENGTH(content) DESC')->get();
        $fake_testimonies_big = $fake_testimonies->whereNotNull('thumbnail')->whereNotNull('name')->whereNotNull('occupancy')->values();
        $fake_testimonies_small = $fake_testimonies->whereNull('thumbnail')->whereNull('name')->whereNull('occupancy')->values();

        return view('admin/cms/homepage', compact('trusted_companies', 'fake_testimonies_big',  'fake_testimonies_small'));
    }
}
