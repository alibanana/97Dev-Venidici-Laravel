<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Course;

/*
|--------------------------------------------------------------------------
| Client OnlineCourseController Class.
|
| Description:
| This controller class is responsible in handling pages which prefixes (urls)
| include /online-course (excluding admin pages).
|--------------------------------------------------------------------------
*/ 
class OnlineCourseController extends Controller
{
    // Shows the Client's Main Online-Course Page.
    public function index() {
        if (Auth::check()) {
            $cart_count = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->count();

            return view('client/online-course/index', compact('cart_count'));
        } else {
            return view('client/online-course/index');
        }
    }

    // Shows the details for each course.
    public function show($id){
        $course = Course::findOrFail($id);
        $cart_count = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->count();

        return view('client/online-course/detail', compact('course','cart_count'));
    }
}
