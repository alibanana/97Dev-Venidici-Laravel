<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Admin PagesController Class.
|
| Description:
| This controller is responsible in handling the admin's dashboard pages.
|--------------------------------------------------------------------------
*/ 
class DashboardController extends Controller
{
    // Shows the Admin Dashboard Page 
    public function index() {

        $users = User::all();

        $users_count = $users->count();

        return view('admin/index', compact('users_count'));
    }
}
