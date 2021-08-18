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
use App\Models\SyllabusRequest;
use App\Models\Order;
use App\Models\BootcampApplication;
use App\Models\Notification;
use App\Models\Province;
use App\Models\City;
use Illuminate\Support\Facades\Validator;
use App\Models\Promotion;


use Illuminate\Support\Facades\Mail;
use App\Mail\BootcampSyllabusMail;

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
        // $course_id = 6;
        $course = Course::where('course_type_id',3)->where('enrollment_status', 'open')
        ->where('publish_status', 'published')->where('isDeleted', false)->where('isFeatured',TRUE)->first();
        if($course == null)
            return redirect()->back();
        $provinces = Province::all();
        $cities = City::all();

        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        $tomorrow = Carbon::now()->addDays(1);
        $tomorrow->setTimezone('Asia/Jakarta');
        if (Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;

            // Check dulu apakah ada bootcamp_applications yang statusnya BUKAN
            //ft_refunded, ft_cancelled atau denied , kalo ada, redirect back
    
            $bootcamp_application_count = BootcampApplication::where(
                [   
                    ['course_id', '=', $course->id],
                    ['user_id', '=', auth()->user()->id],
                    ['status', '!=', 'ft_refunded'],
                    ['status', '!=', 'ft_cancelled'],
                    ['status', '!=', 'denied'],
                    
                ]
            )->count();
            
            return view('client/bootcamp/index', compact('cart_count','transactions','course','informations','notifications','footer_reviews','provinces','cities','tomorrow','bootcamp_application_count'));
        }

        return view('client/bootcamp/index', compact('course','footer_reviews','provinces','cities','tomorrow'));
    }

    public function index_old(Request $request) {
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

    public function buyFree(Request $request,$course_id) {
        $input = $request->all();
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
            'name' => $input['name'],
            'phone' => $input['phone'],
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
            'name'                  => $input['name'],
            'email'                 => $input['email'],
            'phone_no'              => $input['phone'],
            'address'               => $input['address']
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

    public function storeFullRegistration(Request $request, $course_id)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => '',
            'email'                 => '',
            'birth_place'           => 'required',
            'birth_date'            => 'required',
            'gender'                => 'required',
            'phone_no'              => 'required',
            'province_id'           => 'required',
            'city_id'               => 'required',
            'address'               => 'required',
            'last_degree'           => 'required',
            'institution'           => 'required',
            'batch'                 => 'required',
            'sumber_tahu_program'   => '',
            'mencari_kerja'         => 'required',
            'social_media'          => 'required|starts_with:https://www.linkedin.com',
            'kenapa_memilih'        => 'required',
            'expectation'           => 'required',
            'promo_code'            => '',
            'metode_pembayaran_bootcamp'    => 'required',
            ]);

        if ($validator->fails())
            return redirect('/bootcamp#full-registration')->withErrors($validator)->withInput($request->all());
        
        $validated = $validator->validate();


        // Check dulu apakah ada bootcamp_applications yang statusnya BUKAN
        //ft_refunded, ft_cancelled atau denied , kalo ada, redirect back
 
        $bootcamp_application = BootcampApplication::where(
            [   
                ['course_id', '=', $course_id],
                ['user_id', '=', auth()->user()->id],
                ['status', '!=', 'ft_refunded'],
                ['status', '!=', 'ft_cancelled'],
                ['status', '!=', 'denied'],
                
            ]
        )->count();
        if($bootcamp_application != 0)
            return redirect('/bootcamp#full-registration')->with('full_registration_bootcamp_message', 'You already have registered for a bootcamp, we will get back to you soon.');
        
        // change promo code.
        if ($validated['promo_code'] != null){
            $promoObject = Promotion::where('code', $validated['promo_code'])->where('isActive',1)->first();
            if ($promoObject == null) 
                return redirect('/bootcamp#full-registration')->with('full_registration_bootcamp_message', 'Oops, Promo Code tidak ditemukan..')->withInput($request->all());
        }

        $bootcamp                       = new BootcampApplication;
        $bootcamp->course_id            = $course_id;
        $bootcamp->user_id              = Auth::user()->id;
        $bootcamp->name                 = Auth::user()->name;
        $bootcamp->email                = Auth::user()->email;
        $bootcamp->birth_place          = $validated['birth_place'];
        $bootcamp->birth_date           = $validated['birth_date'];
        $bootcamp->gender               = $validated['gender'];
        $bootcamp->phone_no             = $validated['phone_no'];
        $bootcamp->province_id          = $validated['province_id'];
        $bootcamp->city_id              = $validated['city_id'];
        $bootcamp->address              = $validated['address'];
        $bootcamp->last_degree          = $validated['last_degree'];
        $bootcamp->institution          = $validated['institution'];
        $bootcamp->batch                = $validated['batch'];
        $bootcamp->sumber_tahu_program  = $validated['sumber_tahu_program'];
        $bootcamp->mencari_kerja        = $validated['mencari_kerja'];
        $bootcamp->social_media         = $validated['social_media'];
        $bootcamp->konsiderasi_lanjut   = 'Ya';
        $bootcamp->kenapa_memilih       = $validated['kenapa_memilih'];
        $bootcamp->expectation          = $validated['expectation'];
        $bootcamp->promo_code          = $validated['promo_code'];
        $bootcamp->metode_pembayaran_bootcamp          = $validated['metode_pembayaran_bootcamp'];
        $bootcamp->is_full_registration = 1;
        $bootcamp->status               = "waiting";
        $bootcamp->save();

        // create notification
        $notification = Notification::create([
            'user_id' => auth()->user()->id,
            'isInformation' => 0,
            'title' => 'Registrasi berhasil!',
            'description' => 'Hi, '.auth()->user()->name.'.Terimakasih atas registrasi bootcampnya. Klik disini untuk melihat status',
            'link' => '/dashboard'
        ]);

        // Check if notification creation failed.
        if (!$notification->exists) {
            abort(500);
        }

        return redirect('/bootcamp#full-registration')->with('full_registration_bootcamp_message',"Terimakasih telah mendaftar, we'll get back to you as soon as possible!");
    }

    public function sendSyllabus($course_id){
        $user = auth()->user();
        $course = Course::findOrFail($course_id);
        $link = asset($course->bootcampCourseDetail->syllabus);
        Mail::to(auth()->user()->email)->send(new BootcampSyllabusMail($course,$link,$user));
        $syllabusRequest = new SyllabusRequest;
        $syllabusRequest->course_id = $course_id;
        $syllabusRequest->user_id = $user->id;
        $syllabusRequest->save();

        return redirect('/bootcamp#schedule-section')->with('send_syllabus_message',"Syllabus telah terkirim ke email anda.");

    }
}
