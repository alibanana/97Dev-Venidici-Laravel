<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use App\Models\Review;
use App\Helper\Helper;
use App\Models\Course;
use App\Helper\CourseHelper;

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

    public function index()
    {
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $informations = Notification::where('isInformation',1)->orderBy('created_at','desc')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        if (Auth::check()) {

            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            return view('client/for-public/bootcamp', compact('cart_count','transactions','informations','programs','notifications','footer_reviews'));
            
        } else {
            return view('client/for-public/bootcamp', compact('programs','footer_reviews'));
        }
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

        // Get courses suggestions.
        if (Auth::check()) {
            $this->resetNavbarData();
            
            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            
            $courseSuggestions = CourseHelper::getCourseSuggestion(3,'Bootcamp');
            return view('client/bootcamp/detail', compact('course', 'schedules', 'reviews','cart_count','transactions','informations','notifications','footer_reviews','courseSuggestions'));
        }

        return view('client/bootcamp/detail', compact('course', 'schedules', 'reviews','footer_reviews'));
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
