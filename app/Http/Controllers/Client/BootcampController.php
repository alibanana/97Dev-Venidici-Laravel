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
use App\Models\Invoice;
use App\Models\Order;
use App\Models\BootcampApplication;
use App\Models\Notification;

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
        $user_review = Review::whereHas('course', function ($query){
            $query->where('course_type_id', 3);
                })->orderBy('reviews.created_at', 'desc')->get();
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

        //create bootcamp applications
        $bootcamp_applications      = BootcampApplication::create([
            'course_id'             => $course_id,
            'user_id'               => auth()->user()->id,
            'invoice_id'            => $invoice->id,
            'name'                  => auth()->user()->name,
            'phone_no'              => auth()->user()->userDetail->telephone,
        ]);

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
