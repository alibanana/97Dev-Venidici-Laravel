<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FakeTestimony;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Client PagesController Class.
|
| Description:
| This controller class is responsible to handle client pages that does not
| have any other requests method types other than GET methods in their pages.
|--------------------------------------------------------------------------
*/ 
class PagesController extends Controller
{
    // Show the main landing page of the app.
    public function index() {
        $fake_testimonies = FakeTestimony::orderByRaw('CHAR_LENGTH(content) DESC')->get();
        $fake_testimonies_big = $fake_testimonies->whereNotNull('thumbnail')->whereNotNull('name')->whereNotNull('occupancy')->values();
        $fake_testimonies_small = $fake_testimonies->whereNull('thumbnail')->whereNull('name')->whereNull('occupancy')->values();

        return view('client/index', compact('fake_testimonies_big', 'fake_testimonies_small'));
    }

    public function autocomplete(Request $request){
        $datas = User::select('name')
                        ->where("name","LIKE","%{$request->terms}%")
                        ->get();
        return response()->json($datas);
    }
}
