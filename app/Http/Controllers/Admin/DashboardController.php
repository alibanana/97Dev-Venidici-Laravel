<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Course;
use App\Models\Krest;
use App\Models\Invoice;
use App\Models\Order;
use Carbon\Carbon;

use App\Models\UserDetail;
use App\Models\Hashtag;

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
        $users_count = User::all()->count();
        $courses_count = Course::where('course_type_id', 1)->get()->count();
        $wokis_count = Course::where('course_type_id', 2)->get()->count();
        $applicants_count = Krest::all()->count();

        // start of online course data
        $today_online_course_sold = Order::
            whereHas('course', function ($query) {
                $query->where('course_type_id', '1');
            })->whereHas('invoice', function ($query){
                $query->where('status', 'paid')->orWhere('status','completed');
            })->whereDate('updated_at', Carbon::now()->setTimezone('Asia/Jakarta'))
            ->get();

        $today_online_course_sold_qty = count($today_online_course_sold);
        $today_online_course_earnings = 0;
        foreach($today_online_course_sold as $course){
            $today_online_course_earnings +=  $course->price;
        }
        

        $total_online_course_sold = Order::
            whereHas('course', function ($query){
                $query->where('course_type_id', '1');
            })->whereHas('invoice', function ($query){
                $query->where('status', 'paid')->orWhere('status','completed');
            })->get();
        
        $total_online_course_sold_qty = count($total_online_course_sold);
        $total_online_course_earnings = 0;
        foreach($total_online_course_sold as $course){
            $total_online_course_earnings +=  $course->price;
        }
        //end of online course data

        //start of woki data
        $today_woki_sold = Order::
        whereHas('course', function ($query){
        $query->where('course_type_id', '2');
            })
        ->whereHas('invoice', function ($query){
            $query->where('status', 'paid')->orWhere('status','completed');
                })->whereDate('updated_at',Carbon::now()->setTimezone('Asia/Jakarta'))->get();

        $today_woki_sold_qty = 0;
        $today_woki_earnings = 0;
        foreach($today_woki_sold as $course){
            $today_woki_earnings +=  $course->price;
            $today_woki_sold_qty +=  $course->qty;
        }
        

        $total_woki_sold = Order::
            whereHas('course', function ($query){
            $query->where('course_type_id', '2');
                })
            ->whereHas('invoice', function ($query){
                $query->where('status', 'paid')->orWhere('status','completed');
                    })->get();
        
        $total_woki_sold_qty = 0;
        $total_woki_earnings = 0;
        foreach($total_woki_sold as $course) {
            $total_woki_earnings +=  $course->price;
            $total_woki_sold_qty +=  $course->qty;
        }
        //end of woki data

        return view('admin/index', compact('users_count', 'courses_count', 'wokis_count', 'applicants_count',
            'today_online_course_sold_qty', 'today_online_course_earnings', 'total_online_course_sold_qty', 'total_online_course_earnings',
            'today_woki_sold_qty', 'today_woki_earnings', 'total_woki_sold_qty', 'total_woki_earnings'
        ));
    }

    public function signUpGeneralInfoIndex(){
    
        return view('admin/auth/signup');
    }

    public function signUpInterestIndex(Request $request){

        

        $interests = Hashtag::all();


        return view('admin/auth/signup-interests' , compact('interests'));

    }
}
