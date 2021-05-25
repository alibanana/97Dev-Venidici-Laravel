<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\Teacher;

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
            $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

            return view('client/online-course/index', compact('cart_count','transactions'));
        } else {
            return view('client/online-course/index');
        }
    }

    // Shows the details for each course.
    public function show($id){
        $course = Course::findOrFail($id);
        if(Auth::check()) {
            $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
            $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return view('client/online-course/detail', compact('course','cart_count','transactions'));
        } else {
            $transactions=null;
            $cart_count=0;
            return view('client/online-course/detail', compact('course','cart_count','transactions'));
        }
    }

    public function learn()
    {
        $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
        $transactions = Invoice::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('client/online-course/learn', compact('cart_count','transactions'));
    }
}
