<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCategory;

use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use App\Models\Review;
use App\Helper\Helper;
use App\Models\Course;
use App\Helper\CourseHelper;
use Carbon\Carbon;

class BootcampController extends Controller
{
    private $notifications; // Stores combined notifications data.
    private $informations; // Stores notification (isInformation == true) data.
    private $transactions; // Stores notification (isInformation == false) data for a particular user.
    private $cart_count; // Stores cart data for a particular user.

    private function resetNavbarData() {
        $navbarData = Helper::getNavbarData();
        $this->notifications = $navbarData['notifications'];
        $this->informations = $navbarData['informations'];
        $this->transactions = $navbarData['transactions'];
        $this->cart_count = $navbarData['cart_count'];
    }

    // Shows the Client's Main Bootcamp Page.
    public function index(Request $request) {
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $course_categories = CourseCategory::all();
        $courses = new Course;
        if ($request->has('cat')) {
            if ($request['cat'] == "Featured") {
                $courses = $courses->where('isFeatured',TRUE)->orderBy('created_at', 'desc');
            }
            else if($request['cat'] == "None"){
                $courses = $courses->orderBy('created_at', 'desc');
            }else {
                $courses = $courses->where('course_category_id',$request['cat'])->orderBy('created_at','desc');
            }
        } else {
            $courses = $courses->orderBy('created_at', 'desc');
        }

        if ($request->has('search')) {
            if ($request->search == "") {
                $courses = $courses->orderBy('created_at', 'desc');            
            } else {
                $search = $request->search;

                $courses = $courses->where(function ($query) use ($search) {
                    $query->where([['title', 'like', "%".$search."%"]])
                    ->orWhere([['subtitle', 'like', "%".$search."%"]]);
                });
            }
        }
        $courses = $courses->where('course_type_id',3)->where('enrollment_status', 'open')
        ->where('publish_status', 'published')->where('isDeleted', false)->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        $user_review = Review::where('course_id',1)->orderBy('created_at','desc')->get();
        if (Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;

            return view('client/bootcamp/index', compact('cart_count','transactions','courses','course_categories','informations','notifications','footer_reviews','user_review'));
        }

        return view('client/bootcamp/index',compact('course_categories','courses','footer_reviews','user_review'));
    }

    // Shows the details for each course.
    public function show($id) {

        $agent = new Agent();
        if($agent->isPhone())
            return view('client/mobile/under-construction');

        $course = Course::findOrFail($id);

        if ($course->courseType->type == 'Course') {
            return redirect()->route('online-course.show', $course->id);
        } elseif ($course->courseType->type == 'Woki') {
            return redirect()->route('woki.show', $course->id);
        }

        // Get Schedules Data orderBy DateTime & groupBy Date.
        $schedules = $this->getSchedulesGroupByDate($course);
        $reviews = Review::where('course_id',$id)->orderBy('created_at', 'desc')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        $tomorrow = Carbon::now()->addDays(1);
        $tomorrow->setTimezone('Asia/Jakarta');
        // Get courses suggestions.
        if (Auth::check()) {
            $this->resetNavbarData();
            
            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            
            $courseSuggestions = CourseHelper::getCourseSuggestion(3,'Bootcamp');
            return view('client/bootcamp/detail', compact('course', 'schedules', 'reviews','cart_count','transactions','informations','notifications','footer_reviews','courseSuggestions','tomorrow'));
        }
        

        return view('client/bootcamp/detail', compact('course', 'schedules', 'reviews','footer_reviews','tomorrow'));
    }

    private function getSchedulesGroupByDate($course) {
        $bootcampSchedules = $course->bootcampSchedules()->orderBy('date_time')->get()
            ->groupBy(function ($schedule) {
                return $schedule->date_time->format('Y-m-d');
            });
        $result = []; 
        foreach ($bootcampSchedules as $key => $value) {
            $result[] = $value;
        }
        return $result;
    }
}
