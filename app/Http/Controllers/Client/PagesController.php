<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Config;
use App\Models\TrustedCompany;
use App\Models\FakeTestimony;
use App\Models\User;
use App\Models\Hashtag;
use App\Models\UserDetail;
use App\Models\Course;
use App\Models\Cart;

use PDF;

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
    // Show the main landing page of the app.
    public function index(Request $request) {
        $config_keyword = 'cms.homepage';
        $configs = Config::select('key', 'value')->where([['key', 'like', "%".$config_keyword."%"]])->get()->keyBy('key');

        $trusted_companies = TrustedCompany::all();

        $fake_testimonies = FakeTestimony::orderByRaw('CHAR_LENGTH(content) DESC')->get();
        $fake_testimonies_big = $fake_testimonies->whereNotNull('thumbnail')->whereNotNull('name')->whereNotNull('occupancy')->values();
        $fake_testimonies_small = $fake_testimonies->whereNull('thumbnail')->whereNull('name')->whereNull('occupancy')->values();
        
        // Get 3 Online Courses
        $online_courses = Course::where('course_type_id','1')->take(3)->get();

        if(Auth::check()) {
            $cart_count = Cart::with('course')
                ->where('user_id', auth()->user()->id)
                ->count();

            return view('client/index', compact('configs', 'trusted_companies', 'fake_testimonies_big', 'fake_testimonies_small','online_courses','cart_count'));
        } else {
            return view('client/index', compact('configs', 'trusted_companies', 'fake_testimonies_big', 'fake_testimonies_small', 'online_courses'));
        }
        
    }

    public function autocomplete(Request $request){
        $datas = User::select('name')->where("name", "like", "%{$request->terms}%")->get();

        return response()->json($datas);
    }
    public function signup_interest()
    {
        $interests = Hashtag::all();
        return view('client/auth/signup-interests', compact('interests'));

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

        //$name = $request->session()->get('name');


        return redirect()->route('signup_interest');
    }
    public function storeInterest(Request $request)
    {
        $validated = $request->validate([
            'interests' => 'required|array|min:1',
        ]);

        //here store to user and user detail table
  

        $user = User::create([
            'user_role_id' => 1,
            'name' => $request->session()->get('name'),
            'email' => $request->session()->get('email'),
            'password' => Hash::make($request->session()->get('password')),
            'is_admin' => '0',
        ]);
        $user_id = User::latest()->first()->id;

        $user_detail = UserDetail::create([
            'user_id' => $user_id,
            'telephone' => $request->session()->get('telephone'),
            'referral_code' => $request->session()->get('referral_code'),
            'response' => $request->session()->get('response'),
        ]);
        
        //here store to user_hashtag table
        $request->session()->flush();
        
        return view('client/user-dashboard');
    }

    public function course_detail($id){
        $course = Course::findOrFail($id);
        return view('client/online-course/detail', compact('course'));
    }

    public function dashboard_index()
    {
        return view('client/user-dashboard');
    }
    public function print(){
        $pdf = PDF::loadView('client/certificate')
        ->setPaper('A4', 'potrait');
        
        // return $pdf->download('certificate.pdf'); //download
        return $pdf->stream(); //view
    }
}
