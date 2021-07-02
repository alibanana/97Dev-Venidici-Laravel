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

class WokiController extends Controller
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
                $url = route('woki.index', request()->except('search'));
                return redirect($url);            
            } else {
                $search = $request->search;

                $courses = $courses->where(function ($query) use ($search) {
                    $query->where([['title', 'like', "%".$search."%"]])
                    ->orWhere([['subtitle', 'like', "%".$search."%"]]);
                });
            }
        }
        $courses = $courses->where('course_type_id',2)->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        if (Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;

            return view('client/woki/index', compact('cart_count','transactions','courses','course_categories','informations','notifications','footer_reviews'));
        }

        return view('client/woki/index',compact('course_categories','courses','footer_reviews'));
    }

    // Shows the client woki course detail page.
    public function show($id) {
        $agent = new Agent();
        if($agent->isPhone())
            return view('client/mobile/under-construction');

        $course = Course::findOrFail($id);
        $reviews = Review::where('course_id',$id)->orderBy('created_at', 'desc')->get();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        if (Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;

            return view('client/woki/detail', compact('course','reviews','cart_count','transactions','informations','notifications','footer_reviews'));
        }

        return view('client/woki/detail', compact('course','reviews','footer_reviews'));
    }
}
