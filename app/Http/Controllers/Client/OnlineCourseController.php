<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    private $notifications; // Stores combined notifications data.
    private $informations; // Stores notification (isInformation == true) data.
    private $transactions; // Stores notification (isInformation == false) data for a particular user.
    private $cart_count; // Stores cart data for a particular user.

    private function resetNavbarData() {
        $this->notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $this->informations = Notification::where('isInformation', 1)->orderBy('created_at','desc')->get();
        $this->transactions = Notification::where([   
                ['user_id', '=', auth()->user()->id],
                ['isInformation', '=', 0]
            ])->orderBy('created_at', 'desc')->get();
        $this->cart_count = Cart::with('course')->where('user_id', auth()->user()->id)->count();
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
        $courses = $courses->where('course_type_id',1)->get();

        if (Auth::check()) {

            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;

            return view('client/online-course/index', compact('cart_count','transactions','courses','course_categories','informations','notifications'));
        } else {
            return view('client/online-course/index',compact('course_categories','courses'));
        }
    }

    // Shows the details for each course.
    public function show($id){
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $course = Course::findOrFail($id);
        $reviews = Review::where('course_id',$id)->orderBy('created_at', 'desc')->get();
        
        if (Auth::check()) {

            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;

            return view('client/online-course/detail', compact('course','reviews','cart_count','transactions','informations','notifications'));
        } else {
            return view('client/online-course/detail', compact('course','reviews'));
        }

    }



    public function learn($course_id, $section_content_id)
    {   
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
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




                
        $informations = Notification::where('isInformation', 1)->orderBy('created_at','desc')->get();
        $notifications = Notification::where('isInformation',1)->orWhere('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('client/online-course/learn', compact('cart_count','transactions', 'course', 'sections', 'content', 'assessment', 'informations', 'notifications'));
    }

    public function buyFree($course_id)
    {
        if(!auth()->user()->isProfileUpdated)
            return redirect()->back()->with('message_update','Please complete your profile first.');

        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        };

        $no_invoice = 'INV-'.Str::upper($random);
        
        // create invoice
        $invoice = Invoice::create([
            'invoice_no'            => $no_invoice,
            'user_id'               => auth()->user()->id,
            'name'                  => auth()->user()->name,
            'phone'                 => auth()->user()->userDetail->telephone,
            'grand_total'           => 0,
            'status'                => 'completed',
            'total_order_price'     => 0,
            'xfers_payment_id'      => $no_invoice,

        ]);

        // Create order item & attach course to user.
        $order = Order::create([
            'invoice_id'    => $invoice->id,
            'course_id'     => $course_id,
            'qty'           => 1,
            'price'         => 0,
        ]);



        $courses_string = "";

        $x = 1;
        $length = count($invoice->orders);
        foreach($invoice->orders as $order)
        {
            if($x == $length && $length != 1)
                $courses_string = $courses_string." dan ";
            
            elseif($x != 1)
                $courses_string = $courses_string.", ";

            $courses_string = $courses_string.$order->course->title;
            $x++;
        }
        $invoice = Invoice::where('xfers_payment_id',$no_invoice)->first();

        // create notification
        $notification = Notification::create([
            'user_id'           => auth()->user()->id,
            'invoice_id'        => $invoice->id,
            'isInformation'     => 0,
            'title'             => 'Pembayaran Telah Berhasil!',
            'description'       => 'Hi, '.auth()->user()->name.'. Pembayaranmu untuk pelatihan: '.$courses_string.' telah berhasil.',
            'link'              => '/transaction-detail/'.$no_invoice
        ]);

        foreach ($invoice->orders as $order) {
            $course = $order->course;
            if (!auth()->user()->courses->contains($course->id)) {
                auth()->user()->courses()->attach($course->id);
                if ($course->assessment()->exists()) {
                    auth()->user()->assessments()->attach($course->assessment->id);
                }
            }
        }
        return redirect('/transaction-detail/'.$no_invoice.'#payment-success');

    }
    
}
