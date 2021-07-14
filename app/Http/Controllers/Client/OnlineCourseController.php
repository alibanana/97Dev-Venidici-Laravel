<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

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
        ->where('publish_status', 'published')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        $user_review = Review::where('course_id',1)->orderBy('created_at','desc')->get();
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
    public function show($id) {
        $agent = new Agent();
        if($agent->isPhone())
            return view('client/mobile/under-construction');

        $course = Course::findOrFail($id);

        if ($course->courseType->type == 'Bootcamp') {
            return redirect()->route('bootcamp.show', $course->id);
        } elseif ($course->courseType->type == 'Woki') {
            return redirect()->route('woki.show', $course->id);
        }

        $reviews = Review::where('course_id',$id)->orderBy('created_at', 'desc')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        // Get courses suggestions.
        if (Auth::check()) {
            $this->resetNavbarData();
            
            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            
            $courseSuggestions = CourseHelper::getCourseSuggestion(3,'Course');
            return view('client/online-course/detail', compact('course','reviews','cart_count','transactions','informations','notifications','footer_reviews','courseSuggestions'));
        }

        return view('client/online-course/detail', compact('course','reviews','footer_reviews'));
    }

    public function learn($course_id, $section_content_id) {
        $agent = new Agent();
        if($agent->isPhone())
            return view('client/mobile/under-construction');
        $this->resetNavbarData();

        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        // $cart_count = Cart::with('course')
        //     ->where('user_id', auth()->user()->id)
        //     ->count();
        
        // $transactions = Notification::where(
        //     [   
        //         ['user_id', '=', auth()->user()->id],
        //         ['isInformation', '=', 0],
                
        //     ]
        // )->orderBy('created_at', 'desc')->get();   
        
        $course = auth()->user()->courses()->where('user_course.course_id', $course_id)->firstOrFail();
        $sections = $course->sections;
        
        $assessment = $course->assessment;
        $content = SectionContent::findOrFail($section_content_id);
        
        //check if user has seen the content or not
        $info_users = explode(',', $content->hasSeen);
        $infoHasSeen = FALSE;

        foreach($info_users as $user_id)
        {
          // if the user has seen the content
            if($user_id == Auth::user()->id)
                $infoHasSeen = TRUE;
        }        

        //if user has not seen the content
        if(!$infoHasSeen){
            $content->hasSeen = $content->hasSeen.auth()->user()->id.',';
            $content->save();
        }

        // $informations = Notification::where('isInformation', 1)->orderBy('created_at','desc')->get();
        // $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/online-course/learn', compact('cart_count','transactions', 'course', 'sections', 'content', 'assessment', 'informations', 'notifications','footer_reviews'));
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
