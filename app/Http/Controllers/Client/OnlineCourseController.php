<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\FinishCourseMail;

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
use App\Models\Order;
use App\Models\Promotion;
use Jenssegers\Agent\Agent;
use App\Helper\CourseHelper;

/*
|--------------------------------------------------------------------------
| Client OnlineCourseController Class.
|
| Description:
| This controller class is responsible in handling pages which prefixes (urls)
| include /online-course (excluding admin pages).
|--------------------------------------------------------------------------
*/ 
class OnlineCourseController extends Controller {
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

    // Shows the Client's Main Online-Course Page.
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
        $courses = $courses->where('course_type_id',1)->where('enrollment_status', 'open')
        ->where('publish_status', 'published')->where('isDeleted', false)->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        $user_review = Review::whereHas('course', function ($query){
            $query->where('course_type_id', 1);
                })->orderBy('reviews.created_at', 'desc')->get();
        if (Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;

            return view('client/online-course/index', compact('cart_count','transactions','courses','course_categories','informations','notifications','footer_reviews','user_review'));
        }

        return view('client/online-course/index',compact('course_categories','courses','footer_reviews','user_review'));
    }

    // Shows the details for each course.
    public function show($course_title) {
        $agent = new Agent();

        // if($agent->isPhone())
        //     return view('client/mobile/under-construction');

        // $course = Course::findOrFail($id);
        $course = Course::where('title', $course_title)->firstOrFail();

        if ($course->courseType->type == 'Bootcamp') {
            return redirect()->route('bootcamp.show', $course->id);
        } elseif ($course->courseType->type == 'Woki') {
            return redirect()->route('woki.show', $course->id);
        }
        
        $reviews = Review::where('course_id',$course->id)->orderBy('created_at', 'desc')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        // Get courses suggestions.
        if (Auth::check()) {
            $this->resetNavbarData();
            
            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            
            $courseSuggestions = CourseHelper::getCourseSuggestion(3,'Course');
            if($agent->isPhone()){
                return view('client/online-course/detail', compact('course','reviews','cart_count','transactions','informations','notifications','footer_reviews','courseSuggestions'));
            }
            
            return view('client/online-course/detail', compact('course','reviews','cart_count','transactions','informations','notifications','footer_reviews','courseSuggestions'));
        }
        if($agent->isPhone()){
            return view('client/online-course/detail', compact('course','reviews','cart_count','transactions','informations','notifications','footer_reviews','courseSuggestions'));
        }
        return view('client/online-course/detail', compact('course','reviews','footer_reviews'));
    }

    public function learn($course_title, $content_title) {
        $agent = new Agent();

        if($agent->isPhone())
            return view('client/mobile/under-construction');
        
        // Get Navbar data.
        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        // Get Courses related data.
        $course = CourseHelper::getUserValidatedCourseByTitle($course_title);
        if ($course == null) abort(404);

        $sections = $course->sections;
        $assessment = $course->assessment;
        
        $content = CourseHelper::getSectionContentByCourseIdAndTitle($course->id, $content_title);
        if ($content == null) abort (404);
        
        // Checks if user has seen the content or not
        $info_users = explode(',', $content->hasSeen);
        if (!in_array(Auth::user()->id, $info_users)) {
            $content->hasSeen = $content->hasSeen . auth()->user()->id . ',';
            $content->save();
        }

        $percentage = CourseHelper::calculateUserCourseProgressByCourseObject($course);

        //if the user has watched all videos, but theres no assessment, change the status of the course to completed
        if($percentage == 100 && $course->assessment == null && $course->pivot->status == 'on-going'){
            $course->pivot->status = 'completed';
            $course->pivot->save();
            $link = route('customer.dashboard');
            Mail::to(auth()->user()->email)->send(new FinishCourseMail($course,$link));
            Helper::addStars(auth()->user(), 15, 'Penyelesaian course '.$course->title);
        }

        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/online-course/learn', compact('notifications', 'informations', 'transactions', 'cart_count',
            'course', 'sections', 'assessment', 'content', 'footer_reviews'));
    }

    public function buyFree($course_id) {
        // Validate if course exists;
        $course = Course::findOrFail($course_id);

        if(!auth()->user()->isProfileUpdated)
            return redirect()->back()->with('message_update','Please complete your profile first.');
        
        $invoiceNumberResults = Helper::generateInvoiceNumber();

        // If something failed
        if ($invoiceNumberResults['status'] == 'Failed') {
            return redirect()->back()->with('message', $invoiceNumberResults['message']);
        }

        $invoice = Invoice::create([
            'invoice_no' => $invoiceNumberResults['data'],
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'phone' => auth()->user()->userDetail->telephone,
            'grand_total' => 0,
            'status' => 'completed',
            'total_order_price' => 0,
            'xfers_payment_id' => $invoiceNumberResults['data'],
        ]);

        // Check if invoice creation failed.
        if (!$invoice->exists) abort(500);

        $order = Order::create([
            'invoice_id'    => $invoice->id,
            'course_id'     => $course_id,
            'qty'           => 1,
            'price'         => 0,
        ]);

        // Check if order creation failed.
        if (!$order->exists) {
            $invoice->delete();
            abort(500);
        };

        // create notification
        $notification = Notification::create([
            'user_id' => auth()->user()->id,
            'invoice_id' => $invoice->id,
            'isInformation' => 0,
            'title' => 'Pembayaran Telah Berhasil!',
            'description' => 'Hi, '.auth()->user()->name.'. Kamu telah mendapatkan pelatihan: ' . $course->title . '.',
            'link' => '/transaction-detail/'.$invoiceNumberResults['data']
        ]);

        // Check if notification creation failed.
        if (!$notification->exists) {
            $order->delete();
            $invoice->delete();
            abort(500);
        }

        if (!auth()->user()->courses->contains($course->id)) {
            auth()->user()->courses()->syncWithoutDetaching([$course->id]);
            if ($course->assessment()->exists()) {
                auth()->user()->assessments()->syncWithoutDetaching([$course->assessment->id]);
            }
        }

        return redirect('/transaction-detail/'.$invoiceNumberResults['data'].'#payment-success');
    }
    
}
