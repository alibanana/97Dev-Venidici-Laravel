<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Helper\Helper;
use PDF;

use App\Models\Notification;
use App\Models\Config;
use App\Models\TrustedCompany;
use App\Models\FakeTestimony;
use App\Models\User;
use App\Models\Hashtag;
use App\Models\UserDetail;
use App\Models\Course;
use App\Models\Province;
use App\Models\Review;
use App\Models\Cart;
use App\Models\City;
use App\Models\UserHashtag;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\InstructorPosition;   


/*
|--------------------------------------------------------------------------
| Client PagesController Class.
|
| Description:
| This controller class is responsible to handle client pages that does not
| have any other requests method types other than GET methods in their pages.
|--------------------------------------------------------------------------
*/ 
class PagesController extends Controller
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

    // Show the main landing page of the app.
    public function index(Request $request) {
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        $agent = new Agent();
        // if($agent->isPhone()){
        //     return view('client/mobile/under-construction');
        // }
        $config_keyword = 'cms.homepage';
        $configs = Config::select('key', 'value')->where([['key', 'like', "%".$config_keyword."%"]])->get()->keyBy('key');

        $trusted_companies = TrustedCompany::all();

        $fake_testimonies = FakeTestimony::orderByRaw('CHAR_LENGTH(content) DESC')->get();
        $fake_testimonies_big = $fake_testimonies->whereNotNull('thumbnail')->whereNotNull('name')->whereNotNull('occupancy')->values();
        $fake_testimonies_small = $fake_testimonies->whereNull('thumbnail')->whereNull('name')->whereNull('occupancy')->values();
        // Get 3 Online Courses
        $online_courses = Course::where('course_type_id','1')->take(3)->get();
        // Get 3 wokis
        $wokis = Course::where('course_type_id','2')->take(3)->get();
        // Get 3 most popular
        $pengajar_positions = InstructorPosition::all();
        if(Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            if($agent->isPhone()){
                return view('client/mobile/index',compact('configs', 'trusted_companies', 'fake_testimonies_big', 'fake_testimonies_small',
                'online_courses','wokis','cart_count', 'notifications', 'transactions','informations','pengajar_positions','footer_reviews'));
            }

            return view('client/index', 
                compact('configs', 'trusted_companies', 'fake_testimonies_big', 'fake_testimonies_small',
                    'online_courses','wokis','cart_count', 'notifications', 'transactions','informations','pengajar_positions','footer_reviews'));
        }
        if($agent->isPhone()){
            return view('client/mobile/index',compact('configs', 'trusted_companies', 'fake_testimonies_big', 'fake_testimonies_small', 'online_courses','wokis','pengajar_positions','footer_reviews'));
        }
        return view('client/index', 
            compact('configs', 'trusted_companies', 'fake_testimonies_big', 'fake_testimonies_small', 'online_courses','wokis','pengajar_positions','footer_reviews'));
    }

    public function community_index(){
        $agent = new Agent();
        // if($agent->isPhone()){
        //     return view('client/mobile/under-construction');
        // }
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        if(Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            if($agent->isPhone()){
                return view('client/community',compact('cart_count', 'notifications', 'transactions','informations','footer_reviews'));
            }

            return view('client/community', compact('cart_count', 'notifications', 'transactions','informations','footer_reviews'));
        }
        if($agent->isPhone()){
            return view('client/community',compact('footer_reviews'));
        }
        
        return view('client/community',compact('footer_reviews'));
    }

    public function autocomplete(Request $request){
        $datas = User::select('name')->where("name", "like", "%{$request->terms}%")->get();
        return response()->json($datas);
    }
    
    public function signup_interest(Request $request)
    {
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        if(!$request->session()->get('name')) 
            return redirect()->route('signup_general_info');

        $interests = Hashtag::all();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/auth/signup-interests', compact('interests','footer_reviews'));
    }
    

    public function signup_general_info(){
        $agent = new Agent();
        if($agent->isPhone()){
            return view('client/mobile/under-construction');
        }
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        return view('client/auth/signup',compact('footer_reviews'));
    }

    public function storeGeneralInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'response' => 'required',
            'referral_code' => '',
        ]);

        $request->session()->put('name', $validated['name']);
        $request->session()->put('telephone', $validated['telephone']);
        $request->session()->put('email', $validated['email']);
        $request->session()->put('password', $validated['password']);
        $request->session()->put('response', $validated['response']);

        if($validated['referral_code'])
            $request->session()->put('referral_code', $validated['referral_code']);

        return redirect()->route('signup_interest');
    }

    public function storeInterest(Request $request)
    {
        $validated = $request->validate([
            'interests' => 'required|array'
        ]);

        // Get all Referal Codes
        $referralCodes = UserDetail::select('referral_code')->get()->pluck('referral_code')->toArray();

        // Check whether referral code exists
        if($request->session()->get('referral_code'))
        {
            if(!in_array($request->session()->get('referral_code'), $referralCodes)){
                return redirect('/signup')->with('message','Referral code tidak ditemukan');
            }
        }

        $hashtag_ids= [];
        foreach($validated['interests'] as $hashtag_id => $flag)
        {
            if($flag == '1') 
                $hashtag_ids[] = $hashtag_id;
        }

        if(count($hashtag_ids) > 3)
            return redirect()->back()->with('message','message');

        $user = User::create([
            'name'      => $request->session()->get('name'),
            'email'     => $request->session()->get('email'),
            'password'  => Hash::make($request->session()->get('password'))
        ]);

        // Generate New Referral Code
        $newReferralCode = substr($request->session()->get('name'), 0,3).Str::random(3);
        
        // selama referralnya belom ada
        while (in_array($newReferralCode, $referralCodes)) {
            //buat referral baru
            $newReferralCode = substr($request->session()->get('name'), 0,3).Str::random(3);

        }
        if($request->session()->get('referral_code'))
            $referredByCode = $request->session()->get('referral_code');
        else
            $referredByCode = null;
            
        $user_detail = UserDetail::create([
            'user_id'               => $user->id,
            'telephone'             => $request->session()->get('telephone'),
            'referral_code'         => strtoupper($newReferralCode),
            'referred_by_code'      => $referredByCode,
            'response'              => $request->session()->get('response')
        ]);

        //here store to user_hashtag table
        $user->hashtags()->attach($hashtag_ids);
    
        $request->session()->flush();
        
        event(new Registered($user));
        
        Auth::login($user);

        return redirect()->route('customer.dashboard');
    }


    public function online_course_index(){
        $agent = new Agent();
        // if($agent->isPhone()){
        //     return view('client/mobile/under-construction');
        // }
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        if(Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            if($agent->isPhone()){
                return view('client/mobile/for-public/online-course',compact('cart_count', 'notifications', 'transactions','informations','footer_reviews'));
            }
            
            return view('client/for-public/online-course', compact('cart_count', 'notifications', 'transactions','informations','footer_reviews'));
        }
        if($agent->isPhone()){
            return view('client/mobile/for-public/online-course',compact('footer_reviews'));
        }
        
        return view('client/for-public/online-course',compact('footer_reviews'));
    }

    public function woki_index(){
        $agent = new Agent();
        // if($agent->isPhone()){
        //     return view('client/mobile/under-construction');
        // }
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        if(Auth::check()) {
            $this->resetNavbarData();

            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            if($agent->isPhone()){
                return view('client/mobile/for-public/woki',compact('cart_count', 'notifications', 'transactions','informations','footer_reviews'));
            }

            return view('client/for-public/woki', compact('cart_count', 'notifications', 'transactions','informations','footer_reviews'));
        }
        if($agent->isPhone()){
            return view('client/mobile/for-public/woki',compact('footer_reviews'));
        }

        return view('client/for-public/woki',compact('footer_reviews'));
    }

    public function print(Request $request){
        $course = Course::findOrFail($request->course_id);
        $user_course = auth()->user()->courses()->where('course_id',$course->id)->first();
        
        $name = $request->name;
        $finish_date = $user_course->pivot->updated_at->todatestring();
        $first_sentence = 'We hereby award this Certificate of Completion on our On-Demand Class,';
        $second_sentence    = 'By completing this course on ';
        $course_name = $course->title;
        $third_sentence    = 'you have practiced and taken an initiative to develop yourself in order to take part in cometitive environment';

        $pdf = PDF::loadView('client/certificate',compact('name','finish_date','first_sentence','second_sentence','course_name','third_sentence'))
        ->setPaper('A4', 'landscape');
        return $pdf->download('certificate.pdf'); //download
        //return $pdf->stream(); //view
    }

    public function seeNotification(Request $request){
        $input = $request->all();

        $notification = Notification::findOrFail($input['notification_id']);
        $notification->hasSeen = $notification->hasSeen.$input['user_id'].',';
        $notification->save();

        return redirect($input['link']);
    }
}