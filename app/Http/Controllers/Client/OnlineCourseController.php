<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Invoice;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\SectionContent;
use App\Models\Assessment;
use App\Models\Notification;
use App\Models\CourseCategory;
use App\Models\Review;

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
    public function index(Request $request) {
        $course_categories = CourseCategory::all();
        $courses = new Course;
        if ($request->has('cat')) {
            if ($request['cat'] == "Featured") {
                $courses = $courses->orderBy('created_at', 'desc');
            } else {
                $courses = $courses->where('course_category_id',$request['cat'])->orderBy('created_at','desc');
            }
        } else {
            $courses = $courses->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('online-course.index', request()->except('search'));
                return redirect($url);            
            } else {
                $search = $request->search;

                $courses = $courses->where(function ($query) use ($search) {
                    $query->where([['title', 'like', "%".$search."%"]])
                    ->orWhere([['subtitle', 'like', "%".$search."%"]]);
                });
            }
        }
        $courses = $courses->get();
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();

        if (Auth::check()) {
            $cart_count = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->count();
            $transactions = Notification::where(
            [   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0],
                
            ]
        )->orderBy('created_at', 'desc')->get();
            return view('client/online-course/index', compact('cart_count','transactions','courses','course_categories','informations'));
        } else {
            return view('client/online-course/index',compact('course_categories','courses','informations'));
        }
    }

    // Shows the details for each course.
    public function show($id){
        $course = Course::findOrFail($id);
        $reviews = Review::where('course_id',$id)->orderBy('created_at', 'desc')->get();
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();

        if(Auth::check()) {
            $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
            $transactions = Notification::where(
            [   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0],
                
            ]
            )->orderBy('created_at', 'desc')->get();
            return view('client/online-course/detail', compact('course','cart_count','transactions','reviews','informations'));
        } else {
            $transactions=null;
            $cart_count=0;
            return view('client/online-course/detail', compact('course','cart_count','transactions','reviews','informations'));
        }
    }

    public function learn($course_id, $section_content_id)
    {   
        $cart_count = Cart::with('course')
            ->where('user_id', auth()->user()->id)
            ->count();
        
        $transactions = Notification::where(
            [   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0],
                
            ]
        )->orderBy('created_at', 'desc')->get();   
        
        $course = auth()->user()->courses()->where('user_course.course_id', $course_id)->firstOrFail();
        $sections = $course->sections;
        $assessment = $course->assessment;
        $content = SectionContent::findOrFail($section_content_id);
        $informations = Notification::where('isInformation', 1)->orderBy('created_at','desc')->get();

        return view('client/online-course/learn', compact('cart_count','transactions', 'course', 'sections', 'content', 'assessment', 'informations'));
    }
    
    
}
